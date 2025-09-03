@extends('layouts.admin')

@section('title', 'Daftar Kategori Informasi')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Daftar Kategori Informasi</h2>

    <a href="{{ route('admin.kategori.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">
       Tambah Kategori
    </a>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">Nama Kategori</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kategoris as $kategori)
                <tr>
                    <td class="border p-2">{{ $kategori->nama }}</td>
                    <td class="border p-2 text-center">
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
                    <td colspan="2" class="border p-2 text-center">Belum ada kategori.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $kategoris->links() }} <!-- pagination -->
    </div>
</div>
@endsection
