<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use HTMLPurifier;
use HTMLPurifier_Config;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('jurusan')->latest()->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $jurusan = Jurusan::all();
        return view('admin.posts.create', compact('jurusan'));
    }

    public function store(Request $request)
{
    $request->validate([
        'jurusan_id' => 'required|exists:jurusans,id',
        'title'      => 'nullable|string|max:255',
        'image'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $sections = [
        'description', 'kompetensi_dasar', 'tujuan_pembelajaran',
        'kurikulum_sinkronisasi', 'program_unggulan', 'tim_pengajar',
        'galeri_kegiatan', 'kundudi', 'industri_pasangan'
    ];

    $config = HTMLPurifier_Config::createDefault();
    $config->set('HTML.Allowed',
        'p[style|class],br,b,i,u,strong,em,s,strike,blockquote,code,pre,' .
        'span[style|class],div[style|class],' .
        'ul,ol,li,h1,h2,h3,h4,h5,h6,' .
        'table,thead,tbody,tr,td,th,' .
        'a[href|title|target],' .
        'img[src|alt|width|height|style|class]'
    );
    $config->set('Attr.AllowedClasses', [
        'ql-align-left','ql-align-center','ql-align-right','ql-align-justify',
        'ql-font-serif','ql-font-monospace','ql-font-sans'
    ]);
    $config->set('CSS.AllowedProperties', [
        'text-align','width','height',
        'color','background-color','font-family','font-size','font-weight','font-style'
    ]);
    $purifier = new HTMLPurifier($config);

    $data = [
        'jurusan_id' => $request->jurusan_id,
        'user_id'    => auth()->id(),
        'title'      => $request->title ?? null,
    ];

    // Gambar utama
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $filename = time().'_'.Str::random(10).'.'.$image->getClientOriginalExtension();
        $data['image'] = $image->storeAs('uploads', $filename, 'public');
    }

    foreach ($sections as $section) {
        // Teks utama per section
        $data[$section] = $request->$section ? $purifier->purify($request->$section) : null;

        // Upload foto per section
        $photosKey = $section.'_photos';
        if ($request->hasFile($photosKey)) {
            $photos = [];
            foreach ($request->file($photosKey) as $photo) {
                $filename = time().'_'.Str::random(10).'.'.$photo->getClientOriginalExtension();
                $path = $photo->storeAs('uploads', $filename, 'public');
                $photos[] = $path;
            }
            $data[$photosKey] = json_encode($photos);
        }

        // Upload file per section
        $filesKey = $section.'_files';
        if ($request->hasFile($filesKey)) {
            $files = [];
            foreach ($request->file($filesKey) as $file) {
                $filename = time().'_'.Str::random(10).'.'.$file->getClientOriginalExtension();
                $path = $file->storeAs('uploads', $filename, 'public');
                $files[] = [
                    'filename' => $file->getClientOriginalName(),
                    'path'     => $path,
                    'mime_type'=> $file->getClientMimeType(),
                    'size'     => $file->getSize()
                ];
            }
            $data[$filesKey] = json_encode($files);
        }

        // Teks di bawah foto
        $photosTextKey = $section.'_photos_text';
        $data[$photosTextKey] = $request->$photosTextKey ?? null;
    }

    Post::create($data);

    return redirect()->route('admin.posts.index')->with('success', 'Post berhasil dibuat.');
}

    public function edit(Post $post)
    {
        $jurusan = Jurusan::all();
        return view('admin.posts.edit', compact('post', 'jurusan'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'jurusan_id' => 'required|exists:jurusans,id',
            'title'      => 'nullable|string|max:255',
            'image'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $sections = [
            'description', 'kompetensi_dasar', 'tujuan_pembelajaran',
            'kurikulum_sinkronisasi', 'program_unggulan', 'tim_pengajar',
            'galeri_kegiatan', 'kundudi', 'industri_pasangan'
        ];

        // Purifier Config
        $config = HTMLPurifier_Config::createDefault();
        $config->set('HTML.Allowed',
            'p[style|class],br,b,i,u,strong,em,s,strike,blockquote,code,pre,' .
            'span[style|class],div[style|class],' .
            'ul,ol,li,h1,h2,h3,h4,h5,h6,' .
            'table,thead,tbody,tr,td,th,' .
            'a[href|title|target],' .
            'img[src|alt|width|height|style|class]'
        );
        $config->set('Attr.AllowedClasses', [
            'ql-align-left','ql-align-center','ql-align-right','ql-align-justify',
            'ql-font-serif','ql-font-monospace','ql-font-sans'
        ]);
        $config->set('CSS.AllowedProperties', [
            'text-align','width','height',
            'color','background-color','font-family','font-size','font-weight','font-style'
        ]);
        $purifier = new HTMLPurifier($config);

        // Update dasar
        $post->jurusan_id = $request->jurusan_id;
        $post->title      = $request->filled('title') ? $request->title : null;

        foreach ($sections as $section) {
            // ========== 1. Teks utama ==========
            if ($request->filled($section)) {
                $post->$section = $purifier->purify($request->$section);
            } else {
                $post->$section = null;
            }

            // ========== 2. Foto ==========
            $photosKey = $section.'_photos';
            $existingPhotos = $post->$photosKey ? json_decode($post->$photosKey, true) : [];
            if (!is_array($existingPhotos)) $existingPhotos = [];

            // Foto yang dihapus
            $deletedPhotos = $request->input($photosKey.'_deleted', []);
            if (!is_array($deletedPhotos)) $deletedPhotos = [];

            foreach ($deletedPhotos as $del) {
                if (($key = array_search($del, $existingPhotos)) !== false) {
                    unset($existingPhotos[$key]);
                    Storage::disk('public')->delete($del);
                }
            }

            // Foto baru
            if ($request->hasFile($photosKey)) {
                foreach ($request->file($photosKey) as $photo) {
                    $filename = time().'_'.Str::random(10).'.'.$photo->getClientOriginalExtension();
                    $path = $photo->storeAs('uploads', $filename, 'public');
                    $existingPhotos[] = $path;
                }
            }

            $post->$photosKey = !empty($existingPhotos) ? json_encode(array_values($existingPhotos)) : null;

            // ========== 3. File ==========
            $filesKey = $section.'_files';
            $existingFiles = $post->$filesKey ? json_decode($post->$filesKey, true) : [];
            if (!is_array($existingFiles)) $existingFiles = [];

            // File yang dihapus
            $deletedFiles = $request->input($filesKey.'_deleted', []);
            if (!is_array($deletedFiles)) $deletedFiles = [];

            foreach ($deletedFiles as $delPath) {
                foreach ($existingFiles as $k => $f) {
                    if ($f['path'] === $delPath) {
                        unset($existingFiles[$k]);
                        Storage::disk('public')->delete($delPath);
                    }
                }
            }

            // File baru
            if ($request->hasFile($filesKey)) {
                foreach ($request->file($filesKey) as $file) {
                    $filename = time().'_'.Str::random(10).'.'.$file->getClientOriginalExtension();
                    $path = $file->storeAs('uploads', $filename, 'public');
                    $existingFiles[] = [
                        'filename' => $file->getClientOriginalName(),
                        'path'     => $path,
                        'mime_type'=> $file->getClientMimeType(),
                        'size'     => $file->getSize()
                    ];
                }
            }

            $post->$filesKey = !empty($existingFiles) ? json_encode(array_values($existingFiles)) : null;

            // ========== 4. Teks di bawah foto ==========
            $photosTextKey = $section.'_photos_text';
            $post->$photosTextKey = $request->filled($photosTextKey) ? $request->$photosTextKey : null;
        }

        // ========== 5. Gambar utama ==========
        if ($request->has('delete_image') && $post->image) {
            Storage::disk('public')->delete($post->image);
            $post->image = null;
        }

        if ($request->hasFile('image')) {
            if ($post->image) Storage::disk('public')->delete($post->image);
            $image = $request->file('image');
            $filename = time().'_'.Str::random(10).'.'.$image->getClientOriginalExtension();
            $post->image = $image->storeAs('uploads', $filename, 'public');
        }

        $post->save();

        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil diperbarui.');
    }

    // Hapus post
    public function destroy(Post $post)
    {
        if ($post->image) Storage::disk('public')->delete($post->image);

        $sections = [
            'description', 'kompetensi_dasar', 'tujuan_pembelajaran',
            'kurikulum_sinkronisasi', 'program_unggulan', 'tim_pengajar',
            'galeri_kegiatan', 'kundudi', 'industri_pasangan'
        ];

        foreach ($sections as $section) {
            $photosKey = $section . '_photos';
            if ($post->$photosKey) {
                foreach (json_decode($post->$photosKey, true) as $photo) {
                    Storage::disk('public')->delete($photo);
                }
            }
        }

        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil dihapus.');
    }

    // Upload image editor Quill
    public function upload(Request $request)
    {
        try {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                if ($file->isValid()) {
                    $path = $file->store('public/editor-images');
                    $url = Storage::url($path);
                    return response()->json(['success' => true, 'url' => $url], 200);
                }
                return response()->json(['success' => false, 'error' => 'Invalid file'], 400);
            }
            return response()->json(['success' => false, 'error' => 'No image uploaded'], 400);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Server error: ' . $e->getMessage()], 500);
        }
    }

    public function uploadFile(Request $request, $postId, $field)
    {
        // $field = nama kolom json, misal 'description_files', 'kompetensi_dasar_photos', dll
        $validFields = [
            'description_files', 'description_photos',
            'kompetensi_dasar_files', 'kompetensi_dasar_photos',
            'tujuan_pembelajaran_files', 'tujuan_pembelajaran_photos',
            'kurikulum_sinkronisasi_files', 'kurikulum_sinkronisasi_photos',
            'program_unggulan_files', 'program_unggulan_photos',
            'tim_pengajar_files', 'tim_pengajar_photos',
            'galeri_kegiatan_files', 'galeri_kegiatan_photos',
            'kundudi_files', 'kundudi_photos',
            'industri_pasangan_files', 'industri_pasangan_photos'
        ];

        if (!in_array($field, $validFields)) {
            return response()->json(['success' => false, 'error' => 'Invalid field'], 400);
        }

        try {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                if ($file->isValid()) {
                    // Simpan file di storage
                    $path = $file->store('public/editor-files');
                    $url = Storage::url($path);

                    // Ambil post dari DB
                    $post = Post::findOrFail($postId);

                    // Ambil data JSON lama, jika ada
                    $currentFiles = $post->{$field} ? json_decode($post->{$field}, true) : [];

                    // Tambahkan file baru
                    $currentFiles[] = [
                        'filename' => $file->getClientOriginalName(),
                        'url' => $url,
                        'mime_type' => $file->getClientMimeType(),
                        'size' => $file->getSize()
                    ];

                    // Update kolom JSON
                    $post->{$field} = json_encode($currentFiles);
                    $post->save();

                    return response()->json([
                        'success' => true,
                        'url' => $url,
                        'file' => end($currentFiles)
                    ], 200);
                }
                return response()->json(['success' => false, 'error' => 'Invalid file'], 400);
            }
            return response()->json(['success' => false, 'error' => 'No file uploaded'], 400);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Server error: ' . $e->getMessage()], 500);
        }

}
}