<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use HTMLPurifier;
use HTMLPurifier_Config;
use Illuminate\Support\Facades\DB;

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
        try {
            $request->validate([
                'jurusan_id' => 'required|exists:jurusans,id',
                'title' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Cek apakah jurusan sudah punya post
            $existing = Post::where('jurusan_id', $request->jurusan_id)->first();
            if ($existing) {
                return redirect()->back()
                    ->with('error', 'Jurusan ini sudah memiliki post, tidak bisa menambahkan post baru.')
                    ->withInput();
            }

            $sections = [
                'description', 'kompetensi_dasar', 'tujuan_pembelajaran',
                'kurikulum_sinkronisasi', 'program_unggulan', 'tim_pengajar',
                'galeri_kegiatan', 'kundudi', 'industri_pasangan'
            ];

            $config = HTMLPurifier_Config::createDefault();
            $config->set('HTML.Allowed', 'p,br,b,i,u,strong,em,strike,blockquote,code,pre,span[style],div[style],ul,ol,li,h1,h2,h3,h4,h5,h6,table,thead,tbody,tr,td,th,a[href|title|target],img[src|alt|width|height|style]');
            $purifier = new HTMLPurifier($config);

            $data = [
                'jurusan_id' => $request->jurusan_id,
                'user_id' => auth()->id(),
                'title' => $request->title,
            ];

            foreach ($sections as $section) {
                $data[$section] = $request->$section ? $purifier->purify($request->$section) : null;

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

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('uploads', $filename, 'public');
                $data['image'] = $path;
            }

            Post::create($data);
            return redirect()->route('admin.posts.index')->with('success', 'Post berhasil dibuat.');

        } catch (\Exception $e) {
            \Log::error('Create post error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat post.')->withInput();
        }
    }


    public function edit(Post $post)
    {
        $jurusan = Jurusan::all();
        return view('admin.posts.edit', compact('post', 'jurusan'));
    }

    public function update(Request $request, Post $post)
{
    try {
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

        // ✅ Perbaikan konfigurasi purifier
        $config = \HTMLPurifier_Config::createDefault();

        // Izinkan tag & atribut dasar
        $config->set('HTML.Allowed',
            'p,br,b,i,u,strong,em,strike,blockquote,code,pre,' .
            'span[style|class],div[style|class],' .
            'ul,ol,li,h1,h2,h3,h4,h5,h6,' .
            'table,thead,tbody,tr,td,th,' .
            'a[href|title|target],' .
            'img[src|alt|width|height|style|class]'
        );

        // ✅ Izinkan class alignment Quill
        $config->set('Attr.AllowedClasses', [
            'ql-align-left','ql-align-center','ql-align-right','ql-align-justify'
        ]);

        // ✅ Izinkan properti CSS text-align
        $config->set('CSS.AllowedProperties', ['text-align','width','height']);

        $purifier = new \HTMLPurifier($config);

        $post->jurusan_id = $request->jurusan_id;
        $post->title = $request->title;

        foreach ($sections as $section) {
            if ($request->has($section)) {
                $post->$section = $purifier->purify($request->$section);
            }

            // Upload photos per section
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

        // Main image
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $path = $request->file('image')->store('uploads', 'public');
            $post->image = $path;
        }

        $post->save();
        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil diperbarui.');

    } catch (\Exception $e) {
        \Log::error('Update post error: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui post.')->withInput();
    }
}


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
