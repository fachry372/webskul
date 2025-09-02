<?php

namespace App\Http\Controllers;

use App\Models\Kelulusan;
use App\Models\KelulusanBlock;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KelulusanController extends Controller
{
    public function index()
    {
        $kelulusans = Kelulusan::latest()->get();
        return view('admin.kelulusan.index', compact('kelulusans'));
    }

    public function create()
    {
        $kelulusans = Kelulusan::latest()->get();
        $canCreateNew = $kelulusans->isEmpty(); // hanya boleh buat baru kalau belum ada kelulusan

        return view('admin.kelulusan.create', compact('kelulusans', 'canCreateNew'));
    }

    public function store(Request $request)
    {
        if (Kelulusan::count() > 0) {
            $request->validate([
                'kelulusan_id' => 'required|exists:kelulusans,id',
                'blocks' => 'nullable|array',
            ]);

            $kelulusan = Kelulusan::findOrFail($request->kelulusan_id);
        } else {
            $request->validate([
                'judul' => 'required|string|max:255|unique:kelulusans,judul',
                'blocks' => 'nullable|array',
            ]);

            $kelulusan = Kelulusan::create([
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
                            $photos[] = $photo->store('kelulusan/photos', 'public');
                        }
                    }
                }

                $videos = [];
                if (!empty($block['videos'])) {
                    foreach ($block['videos'] as $video) {
                        if (is_file($video)) {
                            $videos[] = $video->store('kelulusan/videos', 'public');
                        }
                    }
                }

                $files = [];
                if (!empty($block['files'])) {
                    foreach ($block['files'] as $file) {
                        if (is_file($file)) {
                            $files[] = $file->store('kelulusan/files', 'public');
                        }
                    }
                }

                KelulusanBlock::create([
                    'kelulusan_id' => $kelulusan->id,
                    'title' => $block['title'] ?? null,
                    'text' => $block['text'] ?? null,
                    'photos' => !empty($photos) ? json_encode($photos) : null,
                    'videos' => !empty($videos) ? json_encode($videos) : null,
                    'files' => !empty($files) ? json_encode($files) : null,
                    'videos_link' => !empty($block['videos_link']) ? json_encode(array_filter($block['videos_link'])) : null,
                ]);
            }
        }

        return redirect()->route('admin.kelulusan.index')->with('success', 'Konten kelulusan berhasil disimpan.');
    }

    public function edit(Kelulusan $kelulusan)
    {
        $kelulusan->load('blocks');
        return view('admin.kelulusan.edit', compact('kelulusan'));
    }

    public function update(Request $request, Kelulusan $kelulusan)
    {
        $request->validate([
            'judul' => 'required|string|max:255|unique:kelulusans,judul,' . $kelulusan->id,
            'blocks' => 'nullable|array',
        ]);

        // Update judul & slug
        $kelulusan->update([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
        ]);

        if ($request->has('blocks')) {
            foreach ($request->blocks as $index => $block) {

                // Hapus blok jika dicentang
                if (isset($block['_delete']) && $block['_delete']) {
                    if (isset($block['id'])) {
                        KelulusanBlock::find($block['id'])->delete();
                    }
                    continue;
                }

                // Ambil blok lama jika ada
                $kelulusanBlock = $block['id'] ? KelulusanBlock::find($block['id']) : new KelulusanBlock();
                $kelulusanBlock->kelulusan_id = $kelulusan->id;
                $kelulusanBlock->title = $block['title'] ?? null;
                $kelulusanBlock->text = $block['text'] ?? null;

                // === FOTO ===
                $oldPhotos = $block['id'] ? json_decode(KelulusanBlock::find($block['id'])->photos, true) ?? [] : [];
                $deletedPhotos = $block['_delete_files'] ?? [];
                $remainingPhotos = array_diff($oldPhotos, $deletedPhotos);
                $newPhotos = [];
                if (!empty($block['photos'])) {
                    foreach ($block['photos'] as $photo) {
                        if (is_file($photo)) $newPhotos[] = $photo->store('kelulusan/photos', 'public');
                    }
                }
                $kelulusanBlock->photos = json_encode(array_merge($remainingPhotos, $newPhotos));

                // === VIDEO ===
                $oldVideos = $block['id'] ? json_decode(KelulusanBlock::find($block['id'])->videos, true) ?? [] : [];
                $deletedVideos = $block['_delete_files'] ?? [];
                $remainingVideos = array_diff($oldVideos, $deletedVideos);
                $newVideos = [];
                if (!empty($block['videos'])) {
                    foreach ($block['videos'] as $video) {
                        if (is_file($video)) $newVideos[] = $video->store('kelulusan/videos', 'public');
                    }
                }
                $kelulusanBlock->videos = json_encode(array_merge($remainingVideos, $newVideos));

                // === FILE LAIN ===
                $oldFiles = $block['id'] ? json_decode(KelulusanBlock::find($block['id'])->files, true) ?? [] : [];
                $deletedFiles = $block['_delete_files'] ?? [];
                $remainingFiles = array_diff($oldFiles, $deletedFiles);
                $newFiles = [];
                if (!empty($block['files'])) {
                    foreach ($block['files'] as $file) {
                        if (is_file($file)) $newFiles[] = $file->store('kelulusan/files', 'public');
                    }
                }
                $kelulusanBlock->files = json_encode(array_merge($remainingFiles, $newFiles));

                // === LINK VIDEO ===
                $kelulusanBlock->videos_link = !empty($block['videos_link']) ? json_encode(array_filter($block['videos_link'])) : null;

                $kelulusanBlock->save();
            }
        }

        return redirect()->route('admin.kelulusan.index')->with('success', 'Kelulusan berhasil diperbarui.');
    }

    public function destroy(Kelulusan $kelulusan)
    {
        $kelulusan->delete();
        return redirect()->route('admin.kelulusan.index')->with('success', 'Kelulusan berhasil dihapus.');
    }
}
