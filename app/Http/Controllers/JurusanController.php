<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusan = Jurusan::all();
        return view('admin.jurusan.index', compact('jurusan'));
    }

    public function create()
    {
        return view('admin.jurusan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:jurusans',
        ]);

        Jurusan::create($request->only('name'));

        return redirect()->route('admin.jurusan.index')->with('success', 'Jurusan berhasil dibuat.');
    }

    public function show(Jurusan $jurusan)
    {
        return view('admin.jurusan.show', compact('jurusan'));
    }

    public function edit(Jurusan $jurusan)
    {
        return view('admin.jurusan.edit', compact('jurusan'));
    }

    public function update(Request $request, Jurusan $jurusan)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:jurusans,name,' . $jurusan->id,
        ]);

        $jurusan->update($request->only('name'));

        return redirect()->route('admin.jurusan.index')->with('success', 'Jurusan berhasil diperbarui.');
    }

    public function destroy(Jurusan $jurusan)
    {
        // Cek apakah jurusan ini memiliki post
        if ($jurusan->posts()->count() > 0) {
            return redirect()->route('admin.jurusan.index')
                ->with('error', 'Jurusan ini masih memiliki post dan tidak dapat dihapus.');
        }

        $jurusan->delete();

        return redirect()->route('admin.jurusan.index')
            ->with('success', 'Jurusan berhasil dihapus.');
    }

}
