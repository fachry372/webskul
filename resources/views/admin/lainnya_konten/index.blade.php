@extends('layouts.admin')

@section('title', 'Daftar Konten Lainnya')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Daftar Konten Lainnya</h2>

    <!-- Tombol tambah konten -->
    <a href="{{ route('admin.lainnya_konten.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">
       Tambah Konten
    </a>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2 text-center">Judul Menu Lainnya</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kontens as $content)
                <tr>
                    <td class="border p-2">{{ $content->lainnya->title ?? '-' }}</td>
                    <td class="border p-2 text-center">
                        <a href="{{ route('admin.lainnya_konten.edit', $content->id) }}"
                           class="text-blue-600 hover:underline ml-2">Edit</a>

                        <form action="{{ route('admin.lainnya_konten.destroy', $content->id) }}"
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
                    <td colspan="2" class="border p-2 text-center">
                        Belum ada konten Lainnya.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
