<?php

use App\Http\Controllers\JurusanController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicJurusanController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\ProfileMenuController;

Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/beranda', [BerandaController::class, 'index']);




// Route admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('jurusan', JurusanController::class);
    Route::resource('posts', PostController::class);
    Route::post('posts/upload', [PostController::class, 'upload'])->name('posts.upload');
    Route::post('posts/upload-photos', [PostController::class, 'uploadPhotos'])->name('posts.upload-photos');
});


Route::get('/jurusan/{slug}', [PublicJurusanController::class, 'showByJurusan'])->name('jurusan.show');
Route::post('/admin/posts/upload-file', [PostController::class, 'uploadFile'])->name('admin.posts.uploadFile');

// CRUD Profile
Route::get('/admin/profiles', [ProfileController::class, 'index'])->name('profiles.index');
Route::get('/admin/profiles/create', [ProfileController::class, 'create'])->name('profiles.create');
Route::post('/admin/profiles', [ProfileController::class, 'store'])->name('profiles.store');
Route::get('/admin/profiles/{profile}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
Route::put('/admin/profiles/{profile}', [ProfileController::class, 'update'])->name('profiles.update');
Route::delete('/admin/profiles/{profile}', [ProfileController::class, 'destroy'])->name('profiles.destroy');

// CRUD Menu Profile
// Tampilkan semua menu
Route::get('/admin/menus', [ProfileMenuController::class, 'index'])->name('menus.index');

// Tampilkan form tambah menu
Route::get('/admin/menus/create', [ProfileMenuController::class, 'create'])->name('menus.create');

// Simpan menu baru
Route::post('/admin/menus', [ProfileMenuController::class, 'store'])->name('menus.store');

// Edit menu
Route::get('/admin/menus/{menu}/edit', [ProfileMenuController::class, 'edit'])->name('menus.edit');

// Update menu
Route::put('/admin/menus/{menu}', [ProfileMenuController::class, 'update'])->name('menus.update');

// Hapus menu
Route::delete('/admin/menus/{menu}', [ProfileMenuController::class, 'destroy'])->name('menus.destroy');

use App\Http\Controllers\PublicProfileController;

Route::get('/profil/{slug}', [PublicProfileController::class, 'showByProfile'])->name('profil.show');


use App\Http\Controllers\IkmController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('ikm', IkmController::class);
});

use App\Http\Controllers\IkmKontenController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('ikm_konten', IkmKontenController::class);
    Route::delete('/admin/ikm_konten/block/{block}', [IkmKontenController::class, 'destroy'])->name('admin.ikm_konten.block.destroy');

});

use App\Http\Controllers\PublicIkmController;

Route::get('/ikm/{slug}', [PublicIkmController::class, 'show'])->name('ikm.show');



require __DIR__.'/auth.php';
