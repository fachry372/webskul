@extends('layouts.admin')

@section('title', 'Daftar Profil')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Daftar Profil</h2>

    {{-- Filter & Tambah Profil dalam satu baris --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
        <a href="{{ route('profiles.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 whitespace-nowrap">
           Tambah Profil
        </a>

        <form action="{{ route('profiles.index') }}" method="GET" class="flex flex-1 gap-4">
            <input type="text" name="search" placeholder="Cari nama profil..."
                   value="{{ request('search') }}"
                   class="border rounded p-2 flex-1">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('profiles.index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                   Reset
                </a>
            @endif
        </form>
    </div>

    {{-- Tabel daftar profil --}}
    <table class="w-full border-collapse text-center">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">Nama Profil</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($profiles as $profile)
                <tr>
                    <td class="border p-2 text-left">{{ $profile->title }}</td>
                    <td class="border p-2 text-center">
                        {{-- Tombol Edit --}}
                        <a href="{{ route('profiles.edit', $profile) }}" class="text-blue-600 hover:underline ml-2">Edit</a>

                        {{-- Tombol Hapus --}}
                        <form action="{{ route('profiles.destroy', $profile) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline ml-2"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus profil ini?')">
                                Hapus
                            </button>
                        </form>

                        {{-- Tombol Menu Profil (jika ingin ditampilkan) --}}
                        {{-- <a href="{{ route('menus.index', $profile->id) }}" class="text-green-600 hover:underline ml-2">Menu Profil</a> --}}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="border p-2 text-center">Belum ada profil.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $profiles->appends(['search' => request('search')])->links() }}
    </div>
</div>
@endsection
