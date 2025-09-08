<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\InformasiTerbaru;
use App\Models\Jurusan;
use App\Models\Lainnya;
use App\Models\Kelulusan;
use App\Models\Galeri;
use App\Models\Ikm;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = trim($request->input('q'));

        if (empty($query)) {
            return view('search.results', [
                'query' => $query,
                'posts' => collect(),
                'informasi' => collect(),
                'jurusans' => collect(),
                'lainnya' => collect(),
                'kelulusans' => collect(),
                'galeris' => collect(),
                'ikms' => collect(),
            ]);
        }

        // Post
        $posts = Post::with('jurusan')
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->get();

        // Informasi terbaru + kategori
        $informasi = InformasiTerbaru::with('kategori')
            ->where(function ($q) use ($query) {
                $q->where('judul', 'like', "%{$query}%")
                  ->orWhere('isi', 'like', "%{$query}%");
            })
            ->orWhereHas('kategori', function ($q) use ($query) {
                $q->where('nama', 'like', "%{$query}%");
            })
            ->get();

        // Jurusan
        $jurusans = Jurusan::where('name', 'like', "%{$query}%")->get();

        // Lainnya
        $lainnya = Lainnya::where('title', 'like', "%{$query}%")->get();

        // Kelulusan
        $kelulusans = Kelulusan::where('judul', 'like', "%{$query}%")->get();

        // Galeri
        $galeris = Galeri::where('judul', 'like', "%{$query}%")->get();

        // IKM
        $ikms = Ikm::where('title', 'like', "%{$query}%")->get();

        return view('search.results', compact(
            'query',
            'posts',
            'informasi',
            'jurusans',
            'lainnya',
            'kelulusans',
            'galeris',
            'ikms'
        ));
    }
}
