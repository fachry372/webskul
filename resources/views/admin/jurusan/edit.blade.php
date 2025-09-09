@extends('layouts.admin')

@section('title', 'Edit Jurusan')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Edit Jurusan</h2>
    <form action="{{ route('admin.jurusan.update', $jurusan) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block font-semibold">Nama Jurusan</label>
            <input type="text" name="name" id="name" class="w-full border rounded p-2 @error('name') border-red-500 @enderror" value="{{ old('name', $jurusan->name) }}" required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex items-center space-x-2">
            <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Simpan
            </button>
            <a href="{{ route('admin.jurusan.index') }}"
                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
