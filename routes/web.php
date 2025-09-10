<?php

use App\Http\Controllers\JurusanController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicJurusanController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\ProfileMenuController;
use App\Http\Controllers\PublicProfileController;
use App\Http\Controllers\IkmController;
use App\Http\Controllers\IkmKontenController;
use App\Http\Controllers\PublicIkmController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\PublicGaleriController;
use App\Http\Controllers\KelulusanController;
use App\Http\Controllers\PublicKelulusanController;
use App\Http\Controllers\InformasiTerbaruController;
use App\Http\Controllers\KategoriInformasiController;
use App\Http\Controllers\PublicInformasiController;
use App\Http\Controllers\LainnyaController;
use App\Http\Controllers\LainnyaKontenController;
use App\Http\Controllers\PublicLainnyaController;
use App\Http\Controllers\SaranController;
use App\Http\Controllers\StatistikController;

Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/beranda', [BerandaController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ✅ Route admin utama
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('jurusan', JurusanController::class);
    Route::resource('posts', PostController::class);
    Route::post('posts/upload', [PostController::class, 'upload'])->name('posts.upload');
    Route::post('posts/upload-photos', [PostController::class, 'uploadPhotos'])->name('posts.upload-photos');
});

// ✅ Tambahin middleware ke routes admin yang tadinya di luar
Route::middleware(['auth', 'admin'])->group(function () {
    // Upload file posts
    Route::post('/admin/posts/upload-file', [PostController::class, 'uploadFile'])->name('admin.posts.uploadFile');

    // CRUD Profile
    Route::get('/admin/profiles', [ProfileController::class, 'index'])->name('profiles.index');
    Route::get('/admin/profiles/create', [ProfileController::class, 'create'])->name('profiles.create');
    Route::post('/admin/profiles', [ProfileController::class, 'store'])->name('profiles.store');
    Route::get('/admin/profiles/{profile}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
    Route::put('/admin/profiles/{profile}', [ProfileController::class, 'update'])->name('profiles.update');
    Route::delete('/admin/profiles/{profile}', [ProfileController::class, 'destroy'])->name('profiles.destroy');

    // CRUD Menu Profile
    Route::get('/admin/menus', [ProfileMenuController::class, 'index'])->name('menus.index');
    Route::get('/admin/menus/create', [ProfileMenuController::class, 'create'])->name('menus.create');
    Route::post('/admin/menus', [ProfileMenuController::class, 'store'])->name('menus.store');
    Route::get('/admin/menus/{menu}/edit', [ProfileMenuController::class, 'edit'])->name('menus.edit');
    Route::put('/admin/menus/{menu}', [ProfileMenuController::class, 'update'])->name('menus.update');
    Route::delete('/admin/menus/{menu}', [ProfileMenuController::class, 'destroy'])->name('menus.destroy');

    // CRUD IKM
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('ikm', IkmController::class);
    });

    // CRUD IKM Konten
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('ikm_konten', IkmKontenController::class);
        Route::delete('/admin/ikm_konten/block/{block}', [IkmKontenController::class, 'destroy'])
            ->name('admin.ikm_konten.block.destroy');



Route::resource('galeri', GaleriController::class)->names('galeri');
Route::resource('kelulusan', KelulusanController::class)->names('kelulusan');

Route::resource('admin/informasi', InformasiTerbaruController::class);
Route::resource('admin/kategori', KategoriInformasiController::class);

Route::resource('lainnya', LainnyaController::class);
Route::resource('lainnya_konten', LainnyaKontenController::class);

Route::get('/saran', [SaranController::class, 'index'])->name('saran.index');
Route::get('/saran/{saran}', [SaranController::class, 'show'])->name('saran.show');


    });
});

// ✅ Route publik (tidak pakai middleware)
Route::get('/jurusan/{slug}', [PublicJurusanController::class, 'showByJurusan'])->name('jurusan.show');
Route::get('/profil/{slug}', [PublicProfileController::class, 'showByProfile'])->name('profil.show');
Route::get('/ikm/{slug}', [PublicIkmController::class, 'show'])->name('ikm.show');
Route::get('/galeri/{slug}', [PublicGaleriController::class, 'show'])->name('galeri.show');
Route::get('/kelulusan/{slug}', [PublicKelulusanController::class, 'show'])->name('kelulusan.show');

// ✅ Route publik informasi
Route::get('/informasi', [PublicInformasiController::class, 'index'])->name('informasi.index');
Route::get('/informasi/{slug}', [PublicInformasiController::class, 'show'])->name('informasi.show');

Route::get('/lainnya/{slug}', [PublicLainnyaController::class, 'show'])->name('lainnya.show');

Route::post('/saran', [SaranController::class, 'store'])->name('saran.store');

Route::get('/', [StatistikController::class, 'index'])->name('beranda');

// routes/web.php
Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search');

// ✅ Route auth Breeze
require __DIR__.'/auth.php';
