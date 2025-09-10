@extends('layouts.admin')

@section('title', 'Daftar Jurusan')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Daftar Jurusan</h2>

    {{-- Filter & Tambah Jurusan --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
        <a href="{{ route('admin.jurusan.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 whitespace-nowrap">
           Tambah Jurusan
        </a>

        <form action="{{ route('admin.jurusan.index') }}" method="GET" class="flex flex-1 gap-4">
            <input type="text" name="search" placeholder="Cari nama jurusan..."
                   value="{{ request('search') }}"
                   class="border rounded p-2 flex-1">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('admin.jurusan.index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                   Reset
                </a>
            @endif
        </form>
    </div>

    {{-- Tabel daftar jurusan --}}
    <table class="w-full border-collapse text-center">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">Nama Jurusan</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($jurusan as $item)
                <tr>
                    <td class="border p-2 text-left">{{ $item->name }}</td>
                    <td class="border p-2 text-center">
                        <a href="{{ route('admin.jurusan.edit', $item) }}" class="text-blue-600 hover:underline ml-2">Edit</a>
                        <form action="{{ route('admin.jurusan.destroy', $item) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline ml-2"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus jurusan ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="border p-2 text-center">Belum ada jurusan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $jurusan->appends(['search' => request('search')])->links() }}
    </div>
</div>
@endsection
