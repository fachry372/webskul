@extends('layouts.admin')

@section('title', 'Daftar Galeri')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Daftar Galeri</h2>

    {{-- Filter & Tambah Galeri --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
        <a href="{{ route('admin.galeri.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 whitespace-nowrap">
           + Tambah Galeri
        </a>

        <form action="{{ route('admin.galeri.index') }}" method="GET" class="flex flex-1 gap-4">
            <input type="text" name="search" placeholder="Cari judul / slug..."
                   value="{{ request('search') }}"
                   class="border rounded p-2 flex-1">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('admin.galeri.index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                   Reset
                </a>
            @endif
        </form>
    </div>

    {{-- Tabel daftar galeri --}}
    <table class="w-full border-collapse text-center">
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
                    <td class="border p-2 text-left">{{ $galeri->judul }}</td>
                    <td class="border p-2 text-left">{{ $galeri->slug }}</td>
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

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $galeris->appends(['search' => request('search')])->links() }}
    </div>
</div>
@endsection
