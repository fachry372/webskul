<?php

namespace App\Http\Controllers;

use App\Models\Ikm;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class IkmController extends Controller
{
    // Tampilkan semua IKM
    public function index(Request $request)
    {
        $query = Ikm::query()->latest();

        // Filter pencarian
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $ikm = $query->paginate(10);

        return view('admin.ikm.index', compact('ikm'));
    }


    // Form tambah IKM
    public function create()
    {
        return view('admin.ikm.create');
    }

    // Simpan IKM baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:ikms,title',
        ]);

        Ikm::create([
            'title' => $request->title,
            'slug'  => Str::slug($request->title),
        ]);

        return redirect()->route('admin.ikm.index')
            ->with('success', 'Judul IKM berhasil ditambahkan');
    }

    // Form edit IKM
    public function edit(Ikm $ikm)
    {
        return view('admin.ikm.edit', compact('ikm'));
    }

    // Update IKM
    public function update(Request $request, Ikm $ikm)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:ikms,title,' . $ikm->id,
        ]);

        $ikm->update([
            'title' => $request->title,
            'slug'  => Str::slug($request->title),
        ]);

        return redirect()->route('admin.ikm.index')
            ->with('success', 'Judul IKM berhasil diperbarui');
    }

 // Hapus IKM
public function destroy(Ikm $ikm)
{
    if ($ikm->konten()->exists()) {
        return redirect()->route('admin.ikm.index')
            ->with('error', 'Tidak bisa menghapus IKM karena masih memiliki konten.');
    }

    $ikm->delete();

    return redirect()->route('admin.ikm.index')
        ->with('success', 'Judul IKM berhasil dihapus');
}

}
