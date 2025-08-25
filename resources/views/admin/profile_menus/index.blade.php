@extends('layouts.admin')

@section('title', 'Daftar Konten Menu')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Daftar Konten Menu</h2>

    <!-- Tombol tambah konten selalu muncul -->
    <a href="{{ route('menus.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">
       Tambah Konten
    </a>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">Judul Menu</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($menus as $menu)
                <tr>
                    <td class="border p-2">{{ $menu->profile->title ?? '-' }}</td>
                    <td class="border p-2 text-center">
                        <a href="{{ route('menus.edit', $menu->id) }}" class="text-blue-600 hover:underline ml-2">Edit</a>
                        <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" class="inline-block">
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
                    <td colspan="2" class="border p-2 text-center">Belum ada konten di menu ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
