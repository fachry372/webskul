@extends('layouts.admin')

@section('title', 'Daftar Profil')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Daftar Profil</h2>
    <a href="{{ route('profiles.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">Tambah Profil</a>
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">Nama Profil</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($profiles as $profile)
                <tr>
                    <td class="border p-2">{{ $profile->title }}</td>
                    <td class="border p-2 text-center">
                        {{-- Tombol Edit --}}
                        <a href="{{ route('profiles.edit', $profile) }}" class="text-blue-600 hover:underline ml-2">Edit</a>

                        {{-- Tombol Hapus --}}
                        <form action="{{ route('profiles.destroy', $profile) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline ml-2" onclick="return confirm('Apakah Anda yakin ingin menghapus profil ini?')">Hapus</button>
                        </form>

                        {{-- Tombol Menu Profil
                        <a href="{{ route('menus.index', $profile->id) }}" class="text-green-600 hover:underline ml-2">Menu Profil</a>
                    </td> --}}
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="border p-2 text-center">Belum ada profil.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
