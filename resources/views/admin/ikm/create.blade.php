@extends('layouts.admin')

@section('title', 'Tambah IKM')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Tambah IKM</h2>
    <form action="{{ route('admin.ikm.store') }}" method="POST">
        @csrf

        {{-- Judul --}}
        <div class="mb-4">
            <label for="title" class="block font-semibold">Judul IKM</label>
            <input type="text" name="title" id="title"
                   class="w-full border rounded p-2 @error('title') border-red-500 @enderror"
                   value="{{ old('title') }}" required>
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tombol --}}
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Simpan
        </button>
        <a href="{{ route('admin.ikm.index') }}"
           class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 ml-2">
            Batal
        </a>
    </form>
</div>
@endsection
