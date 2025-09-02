<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\GaleriBlock;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::latest()->get();
        return view('admin.galeri.index', compact('galeris'));
    }

    public function create()
    {
        $galeris = Galeri::latest()->get();
        $canCreateNew = $galeris->isEmpty(); // hanya boleh buat baru kalau belum ada galeri

        return view('admin.galeri.create', compact('galeris', 'canCreateNew'));
    }

    public function store(Request $request)
{
    if (Galeri::count() > 0) {
        $request->validate([
            'galeri_id' => 'required|exists:galeris,id',
            'blocks' => 'nullable|array',
        ]);

        $galeri = Galeri::findOrFail($request->galeri_id);
    } else {
        $request->validate([
            'judul' => 'required|string|max:255|unique:galeris,judul',
            'blocks' => 'nullable|array',
        ]);

        $galeri = Galeri::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
        ]);
    }

    if ($request->has('blocks')) {
        foreach ($request->blocks as $block) {
            $photos = [];
            if (!empty($block['photos'])) {
                foreach ($block['photos'] as $photo) {
                    if (is_file($photo)) {
                        $photos[] = $photo->store('galeri/photos', 'public');
                    }
                }
            }

            $videos = [];
            if (!empty($block['videos'])) {
                foreach ($block['videos'] as $video) {
                    if (is_file($video)) {
                        $videos[] = $video->store('galeri/videos', 'public');
                    }
                }
            }

            $files = [];
            if (!empty($block['files'])) {
                foreach ($block['files'] as $file) {
                    if (is_file($file)) {
                        $files[] = $file->store('galeri/files', 'public');
                    }
                }
            }

            GaleriBlock::create([
                'galeri_id' => $galeri->id,
                'title' => $block['title'] ?? null,
                'text' => $block['text'] ?? null,
                'photos' => !empty($photos) ? json_encode($photos) : null,
                'videos' => !empty($videos) ? json_encode($videos) : null,
                'files' => !empty($files) ? json_encode($files) : null,
                'videos_link' => !empty($block['videos_link']) ? json_encode(array_filter($block['videos_link'])) : null,
            ]);
        }
    }

    return redirect()->route('admin.galeri.index')->with('success', 'Konten galeri berhasil disimpan.');
}
    public function edit(Galeri $galeri)
    {
        $galeri->load('blocks');
        return view('admin.galeri.edit', compact('galeri'));
    }


    public function update(Request $request, Galeri $galeri)
{
    $request->validate([
        'judul' => 'required|string|max:255|unique:galeris,judul,' . $galeri->id,
        'blocks' => 'nullable|array',
    ]);

    $galeri->update([
        'judul' => $request->judul,
        'slug' => Str::slug($request->judul),
    ]);

    // Hapus blok lama
    $galeri->blocks()->delete();

    if ($request->has('blocks')) {
        foreach ($request->blocks as $block) {
            $photos = [];
            if (!empty($block['photos'])) {
                foreach ($block['photos'] as $photo) {
                    if (is_file($photo)) $photos[] = $photo->store('galeri/photos', 'public');
                }
            }

            $videos = [];
            if (!empty($block['videos'])) {
                foreach ($block['videos'] as $video) {
                    if (is_file($video)) $videos[] = $video->store('galeri/videos', 'public');
                }
            }

            $files = [];
            if (!empty($block['files'])) {
                foreach ($block['files'] as $file) {
                    if (is_file($file)) $files[] = $file->store('galeri/files', 'public');
                }
            }

            GaleriBlock::create([
                'galeri_id' => $galeri->id,
                'title' => $block['title'] ?? null,
                'text' => $block['text'] ?? null,
                'photos' => !empty($photos) ? json_encode($photos) : null,
                'videos' => !empty($videos) ? json_encode($videos) : null,
                'files' => !empty($files) ? json_encode($files) : null,
                'videos_link' => !empty($block['videos_link']) ? json_encode(array_filter($block['videos_link'])) : null,
            ]);
        }
    }

    return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil diperbarui.');
}

    public function destroy(Galeri $galeri)
    {
        $galeri->delete();
        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil dihapus.');
    }
}
