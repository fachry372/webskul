<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurusan;
use App\Models\InformasiTerbaru;

class BerandaController extends Controller
{

    public function index()
    {
        // Ambil semua jurusan
        $jurusan = Jurusan::all();

        // Array nama => link jurusan
        $kompetensiKeahlian = $jurusan->mapWithKeys(function ($j) {
            return [$j->name => route('jurusan.show', $j->slug)];
        });

        // Ambil 5 informasi terbaru yang publish, termasuk kategori
        $informasis = InformasiTerbaru::with('kategori')
            ->where('status', 'publish')
            ->whereNotNull('tanggal_publish')
            ->orderBy('tanggal_publish', 'desc')
            ->take(5)
            ->get();

        return view('public.beranda', compact('jurusan', 'kompetensiKeahlian', 'informasis'));
    }
}
