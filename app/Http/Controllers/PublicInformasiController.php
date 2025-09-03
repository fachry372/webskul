<?php

namespace App\Http\Controllers;

use App\Models\InformasiTerbaru;   // ✅ ini model yang benar
use App\Models\KategoriInformasi;
use Illuminate\Http\Request;

class PublicInformasiController extends Controller
{
    public function index(Request $request)
{
    $query = InformasiTerbaru::with('kategori')
        ->where('status', 'publish')        // hanya yang publish
        ->whereNotNull('tanggal_publish')   // pastikan ada tanggal publish
        ->orderBy('tanggal_publish', 'desc'); // urut terbaru berdasarkan tanggal_publish

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
        // Ambil artikel berdasarkan slug dan status publish
        $informasi = InformasiTerbaru::with(['kategori','gambar'])
            ->where('slug', $slug)
            ->where('status', 'publish')
            ->firstOrFail();

        // Prev & Next hanya jika ada tanggal_publish
        if ($informasi->tanggal_publish) {
            // Artikel sebelumnya (tanggal lebih kecil atau sama tapi id lebih kecil)
            $prev = InformasiTerbaru::with('kategori')
                ->where('status','publish')
                ->whereNotNull('tanggal_publish')
                ->where(function($query) use ($informasi) {
                    $query->where('tanggal_publish', '<', $informasi->tanggal_publish)
                          ->orWhere(function($q) use ($informasi) {
                              $q->where('tanggal_publish', $informasi->tanggal_publish)
                                ->where('id', '<', $informasi->id);
                          });
                })
                ->orderBy('tanggal_publish', 'desc')
                ->orderBy('id', 'desc')
                ->first();

            // Artikel selanjutnya (tanggal lebih besar atau sama tapi id lebih besar)
            $next = InformasiTerbaru::with('kategori')
                ->where('status','publish')
                ->whereNotNull('tanggal_publish')
                ->where(function($query) use ($informasi) {
                    $query->where('tanggal_publish', '>', $informasi->tanggal_publish)
                          ->orWhere(function($q) use ($informasi) {
                              $q->where('tanggal_publish', $informasi->tanggal_publish)
                                ->where('id', '>', $informasi->id);
                          });
                })
                ->orderBy('tanggal_publish', 'asc')
                ->orderBy('id', 'asc')
                ->first();
        } else {
            $prev = null;
            $next = null;
        }

        // Ambil 5 artikel terbaru
        $latest = InformasiTerbaru::with('kategori')
            ->where('status','publish')
            ->whereNotNull('tanggal_publish')
            ->orderBy('tanggal_publish', 'desc')
            ->take(5)
            ->get();

        // Kirim semua data ke view
        return view('public.informasi.show', compact('informasi','prev','next','latest'));
    }


}
