@extends('layouts.admin')

@section('title', 'Daftar Kategori Informasi')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Daftar Kategori Informasi</h2>

    {{-- Filter & Tambah Kategori dalam satu baris --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
        <a href="{{ route('admin.kategori.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 whitespace-nowrap">
           Tambah Kategori
        </a>
        <form action="{{ route('admin.kategori.index') }}" method="GET" class="flex flex-1 gap-4">
            <input type="text" name="search" placeholder="Cari kategori..."
                   value="{{ request('search') }}"
                   class="border rounded p-2 flex-1">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Cari
            </button>
        </form>
    </div>

    <table class="w-full border-collapse text-center">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">Nama Kategori</th>
                <th class="border p-2">Tanggal Dibuat</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kategoris as $kategori)
                <tr>
                    <td class="border p-2 text-left">{{ $kategori->nama }}</td>
                    <td class="border p-2">
                        {{ $kategori->created_at?->format('d M Y') ?? '-' }}
                    </td>
                    <td class="border p-2">
                        <a href="{{ route('admin.kategori.edit', $kategori) }}" class="text-blue-600 hover:underline ml-2">Edit</a>
                        <form action="{{ route('admin.kategori.destroy', $kategori) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-red-600 hover:underline ml-2"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="border p-2 text-center">Belum ada kategori.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $kategoris->appends(['search' => request('search')])->links() }}
    </div>
</div>
@endsection
