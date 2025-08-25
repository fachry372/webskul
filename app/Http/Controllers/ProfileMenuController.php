<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileMenuController extends Controller
{
   public function index()
   {
       $menus = Menu::with('profile')->latest()->get();
       return view('admin.profile_menus.index', compact('menus'));
   }

   public function create()
{
    // Ambil profile yang belum memiliki menu
    $profiles = Profile::doesntHave('menus')->get();

    return view('admin.profile_menus.create', compact('profiles'));
}

public function store(Request $request)
{
    $request->validate([
        'profile_id' => 'required|exists:profiles,id',
        'title' => 'nullable|string|max:255',
        'content_section' => 'nullable|string', // tetap dari form
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        'content_section_photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        'content_section_files.*' => 'nullable|file|max:10240',
        'content_section_photos_text' => 'nullable|string',
    ]);

    $menu = new Menu();
    $menu->profile_id = $request->profile_id;
    $menu->title = $request->title;

    // ini penting: ambil dari form content_section lalu simpan ke kolom content
    $menu->content = $request->content_section;
    $menu->content_section_photos_text = $request->content_section_photos_text;

    // upload image utama
    if ($request->hasFile('image')) {
        $menu->image = $request->file('image')->store('menus', 'public');
    }

    // upload photos
    $photosArray = [];
    if ($request->hasFile('content_section_photos')) {
        foreach ($request->file('content_section_photos') as $photo) {
            $photosArray[] = $photo->store('menus/photos', 'public');
        }
    }
    $menu->content_section_photos = json_encode($photosArray);

    // upload files
    $filesArray = [];
    if ($request->hasFile('content_section_files')) {
        foreach ($request->file('content_section_files') as $file) {
            $filesArray[] = $file->store('menus/files', 'public');
        }
    }
    $menu->content_section_files = json_encode($filesArray);

    $menu->save();

    return redirect()->route('menus.index')->with('success', 'Menu berhasil dibuat.');
}


public function edit(Menu $menu)
{
    // Ambil profile yang belum memiliki menu atau profile yang sedang dipakai menu ini
    $profiles = Profile::whereDoesntHave('menus')
        ->orWhere('id', $menu->profile_id)
        ->get();

    return view('admin.profile_menus.edit', compact('menu', 'profiles'));
}

public function update(Request $request, Menu $menu)
{
    $request->validate([
        'profile_id' => 'required|exists:profiles,id',
        'content_section' => 'nullable|string',
        'content_section_photos_text' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        'content_section_photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        'content_section_files.*' => 'nullable|file|max:10240',
        'old_photos' => 'nullable|array',
        'old_photos.*' => 'string',
        'old_files' => 'nullable|array',
        'old_files.*' => 'string',
    ]);

    // Update data dasar
    $menu->profile_id = $request->profile_id;
    $menu->content = $request->content_section;
    $menu->content_section_photos_text = $request->content_section_photos_text;

    // Hapus image utama jika diminta
    if($request->has('delete_image') && $menu->image){
        Storage::disk('public')->delete($menu->image);
        $menu->image = null;
    }

    // Upload image utama baru
    if($request->hasFile('image')){
        if($menu->image) Storage::disk('public')->delete($menu->image);
        $menu->image = $request->file('image')->store('menus', 'public');
    }

    // ===== FOTO =====
    $existingPhotos = $menu->content_section_photos ? json_decode($menu->content_section_photos, true) : [];
    $oldPhotos = $request->old_photos ?? [];
    $existingPhotos = array_filter($existingPhotos, fn($photo) => in_array($photo, $oldPhotos));

    // Tambahkan foto baru
    if($request->hasFile('content_section_photos')){
        foreach($request->file('content_section_photos') as $photo){
            $existingPhotos[] = $photo->store('menus/photos', 'public');
        }
    }
    $menu->content_section_photos = json_encode(array_values($existingPhotos));

    // ===== FILE =====
    $existingFiles = $menu->content_section_files ? json_decode($menu->content_section_files, true) : [];
    $oldFiles = $request->old_files ?? [];
    $existingFiles = array_filter($existingFiles, fn($file) => in_array($file, $oldFiles));

    // Tambahkan file baru
    if($request->hasFile('content_section_files')){
        foreach($request->file('content_section_files') as $file){
            $existingFiles[] = $file->store('menus/files', 'public');
        }
    }
    $menu->content_section_files = json_encode(array_values($existingFiles));

    $menu->save();

    return redirect()->route('menus.index')->with('success', 'Menu berhasil diperbarui.');
}


   public function destroy(Menu $menu)
   {
       if($menu->image) Storage::disk('public')->delete($menu->image);

       if($menu->content_section_photos){
           foreach(json_decode($menu->content_section_photos, true) as $photo){
               Storage::disk('public')->delete($photo);
           }
       }

       if($menu->content_section_files){
           foreach(json_decode($menu->content_section_files, true) as $file){
               Storage::disk('public')->delete($file);
           }
       }

       $menu->delete();

       return redirect()->route('menus.index')->with('success', 'Menu berhasil dihapus.');
   }
}
