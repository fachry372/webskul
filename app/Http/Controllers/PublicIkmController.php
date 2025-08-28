<?php

namespace App\Http\Controllers;

use App\Models\Ikm;
use App\Models\IkmKonten;
use App\Models\IkmKontenBlock;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PublicIkmController extends Controller
{
    public function show($slug)
{
    // Ambil IKM berdasarkan slug
    $ikm = Ikm::where('slug', $slug)->firstOrFail();

    // Ambil semua konten terkait IKM beserta blocks
    $kontens = IkmKonten::with('blocks')
        ->where('ikm_id', $ikm->id)
        ->latest()
        ->get();

    // Helper cek block valid
    $isBlockValid = function($block) {
        return $block->title || $block->text
            || (!empty($block->photos) && is_array($block->photos))
            || (!empty($block->videos) && is_array($block->videos))
            || (!empty($block->videos_link) && is_array($block->videos_link))
            || (!empty($block->files) && is_array($block->files));
    };

    // Merge block kosong dengan block valid berikutnya
    foreach ($kontens as $konten) {
        $newBlocks = [];
        $blocks = $konten->blocks->toArray(); // supaya bisa di-loop dengan index
        $count = count($blocks);

        for ($i = 0; $i < $count; $i++) {
            $block = $konten->blocks[$i];

            if ($isBlockValid($block)) {
                $newBlocks[] = $block;
            } else {
                // Cari block valid berikutnya
                $nextBlock = null;
                for ($j = $i + 1; $j < $count; $j++) {
                    if ($isBlockValid($konten->blocks[$j])) {
                        $nextBlock = $konten->blocks[$j];
                        break;
                    }
                }

                if ($nextBlock) {
                    $newBlocks[] = $nextBlock;
                }
            }
        }

        // Ganti blocks original dengan blocks yang sudah di-merge
        $konten->blocks = collect($newBlocks);
    }

    // Ambil semua IKM untuk navbar/menu
    $ikms = Ikm::all();

    return view('public.ikm.show', compact('ikm', 'kontens', 'ikms'));
}

    public function getIkmMenu()
    {
        $ikms = Ikm::all();
        $ikmMenus = $ikms->mapWithKeys(function ($i) {
            return [$i->title ?? $i->name => route('ikm.show', $i->slug)];
        })->toArray();
        return $ikmMenus;
    }
}
