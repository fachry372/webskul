<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurusan;

class BerandaController extends Controller
{
    public function index()
    {
        // Ambil semua jurusan
        $jurusan = Jurusan::all();

        // Buat array nama => link jurusan
        $kompetensiKeahlian = $jurusan->mapWithKeys(function ($j) {
            return [$j->name => route('jurusan.show', $j->slug)];
        });

        return view('public.beranda', compact('jurusan', 'kompetensiKeahlian'));
    }
}
