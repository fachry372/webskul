@extends('layouts.admin')

@section('title', 'Daftar Post')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Daftar Post</h2>
    <a href="{{ route('admin.posts.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">Tambah Post</a>
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">Judul</th>
                <th class="border p-2">Jurusan</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($posts as $post)
                <tr>
                    <td class="border p-2">{{ $post->title }}</td>
                    <td class="border p-2">{{ $post->jurusan->name }}</td>
                    <td class="border p-2">
                        <a href="{{ route('admin.posts.show', $post) }}" class="text-blue-600 hover:underline">Lihat</a>
                        <a href="{{ route('admin.posts.edit', $post) }}" class="text-blue-600 hover:underline ml-2">Edit</a>
                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline ml-2" onclick="return confirm('Apakah Anda yakin ingin menghapus post ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="border p-2 text-center">Belum ada post.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
