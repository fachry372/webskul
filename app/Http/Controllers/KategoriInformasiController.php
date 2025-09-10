<?php

namespace App\Http\Controllers;

use App\Models\KategoriInformasi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriInformasiController extends Controller
{
    public function index(Request $request)
{
    $query = KategoriInformasi::query();

    // Filter pencarian berdasarkan nama kategori
    if ($request->search) {
        $query->where('nama', 'like', '%' . $request->search . '%');
    }



    $kategoris = $query->latest()->paginate(10);

    return view('admin.kategori.index', compact('kategoris'));
}


    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategori_informasi,nama',
        ]);

        KategoriInformasi::create([
            'nama' => $request->nama,
            'slug' => Str::slug($request->nama)
        ]);

        return redirect()->route('admin.kategori.index')->with('success','Kategori berhasil dibuat.');
    }

    public function edit(KategoriInformasi $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, KategoriInformasi $kategori)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategori_informasi,nama,' . $kategori->id,
        ]);

        $kategori->update([
            'nama' => $request->nama,
            'slug' => Str::slug($request->nama)
        ]);

        return redirect()->route('admin.kategori.index')->with('success','Kategori berhasil diupdate.');
    }

    public function destroy(KategoriInformasi $kategori)
    {
        $kategori->delete();
        return redirect()->route('admin.kategori.index')->with('success','Kategori berhasil dihapus.');
    }
}
