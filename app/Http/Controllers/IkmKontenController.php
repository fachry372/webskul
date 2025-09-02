<?php

namespace App\Http\Controllers;

use App\Models\IkmKonten;
use App\Models\Ikm;
use App\Models\IkmKontenBlock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        // Ambil hanya IKM yang belum punya konten
        $ikms = Ikm::doesntHave('konten')->get();
        return view('admin.ikm_konten.create', compact('ikms'));
    }


    public function store(Request $request)
{

    $request->validate([
        'ikm_id' => 'required|exists:ikms,id|unique:ikm_konten,ikm_id',
        'blocks' => 'required|array|min:1',
        'blocks.*.title' => 'nullable|string|',
        'blocks.*.text' => 'nullable|string',
        'blocks.*.photos.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    'blocks.*.videos.*' => 'nullable|mimes:mp4,avi,mpeg,mov,webm,quicktime|max:1048576',

        'blocks.*.videos_link.*' => 'nullable|url',
        'blocks.*.files.*' => 'nullable|mimes:pdf,doc,docx,xls,xlsx|max:5120',
    ]);

    DB::transaction(function() use ($request) {
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
                'title'       => $block['title'],
                'text'        => $block['text'] ?? null,
                'photos'      => $photos,
                'videos'      => $videos,
                'videos_link' => !empty($block['videos_link'])
                ? array_map('convertVideoLink', $block['videos_link'])
                : null,
                'files'       => $files,
            ]);
        }
    });

    return redirect()->route('admin.ikm_konten.index')
        ->with('success', 'Konten berhasil ditambahkan.');
}

    public function show(IkmKonten $ikmKonten)
    {
        return view('admin.ikm_konten.show', compact('ikmKonten'));
    }


    public function edit(IkmKonten $ikm_konten)
    {
        $ikm_konten->load('blocks');

        $ikms = Ikm::doesntHave('konten')
            ->orWhere('id', $ikm_konten->ikm_id)
            ->get();

        return view('admin.ikm_konten.edit', compact('ikm_konten', 'ikms'));
    }


    public function update(Request $request, IkmKonten $ikm_konten)
    {
        $request->validate([
            'ikm_id' => 'required|exists:ikms,id|unique:ikm_konten,ikm_id,' . $ikm_konten->id,
            'blocks' => 'required|array|min:1',
            'blocks.*.title' => 'nullable|string',
            'blocks.*.text' => 'nullable|string',
            'blocks.*.photos.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
          'blocks.*.videos.*' => 'nullable|mimes:mp4,avi,mpeg,mov,webm,quicktime|max:1048576',


            'blocks.*.videos_link.*' => 'nullable|url',
            'blocks.*.files.*' => 'nullable|mimes:pdf,doc,docx,xls,xlsx|max:5120',
        ]);

        DB::transaction(function() use ($request, $ikm_konten) {
            // update ikm_id parent
            $ikm_konten->update([
                'ikm_id' => $request->ikm_id,
            ]);

            foreach ($request->blocks as $idx => $block) {
                $oldBlock = $ikm_konten->blocks()->find($block['id'] ?? null);

                $photos = $oldBlock->photos ?? [];
                $videos = $oldBlock->videos ?? [];
                $files  = $oldBlock->files  ?? [];

                // ✅ Hapus file lama sesuai input _delete_files
                if (!empty($block['_delete_files'])) {
                    foreach ($block['_delete_files'] as $filePath) {
                        // Hapus dari storage
                        Storage::disk('public')->delete($filePath);

                        // Hapus dari array DB
                        if (in_array($filePath, $photos)) {
                            $photos = array_values(array_diff($photos, [$filePath]));
                        }
                        if (in_array($filePath, $videos)) {
                            $videos = array_values(array_diff($videos, [$filePath]));
                        }
                        if (in_array($filePath, $files)) {
                            $files = array_values(array_diff($files, [$filePath]));
                        }
                    }
                }

                // ✅ Simpan file baru
                if (!empty($block['photos'])) {
                    foreach ($block['photos'] as $photo) {
                        $photos[] = $photo->store('ikm/photos', 'public');
                    }
                }
                if (!empty($block['videos'])) {
                    foreach ($block['videos'] as $video) {
                        $videos[] = $video->store('ikm/videos', 'public');
                    }
                }
                if (!empty($block['files'])) {
                    foreach ($block['files'] as $file) {
                        $files[] = $file->store('ikm/files', 'public');
                    }
                }

                // ✅ Link video (jika ada)
                $videos_link = !empty($block['videos_link'])
                    ? array_map('convertVideoLink', $block['videos_link'])
                    : ($oldBlock->videos_link ?? null);

                // ✅ Update blok lama atau buat baru
                if ($oldBlock) {
                    $oldBlock->update([
                        'title'       => $block['title'] ?? $oldBlock->title,
                        'text'        => $block['text'] ?? $oldBlock->text,
                        'photos'      => $photos,
                        'videos'      => $videos,
                        'videos_link' => $videos_link,
                        'files'       => $files,
                    ]);
                } else {
                    $ikm_konten->blocks()->create([
                        'title'       => $block['title'] ?? null,
                        'text'        => $block['text'] ?? null,
                        'photos'      => $photos,
                        'videos'      => $videos,
                        'videos_link' => $videos_link,
                        'files'       => $files,
                    ]);
                }
            }
        });

        return redirect()->route('admin.ikm_konten.index')
            ->with('success', 'Konten berhasil diperbarui.');
    }


// public function destroy($id)
// {
//     $konten = IkmKonten::findOrFail($id);
//     $konten->delete();

//     return redirect()->route('admin.ikm_konten.index')
//         ->with('success', 'Data berhasil dihapus');
// }

public function destroy($id)
{
    $konten = IkmKonten::findOrFail($id);

    // Hapus blok terkait
    foreach ($konten->blocks as $block) {
        foreach ($block->photos ?? [] as $p) Storage::disk('public')->delete($p);
        foreach ($block->videos ?? [] as $v) Storage::disk('public')->delete($v);
        foreach ($block->files ?? [] as $f) Storage::disk('public')->delete($f);
    }
    $konten->blocks()->delete();

    $konten->delete();

    return redirect()->route('admin.ikm_konten.index')
        ->with('success', 'Data berhasil dihapus');
}


}
