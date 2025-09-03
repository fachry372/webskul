<?php

namespace App\Http\Controllers;

use App\Models\Lainnya;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LainnyaController extends Controller
{
    // Tampilkan semua menu Lainnya
    public function index()
    {
        $lainnya = Lainnya::all();
        return view('admin.lainnya.index', compact('lainnya'));
    }

    // Form tambah menu Lainnya
    public function create()
    {
        return view('admin.lainnya.create');
    }

    // Simpan menu Lainnya baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:lainnya,title',
        ]);

        Lainnya::create([
            'title' => $request->title,
            'slug'  => Str::slug($request->title),
        ]);

        return redirect()->route('admin.lainnya.index')
            ->with('success', 'Menu Lainnya berhasil ditambahkan');
    }

    // Form edit menu Lainnya
    public function edit(Lainnya $lainnya)
    {
        return view('admin.lainnya.edit', compact('lainnya'));
    }

    // Update menu Lainnya
    public function update(Request $request, Lainnya $lainnya)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:lainnya,title,' . $lainnya->id,
        ]);

        $lainnya->update([
            'title' => $request->title,
            'slug'  => Str::slug($request->title),
        ]);

        return redirect()->route('admin.lainnya.index')
            ->with('success', 'Menu Lainnya berhasil diperbarui');
    }

    // Hapus menu Lainnya
    public function destroy(Lainnya $lainnya)
    {
        // Cek apakah masih memiliki konten
        if ($lainnya->konten()->exists()) {
            return redirect()->route('admin.lainnya.index')
                ->with('error', 'Tidak bisa menghapus menu Lainnya karena masih memiliki konten.');
        }

        $lainnya->delete();

        return redirect()->route('admin.lainnya.index')
            ->with('success', 'Menu Lainnya berhasil dihapus');
    }
}
