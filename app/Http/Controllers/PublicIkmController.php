<?php

namespace App\Http\Controllers;

use App\Models\Ikm;
use App\Models\IkmKonten;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PublicIkmController extends Controller
{
    /**
     * Tampilkan detail IKM berdasarkan slug.
     */
    public function showByIkm($slug)
    {
        // Ambil data IKM berdasarkan slug
        $ikm = Ikm::where('slug', $slug)->firstOrFail();

        // Ambil semua konten yang terkait dengan IKM ini
        $konten = IkmKonten::where('ikm_id', $ikm->id)->latest()->get();

        // Siapkan menu IKM untuk navbar
        $ikms = Ikm::all();
        $ikmMenus = $ikms->mapWithKeys(function ($i) {
            return [$i->title ?? $i->name => route('ikm.show', Str::slug($i->slug ?? $i->title))];
        })->toArray();

        // Sections default (jika mau loop di view universal)
        $sections = [
            'content', 'content_section_photos', 'content_section_photos_text', 'content_section_files'
        ];

        // Gunakan Blade universal
        return view('public.ikm.show', compact('ikm', 'konten', 'sections', 'ikmMenus'));
    }

    /**
     * Ambil menu IKM untuk navbar
     */
    public function getIkmMenu()
    {
        $ikms = Ikm::all();

        $ikmMenus = $ikms->mapWithKeys(function ($i) {
            return [$i->title ?? $i->name => route('ikm.show', Str::slug($i->slug ?? $i->title))];
        })->toArray();

        return $ikmMenus;
    }
}
