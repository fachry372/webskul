@extends('layouts.admin')

@section('title', 'Daftar Kelulusan')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Daftar Kelulusan</h2>

    <!-- Tombol tambah kelulusan -->
    <a href="{{ route('admin.kelulusan.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">
       + Tambah Kelulusan
    </a>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2 text-left">Judul</th>
                <th class="border p-2 text-left">Slug</th>
                <th class="border p-2 text-center">Status</th>
                <th class="border p-2 text-center">Jumlah Block</th>
                <th class="border p-2 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kelulusans as $kelulusan)
                <tr>
                    <td class="border p-2">{{ $kelulusan->judul }}</td>
                    <td class="border p-2">{{ $kelulusan->slug }}</td>
                    <td class="border p-2 text-center">
                        @if($kelulusan->status === 'publish')
                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-sm">
                                Publish
                            </span>
                        @else
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded text-sm">
                                Draft
                            </span>
                        @endif
                    </td>
                    <td class="border p-2 text-center">{{ $kelulusan->blocks->count() }}</td>
                    <td class="border p-2 text-center">
                        <a href="{{ route('admin.kelulusan.edit', $kelulusan->id) }}"
                           class="text-blue-600 hover:underline ml-2">Edit</a>

                        <form action="{{ route('admin.kelulusan.destroy', $kelulusan->id) }}"
                              method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline ml-2"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus kelulusan ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="border p-2 text-center">
                        Belum ada kelulusan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
