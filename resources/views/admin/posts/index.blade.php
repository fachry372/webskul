@extends('layouts.admin')

@section('title', 'Daftar Post')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Daftar Post</h2>

    {{-- Filter & Tambah Post --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
        <a href="{{ route('admin.posts.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 whitespace-nowrap">
           Tambah Post
        </a>

        <form action="{{ route('admin.posts.index') }}" method="GET" class="flex flex-1 gap-4">
            <input type="text" name="search" placeholder="Cari jurusan..."
                   value="{{ request('search') }}"
                   class="border rounded p-2 flex-1">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('admin.posts.index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                   Reset
                </a>
            @endif
        </form>
    </div>

    {{-- Tabel daftar post --}}
    <table class="w-full border-collapse text-center">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">Jurusan</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($posts as $post)
                <tr>
                    <td class="border p-2 text-left">{{ $post->jurusan->name }}</td>
                    <td class="border p-2 text-center">
                        <a href="{{ route('admin.posts.edit', $post) }}"
                           class="text-blue-600 hover:underline ml-2">Edit</a>
                        <form action="{{ route('admin.posts.destroy', $post) }}"
                              method="POST"
                              class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-red-600 hover:underline ml-2"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus post ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="border p-2 text-center">Belum ada post.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $posts->appends(['search' => request('search')])->links() }}
    </div>
</div>
@endsection
