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
