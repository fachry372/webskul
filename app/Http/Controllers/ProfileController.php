<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProfileController extends Controller
{

    // =========================
    // CRUD Profile
    // =========================

    // Tampilkan semua profile
    public function index()
    {
        $profiles = Profile::with('menus')->get(); // Ambil semua profile beserta menunya
        return view('admin.profiles.index', compact('profiles'));
    }

    // Form tambah profile
    public function create()
    {
        return view('admin.profiles.create');
    }

    // Simpan profile baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:profiles',
        ]);

        Profile::create([
            'title' => $request->title,
            'slug'  => Str::slug($request->title), // otomatis bikin slug
        ]);

        return redirect()->route('profiles.index')->with('success', 'Profil berhasil ditambahkan');
    }

    // Form edit profile
    public function edit(Profile $profile)
    {
        return view('admin.profiles.edit', compact('profile'));
    }

    // Update profile
    public function update(Request $request, Profile $profile)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:profiles,title,' . $profile->id,
        ]);

        $profile->update([
            'title' => $request->title,
            'slug'  => Str::slug($request->title),
        ]);

        return redirect()->route('profiles.index')->with('success', 'Profil berhasil diperbarui');
    }

    // Hapus profile
    public function destroy(Profile $profile)
    {
        foreach ($profile->menus as $menu) {
            $photos = json_decode($menu->content_section_photos, true) ?? [];
            $files  = json_decode($menu->content_section_files, true) ?? [];

            if (
                !empty($menu->content) ||
                count($photos) > 0 ||
                count($files) > 0
            ) {
                return redirect()->route('profiles.index')
                    ->with('error', 'Profile ini memiliki menu dengan konten, sehingga tidak dapat dihapus.');
            }
        }

        $profile->delete();
        return redirect()->route('profiles.index')->with('success', 'Profil berhasil dihapus');
    }




}
