@extends('layouts.admin')

@section('title', 'Daftar Konten IKM')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Daftar Konten IKM</h2>

    {{-- Filter & Tambah Konten --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
        <a href="{{ route('admin.ikm_konten.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 whitespace-nowrap">
           Tambah Konten
        </a>

        <form action="{{ route('admin.ikm_konten.index') }}" method="GET" class="flex flex-1 gap-4">
            <input type="text" name="search" placeholder="Cari judul IKM..."
                   value="{{ request('search') }}"
                   class="border rounded p-2 flex-1">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('admin.ikm_konten.index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                   Reset
                </a>
            @endif
        </form>
    </div>

    {{-- Tabel daftar konten IKM --}}
    <table class="w-full border-collapse text-center">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">Judul IKM</th>

                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($konten as $content)
                <tr>
                    <td class="border p-2 text-left">{{ $content->ikm->title ?? '-' }}</td>

                    <td class="border p-2 text-center">
                        <a href="{{ route('admin.ikm_konten.edit', $content->id) }}"
                           class="text-blue-600 hover:underline ml-2">Edit</a>
                        <form action="{{ route('admin.ikm_konten.destroy', $content->id) }}"
                              method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline ml-2"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus konten ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="border p-2 text-center">Belum ada konten IKM.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $konten->appends(['search' => request('search')])->links() }}
    </div>
</div>
@endsection
