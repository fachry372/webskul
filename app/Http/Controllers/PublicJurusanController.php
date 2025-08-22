<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PublicJurusanController extends Controller
{
    /**
     * Tampilkan detail jurusan berdasarkan slug.
     */
    public function showByJurusan($slug)
    {
        // Ambil data jurusan berdasarkan slug
        $jurusan = Jurusan::where('slug', $slug)->firstOrFail();

        // Ambil post yang terkait dengan jurusan ini
        $posts = Post::where('jurusan_id', $jurusan->id)->latest()->get();

        // Siapkan data menu kompetensi keahlian
        $jurusans = Jurusan::all();
        $kompetensiKeahlian = $jurusans->mapWithKeys(function ($jurusan) {
            return [$jurusan->name => route('jurusan.show', Str::slug($jurusan->name))];
        })->toArray();

        // Definisikan sections untuk looping di view
        $sections = [
            'description', 'kompetensi_dasar', 'tujuan_pembelajaran', 'kurikulum_sinkronisasi',
            'program_unggulan', 'tim_pengajar', 'galeri_kegiatan', 'kundudi', 'industri_pasangan'
        ];

        // Tentukan nama view berdasarkan slug
        $viewName = 'public.jurusan.' . str_replace('-', '_', $jurusan->slug);

        if (!view()->exists($viewName)) {
            abort(404, 'View untuk jurusan ini tidak ditemukan.');
        }

        // Kirim semua data yang dibutuhkan ke view.
        // Data post sudah aman dan tidak perlu diproses ulang.
        return view($viewName, compact('jurusan', 'posts', 'sections', 'kompetensiKeahlian'));
    }


    public function getJurusanMenu()
    {
        $jurusans = Jurusan::all();
        $kompetensiKeahlian = $jurusans->mapWithKeys(function ($jurusan) {
            return [$jurusan->name => route('jurusan.show', Str::slug($jurusan->name))];
        })->toArray();

        return $kompetensiKeahlian;
    }
}