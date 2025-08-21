@extends('layouts.admin')

@section('title', 'Detail Jurusan')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">{{ $jurusan->name }}</h2>
    <p><strong>Nama Jurusan:</strong> {{ $jurusan->name }}</p>
    <div class="mt-4">
        <a href="{{ route('admin.jurusan.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kembali</a>
        <a href="{{ route('admin.jurusan.edit', $jurusan) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Edit</a>
    </div>
</div>
@endsection
