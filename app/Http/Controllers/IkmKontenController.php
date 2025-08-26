<?php

namespace App\Http\Controllers;

use App\Models\IkmKonten;
use App\Models\Ikm;
use App\Models\IkmKontenBlock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IkmKontenController extends Controller
{
    public function index()
    {
        $konten = IkmKonten::with('ikm')->latest()->get();
        return view('admin.ikm_konten.index', compact('konten'));
    }

    public function create()
    {
        $ikms = Ikm::all();
        return view('admin.ikm_konten.create', compact('ikms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ikm_id' => 'required|exists:ikms,id',
            'blocks' => 'required|array|min:1',
            'blocks.*.title' => 'required|string|max:255',
            'blocks.*.text' => 'nullable|string',
            'blocks.*.photos.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'blocks.*.videos.*' => 'nullable|mimetypes:video/mp4,video/avi,video/mpeg|max:10240',
            'blocks.*.files.*' => 'nullable|mimes:pdf,doc,docx,xls,xlsx|max:5120',
        ]);

        DB::transaction(function() use ($request) {
            // Buat konten induk
            $konten = IkmKonten::create([
                'ikm_id' => $request->ikm_id,
            ]);

            foreach ($request->blocks as $block) {
                $photos = [];
                if (!empty($block['photos'])) {
                    foreach ($block['photos'] as $photo) {
                        $photos[] = $photo->store('ikm/photos', 'public');
                    }
                }

                $videos = [];
                if (!empty($block['videos'])) {
                    foreach ($block['videos'] as $video) {
                        $videos[] = $video->store('ikm/videos', 'public');
                    }
                }

                $files = [];
                if (!empty($block['files'])) {
                    foreach ($block['files'] as $file) {
                        $files[] = $file->store('ikm/files', 'public');
                    }
                }

                $konten->blocks()->create([
                    'title' => $block['title'],
                    'text'  => $block['text'] ?? null,
                    'photos'=> $photos,
                    'videos'=> $videos,
                    'files' => $files,
                ]);
            }
        });

        return redirect()->route('admin.ikm_konten.index')->with('success', 'Konten berhasil ditambahkan.');
    }

    public function show(IkmKonten $ikmKonten)
    {
        return view('admin.ikm_konten.show', compact('ikmKonten'));
    }


public function edit(IkmKonten $ikmKonten)
{
    $ikms = Ikm::all(); // list IKM untuk select
    return view('admin.ikm_konten.edit', compact('ikmKonten', 'ikms'));
}

public function update(Request $request, IkmKonten $ikmKonten)
{
    $request->validate([
        'ikm_id' => 'required|exists:ikms,id',
        'blocks' => 'required|array|min:1',
        'blocks.*.title' => 'required|string|max:255',
        'blocks.*.text' => 'nullable|string',
        'blocks.*.photos.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'blocks.*.videos.*' => 'nullable|mimetypes:video/mp4,video/avi,video/mpeg|max:10240',
        'blocks.*.files.*' => 'nullable|mimes:pdf,doc,docx,xls,xlsx|max:5120',
    ]);

    DB::transaction(function() use ($request, $ikmKonten) {
        // Update konten induk
        $ikmKonten->update([
            'ikm_id' => $request->ikm_id,
        ]);

        // Hapus blok yang lama (atau bisa pilih logika update per blok id jika ada)
        foreach ($ikmKonten->blocks as $oldBlock) {
            // Hapus file lama
            foreach (['photos','videos','files'] as $type) {
                if ($oldBlock->$type) {
                    foreach ($oldBlock->$type as $file) {
                        Storage::disk('public')->delete($file);
                    }
                }
            }
            $oldBlock->delete();
        }

        // Simpan blok baru
        foreach ($request->blocks as $block) {
            $photos = $block['old_photos'] ?? [];
            if (!empty($block['photos'])) {
                foreach ($block['photos'] as $photo) {
                    $photos[] = $photo->store('ikm/photos', 'public');
                }
            }

            $videos = $block['old_videos'] ?? [];
            if (!empty($block['videos'])) {
                foreach ($block['videos'] as $video) {
                    $videos[] = $video->store('ikm/videos', 'public');
                }
            }

            $files = $block['old_files'] ?? [];
            if (!empty($block['files'])) {
                foreach ($block['files'] as $file) {
                    $files[] = $file->store('ikm/files', 'public');
                }
            }

            $ikmKonten->blocks()->create([
                'title' => $block['title'],
                'text'  => $block['text'] ?? null,
                'photos'=> $photos,
                'videos'=> $videos,
                'files' => $files,
            ]);
        }
    });

    return redirect()->route('admin.ikm_konten.index')->with('success', 'Konten berhasil diperbarui.');
}

public function destroy(IkmKonten $ikmKonten)
{
    foreach ($ikmKonten->blocks as $block) {
        foreach (['photos','videos','files'] as $type) {
            if (!empty($block->$type)) {
                foreach ($block->$type as $file) {
                    Storage::disk('public')->delete($file);
                }
            }
        }
    }

    $ikmKonten->blocks()->delete();
    $ikmKonten->delete();

    return redirect()->route('admin.ikm_konten.index')->with('success', 'Konten berhasil dihapus.');
}




}
