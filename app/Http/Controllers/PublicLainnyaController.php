<?php

namespace App\Http\Controllers;

use App\Models\Lainnya;
use App\Models\LainnyaKonten;
use Illuminate\Http\Request;

class PublicLainnyaController extends Controller
{
    public function show($slug)
    {
        // Ambil Lainnya berdasarkan slug
        $lainnya = Lainnya::where('slug', $slug)->firstOrFail();

        // Ambil semua konten terkait Lainnya beserta blocks
        $kontens = LainnyaKonten::with('blocks')
            ->where('lainnya_id', $lainnya->id)
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
            $blocks = $konten->blocks->toArray();
            $count = count($blocks);

            for ($i = 0; $i < $count; $i++) {
                $block = $konten->blocks[$i];

                if ($isBlockValid($block)) {
                    $newBlocks[] = $block;
                } else {
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

            $konten->blocks = collect($newBlocks);
        }

        // Ambil menu Lainnya untuk navbar menggunakan method yang sama
        $menus = $this->getLainnyaMenu();

        return view('public.lainnya.show', compact('lainnya', 'kontens', 'menus'));
    }

    public function getLainnyaMenu()
    {
        $lainnyas = Lainnya::all();
        $menus = $lainnyas->mapWithKeys(function ($i) {
            return [$i->title ?? $i->name => route('lainnya.show', $i->slug)];
        })->toArray();
        return $menus;
    }
}
