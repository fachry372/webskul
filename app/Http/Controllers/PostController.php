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
    // List semua post
    public function index()
    {
        $posts = Post::with('jurusan')->latest()->get();
        return view('admin.posts.index', compact('posts'));
    }

    // Form create
    public function create()
    {
        $jurusan = Jurusan::all();
        return view('admin.posts.create', compact('jurusan'));
    }

    // Simpan post baru
    public function store(Request $request)
    {
        $request->validate([
            'jurusan_id' => 'required|exists:jurusans,id',
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Cek jurusan sudah punya post
        if (Post::where('jurusan_id', $request->jurusan_id)->exists()) {
            return redirect()->back()
                ->with('error', 'Jurusan ini sudah memiliki post.')
                ->withInput();
        }

        $sections = [
            'description', 'kompetensi_dasar', 'tujuan_pembelajaran',
            'kurikulum_sinkronisasi', 'program_unggulan', 'tim_pengajar',
            'galeri_kegiatan', 'kundudi', 'industri_pasangan'
        ];

        // HTMLPurifier config
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
            'user_id' => auth()->id(),
            'title' => $request->title,
        ];

        // Simpan semua section dengan purifier
        foreach ($sections as $section) {
            $data[$section] = $request->$section ? $purifier->purify($request->$section) : null;

            // Upload foto section jika ada
            $photosKey = $section . '_photos';
            if ($request->hasFile($photosKey)) {
                $photos = [];
                foreach ($request->file($photosKey) as $photo) {
                    $filename = time() . '_' . Str::random(10) . '.' . $photo->getClientOriginalExtension();
                    $path = $photo->storeAs('uploads', $filename, 'public');
                    $photos[] = $path;
                }
                $data[$photosKey] = json_encode($photos);
            }
        }

        // Upload gambar utama
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $data['image'] = $image->storeAs('uploads', $filename, 'public');
        }

        Post::create($data);
        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil dibuat.');
    }

    // Form edit
    public function edit(Post $post)
    {
        $jurusan = Jurusan::all();
        return view('admin.posts.edit', compact('post', 'jurusan'));
    }

    // Update post
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'jurusan_id' => 'required|exists:jurusans,id',
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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

        $post->jurusan_id = $request->jurusan_id;
        $post->title = $request->title;

        foreach ($sections as $section) {
            if ($request->has($section)) {
                $post->$section = $purifier->purify($request->$section);
            }

            // Upload foto section
            $photosKey = $section . '_photos';
            if ($request->hasFile($photosKey)) {
                if ($post->$photosKey) {
                    foreach (json_decode($post->$photosKey, true) as $oldPhoto) {
                        Storage::disk('public')->delete($oldPhoto);
                    }
                }

                $uploadedPhotos = [];
                foreach ($request->file($photosKey) as $photo) {
                    $filename = time() . '_' . Str::random(10) . '.' . $photo->getClientOriginalExtension();
                    $path = $photo->storeAs('uploads', $filename, 'public');
                    $uploadedPhotos[] = $path;
                }
                $post->$photosKey = json_encode($uploadedPhotos);
            }
        }

        // Upload gambar utama
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $image = $request->file('image');
            $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
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
}
