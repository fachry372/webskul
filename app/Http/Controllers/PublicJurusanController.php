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
        $jurusan = Jurusan::where('slug', $slug)->firstOrFail();

        $posts = Post::where('jurusan_id', $jurusan->id)->latest()->get();

        $jurusans = Jurusan::all();
        $kompetensiKeahlian = $jurusans->mapWithKeys(function ($jurusan) {
            return [$jurusan->name => route('jurusan.show', Str::slug($jurusan->name))];
        })->toArray();

        $sections = [
            'description', 'kompetensi_dasar', 'tujuan_pembelajaran', 'kurikulum_sinkronisasi',
            'program_unggulan', 'tim_pengajar', 'galeri_kegiatan', 'kundudi', 'industri_pasangan'
        ];

        // Gunakan satu view generic
        return view('public.jurusan.show', compact('jurusan', 'posts', 'sections', 'kompetensiKeahlian'));
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