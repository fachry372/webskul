@extends('layouts.admin')

@section('title', 'Detail Saran')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow mt-6 flex flex-col min-h-[300px]">
    <h1 class="text-2xl font-bold mb-4">📄 Detail Saran</h1>

    <div class="mb-4">
        <strong>Nama:</strong> {{ $saran->nama }}
    </div>

    <div class="mb-4">
        <strong>Email:</strong> {{ $saran->email }}
    </div>

    <div class="mb-4">
        <strong>Tanggal:</strong>
        {{ $saran->created_at->timezone('Asia/Jakarta')->format('d-m-Y H:i') }} WIB
    </div>

    <div class="mb-4 flex-1">
        <strong>Saran Lengkap:</strong>
        <p class="mt-2 p-3 border rounded bg-gray-50">{{ $saran->saran }}</p>
    </div>

    <!-- Tombol kembali dengan warna sama seperti tombol “Batal” -->
    <div class="mt-auto pt-4">
        <a href="{{ route('admin.saran.index') }}"
           class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 inline-flex items-center gap-2">
            ← Kembali ke Daftar Saran
        </a>
    </div>
</div>
@endsection
