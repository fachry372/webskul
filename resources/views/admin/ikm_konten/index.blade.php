@extends('layouts.admin')

@section('title', 'Daftar Konten IKM')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Daftar Konten IKM</h2>

    <!-- Tombol tambah konten -->
    <a href="{{ route('admin.ikm_konten.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">
       Tambah Konten
    </a>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2 text-center">Judul IKM</th>
                {{-- <th class="border p-2 text-left">Judul Konten</th> --}}
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($konten as $content)
                <tr>
                    <td class="border p-2">{{ $content->ikm->title ?? '-' }}</td>
                    {{-- <td class="border p-2">{{ $content->title }}</td> --}}
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
                    <td colspan="3" class="border p-2 text-center">
                        Belum ada konten IKM.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
