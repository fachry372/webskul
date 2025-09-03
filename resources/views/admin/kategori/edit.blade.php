@extends('layouts.admin')

@section('title', 'Edit Kategori Informasi')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Edit Kategori Informasi</h2>

    <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Nama Kategori --}}
        <div class="mb-4">
            <label for="nama" class="block font-semibold">Nama Kategori</label>
            <input type="text" name="nama" id="nama"
                   class="w-full border rounded p-2 @error('nama') border-red-500 @enderror"
                   value="{{ old('nama', $kategori->nama) }}" required>
            @error('nama')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tombol --}}
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Perbarui
        </button>
        <a href="{{ route('admin.kategori.index') }}"
           class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 ml-2">
            Batal
        </a>
    </form>
</div>
@endsection
