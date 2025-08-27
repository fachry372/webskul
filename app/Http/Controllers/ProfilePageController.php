<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Support\Str;

class ProfilePageController extends Controller
{
    /**
     * Tampilkan halaman profil berdasarkan slug.
     */
    public function showByProfile($slug)
    {
        // Ambil data profile berdasarkan slug
        $profile = Profile::where('slug', $slug)->firstOrFail();

        // Tentukan nama view berdasarkan slug
        // contoh: slug "data-pokok-sekolah" → view: public.profile.data_pokok_sekolah
        $viewName = 'public.profile.' . str_replace('-', '_', $profile->slug);

        if (!view()->exists($viewName)) {
            // fallback: pakai 1 view umum untuk semua profile
            $viewName = 'public.profile.show';
        }

        return view($viewName, compact('profile'));
    }

    /**
     * Ambil menu Profil untuk dropdown.
     */
    public function getProfileMenu()
    {
        $profiles = Profile::all();
        $profileMenus = $profiles->mapWithKeys(function ($profile) {
            return [$profile->title => route('profile.show', $profile->slug)];
        })->toArray();

        return $profileMenus;
    }
}
