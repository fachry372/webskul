<?php

namespace App\Http\Controllers;

use App\Models\Lainnya;
use App\Models\LainnyaKonten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LainnyaKontenController extends Controller
{
    public function index(Request $request)
    {
        $query = LainnyaKonten::with('lainnya');

        // Filter pencarian berdasarkan judul menu lainnya
        if ($request->filled('search')) {
            $query->whereHas('lainnya', function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('slug', 'like', '%' . $request->search . '%');
            });
        }

        // Pagination (10 per halaman)
        $kontens = $query->latest()->paginate(10);

        return view('admin.lainnya_konten.index', compact('kontens'));
    }

    public function create()
    {
        // Ambil hanya Lainnya yang belum punya konten
        $lainnyas = Lainnya::doesntHave('konten')->get();
        return view('admin.lainnya_konten.create', compact('lainnyas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lainnya_id' => 'required|exists:lainnya,id|unique:lainnya_konten,lainnya_id',
            'blocks' => 'required|array|min:1',
            'blocks.*.title' => 'nullable|string',
            'blocks.*.text' => 'nullable|string',
            'blocks.*.photos.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'blocks.*.videos.*' => 'nullable|mimes:mp4,avi,mpeg,mov,webm,quicktime|max:1048576',
            'blocks.*.videos_link.*' => 'nullable|url',
            'blocks.*.files.*' => 'nullable|mimes:pdf,doc,docx,xls,xlsx|max:5120',
        ]);

        DB::transaction(function() use ($request) {
            $konten = LainnyaKonten::create([
                'lainnya_id' => $request->lainnya_id,
            ]);

            foreach ($request->blocks as $block) {
                $photos = [];
                if (!empty($block['photos'])) {
                    foreach ($block['photos'] as $photo) {
                        $photos[] = $photo->store('lainnya/photos', 'public');
                    }
                }

                $videos = [];
                if (!empty($block['videos'])) {
                    foreach ($block['videos'] as $video) {
                        $videos[] = $video->store('lainnya/videos', 'public');
                    }
                }

                $files = [];
                if (!empty($block['files'])) {
                    foreach ($block['files'] as $file) {
                        $files[] = $file->store('lainnya/files', 'public');
                    }
                }

                $konten->blocks()->create([
                    'title'       => $block['title'],
                    'text'        => $block['text'] ?? null,
                    'photos'      => $photos,
                    'videos'      => $videos,
                    'videos_link' => !empty($block['videos_link']) ? $block['videos_link'] : null,
                    'files'       => $files,
                ]);
            }
        });

        return redirect()->route('admin.lainnya_konten.index')
            ->with('success', 'Konten berhasil ditambahkan.');
    }

    public function edit(LainnyaKonten $lainnya_konten)
    {
        $lainnya_konten->load('blocks');

        $lainnyas = Lainnya::doesntHave('konten')
            ->orWhere('id', $lainnya_konten->lainnya_id)
            ->get();

        return view('admin.lainnya_konten.edit', compact('lainnya_konten', 'lainnyas'));
    }

    public function update(Request $request, LainnyaKonten $lainnya_konten)
    {
        $request->validate([
            'lainnya_id' => 'required|exists:lainnya,id|unique:lainnya_konten,lainnya_id,' . $lainnya_konten->id,
            'blocks' => 'required|array|min:1',
            'blocks.*.title' => 'nullable|string',
            'blocks.*.text' => 'nullable|string',
            'blocks.*.photos.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'blocks.*.videos.*' => 'nullable|mimes:mp4,avi,mpeg,mov,webm,quicktime|max:1048576',
            'blocks.*.videos_link.*' => 'nullable|url',
            'blocks.*.files.*' => 'nullable|mimes:pdf,doc,docx,xls,xlsx|max:5120',
        ]);

        DB::transaction(function() use ($request, $lainnya_konten) {
            // update parent
            $lainnya_konten->update(['lainnya_id' => $request->lainnya_id]);

            foreach ($request->blocks as $idx => $block) {
                // Jika blok lama dihapus, hapus dari DB
                if(!empty($block['_delete']) && $block['id']){
                    $oldBlock = $lainnya_konten->blocks()->find($block['id']);
                    if($oldBlock){
                        // Hapus semua file lama di storage
                        foreach(array_merge($oldBlock->photos ?? [], $oldBlock->videos ?? [], $oldBlock->files ?? []) as $file){
                            Storage::disk('public')->delete($file);
                        }
                        $oldBlock->delete();
                    }
                    continue; // lanjut blok berikutnya
                }

                $oldBlock = $lainnya_konten->blocks()->find($block['id'] ?? null);

                // Hanya gabungkan file lama yang masih ada (tidak dihapus)
                $photos = $oldBlock->photos ?? [];
                $videos = $oldBlock->videos ?? [];
                $files  = $oldBlock->files  ?? [];

                if (!empty($block['_delete_files'])) {
                    foreach ($block['_delete_files'] as $filePath) {
                        Storage::disk('public')->delete($filePath);
                        $photos = array_diff($photos, [$filePath]);
                        $videos = array_diff($videos, [$filePath]);
                        $files  = array_diff($files, [$filePath]);
                    }
                }

                // Simpan file baru
                if (!empty($block['photos'])) foreach ($block['photos'] as $photo) $photos[] = $photo->store('lainnya/photos','public');
                if (!empty($block['videos'])) foreach ($block['videos'] as $video) $videos[] = $video->store('lainnya/videos','public');
                if (!empty($block['files']))  foreach ($block['files']  as $file)  $files[]  = $file->store('lainnya/files','public');

                // Link video
                $videos_link = !empty($block['videos_link'])
                    ? array_map('convertVideoLink', $block['videos_link'])
                    : ($oldBlock->videos_link ?? null);

                if($oldBlock){
                    $oldBlock->update([
                        'title'       => $block['title'] ?? $oldBlock->title,
                        'text'        => $block['text'] ?? $oldBlock->text,
                        'photos'      => array_values($photos),
                        'videos'      => array_values($videos),
                        'files'       => array_values($files),
                        'videos_link' => $videos_link,
                    ]);
                } else {
                    $lainnya_konten->blocks()->create([
                        'title'       => $block['title'] ?? null,
                        'text'        => $block['text'] ?? null,
                        'photos'      => array_values($photos),
                        'videos'      => array_values($videos),
                        'files'       => array_values($files),
                        'videos_link' => $videos_link,
                    ]);
                }
            }
        });

        return redirect()->route('admin.lainnya_konten.index')
            ->with('success', 'Konten berhasil diperbarui.');
    }



    public function destroy($id)
    {
        $konten = LainnyaKonten::findOrFail($id);

        foreach ($konten->blocks as $block) {
            foreach ($block->photos ?? [] as $p) Storage::disk('public')->delete($p);
            foreach ($block->videos ?? [] as $v) Storage::disk('public')->delete($v);
            foreach ($block->files ?? [] as $f) Storage::disk('public')->delete($f);
        }

        $konten->blocks()->delete();
        $konten->delete();

        return redirect()->route('admin.lainnya_konten.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
