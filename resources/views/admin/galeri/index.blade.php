@extends('layouts.admin')

@section('title', 'Daftar Galeri')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Daftar Galeri</h2>

    <!-- Tombol tambah galeri -->
    <a href="{{ route('admin.galeri.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">
       + Tambah Galeri
    </a>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2 text-left">Judul</th>
                <th class="border p-2 text-left">Slug</th>
                <th class="border p-2 text-center">Jumlah Block</th>
                <th class="border p-2 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($galeris as $galeri)
                <tr>
                    <td class="border p-2">{{ $galeri->judul }}</td>
                    <td class="border p-2">{{ $galeri->slug }}</td>
                    <td class="border p-2 text-center">{{ $galeri->blocks->count() }}</td>
                    <td class="border p-2 text-center">
                        <a href="{{ route('admin.galeri.edit', $galeri->id) }}"
                           class="text-blue-600 hover:underline ml-2">Edit</a>

                        <form action="{{ route('admin.galeri.destroy', $galeri->id) }}"
                              method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline ml-2"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus galeri ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="border p-2 text-center">
                        Belum ada galeri.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
