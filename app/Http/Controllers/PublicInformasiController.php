<?php

namespace App\Http\Controllers;

use App\Models\InformasiTerbaru;   // ✅ ini model yang benar
use App\Models\KategoriInformasi;
use Illuminate\Http\Request;

class PublicInformasiController extends Controller
{
    public function index(Request $request)
    {
        $query = InformasiTerbaru::with('kategori')->latest();

        // Filter kategori
        if ($request->kategori) {
            $query->where('kategori_id', $request->kategori);
        }

        // Pencarian judul
        if ($request->search) {
            $query->where('judul', 'like', '%'.$request->search.'%');
        }

        // Pagination per 5 data
        $informasis = $query->paginate(5)->withQueryString();

        $kategoris = KategoriInformasi::all();

        return view('public.informasi.index', compact('informasis', 'kategoris'));
    }


    public function show(string $slug)
    {
        $informasi = InformasiTerbaru::with(['kategori','gambar'])
            ->where('slug', $slug)
            ->where('status','publish')
            ->firstOrFail();

        // Prev & Next berdasarkan tanggal_publish
        $prev = InformasiTerbaru::where('tanggal_publish', '<', $informasi->tanggal_publish)
            ->orderBy('tanggal_publish', 'desc')
            ->first();

        $next = InformasiTerbaru::where('tanggal_publish', '>', $informasi->tanggal_publish)
            ->orderBy('tanggal_publish', 'asc')
            ->first();

        $latest = InformasiTerbaru::where('status','publish')
            ->latest()->take(5)->get();

        return view('public.informasi.show', compact('informasi','prev','next','latest'));
    }
}
