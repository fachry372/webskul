@extends('layouts.admin')

@section('title', 'Daftar Lainnya')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Daftar Lainnya</h2>

    <a href="{{ route('admin.lainnya.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">
       Tambah Lainnya
    </a>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">Judul Lainnya</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($lainnya as $item)
                <tr>
                    <td class="border p-2">{{ $item->title }}</td>
                    <td class="border p-2 text-center">
                        <a href="{{ route('admin.lainnya.edit', $item) }}" class="text-blue-600 hover:underline ml-2">Edit</a>
                        <form action="{{ route('admin.lainnya.destroy', $item) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-red-600 hover:underline ml-2"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus menu Lainnya ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="border p-2 text-center">Belum ada data Lainnya.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
