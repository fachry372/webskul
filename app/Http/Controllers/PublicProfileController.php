<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PublicProfileController extends Controller
{
    /**
     * Tampilkan detail profil berdasarkan slug.
     */
    public function showByProfile($slug)
    {
        // Ambil data profil berdasarkan slug
        $profile = Profile::where('slug', $slug)->firstOrFail();

        // Ambil semua menu yang terkait profil ini
        $menus = Menu::where('profile_id', $profile->id)->latest()->get();

        // Siapkan menu profil untuk navbar
        $profiles = Profile::all();
        $profileMenus = $profiles->mapWithKeys(function ($p) {
            return [$p->title ?? $p->name => route('profil.show', Str::slug($p->slug ?? $p->title))];
        })->toArray();

        // Sections default (jika mau loop di view)
        $sections = [
            'content', 'content_section_photos', 'content_section_photos_text', 'content_section_files'
        ];

        // Gunakan Blade universal
        return view('public.profil.show', compact('profile', 'menus', 'sections', 'profileMenus'));
    }

    /**
     * Ambil menu profil untuk navbar
     */
    public function getProfileMenu()
    {
        $profiles = Profile::all();

        $profileMenus = $profiles->mapWithKeys(function ($p) {
            return [$p->title ?? $p->name => route('profil.show', Str::slug($p->slug ?? $p->title))];
        })->toArray();

        return $profileMenus;
    }
}
