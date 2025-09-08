<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurusan;
use App\Models\InformasiTerbaru;
use Illuminate\Support\Facades\DB;

class StatistikController extends Controller
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

        // ✅ Catat pengunjung baru
        DB::table('pengunjung')->insert([
            'ip' => request()->ip(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('page_views')->insert([
            'url' => request()->path(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Hitung statistik
        $hariIni = DB::table('pengunjung')->whereDate('created_at', today())->count();
        $totalPengunjung = DB::table('pengunjung')->count();
        $totalHalaman = DB::table('page_views')->count();

        
        // Kirim ke view
        return view('public.beranda', compact(
            'jurusan',
            'kompetensiKeahlian',
            'informasis',
            'hariIni',
            'totalPengunjung',
            'totalHalaman'
        ));
    }
}
