<?php

use App\Http\Controllers\JurusanController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicJurusanController;
use App\Http\Controllers\BerandaController;

Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/beranda', [BerandaController::class, 'index']);




// Route admin
// Route admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('jurusan', JurusanController::class);

    // Tambahkan show route
    Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');

    Route::resource('posts', PostController::class)->except(['show']); // Hindari duplikasi
    Route::post('posts/upload', [PostController::class, 'upload'])->name('posts.upload');
    Route::post('posts/upload-photos', [PostController::class, 'uploadPhotos'])->name('posts.upload-photos');
});


// Route autentikasi
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// routes/web.php



Route::get('/jurusan/{slug}', [PublicJurusanController::class, 'showByJurusan'])->name('jurusan.show');
Route::post('/admin/posts/upload-file', [PostController::class, 'uploadFile'])->name('admin.posts.uploadFile');



require __DIR__.'/auth.php';
