@extends('layouts.visitor')

@section('title', 'Informasi Terbaru')

@section('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endsection

@section('content')
{{-- Banner --}}
<section class="relative w-full h-80 bg-cover bg-center text-white flex items-center justify-center overflow-hidden"
    style="background-image: url('{{ asset('images/default-banner.jpg') }}');"
    data-aos="fade-in">
    <div class="absolute inset-0 bg-[#344966]/70 z-0"></div>
    <div class="relative z-10 text-center px-4">
        <h1 class="text-3xl md:text-4xl font-bold uppercase mb-2">Informasi Terbaru</h1>
        <p class="mt-2 text-sm md:text-base opacity-80">Update informasi, berita, dan pengumuman terbaru</p>
    </div>
</section>

<div class="max-w-6xl mx-auto py-10 px-4 grid md:grid-cols-3 gap-8">

    {{-- Sidebar (mobile atas, desktop kanan) --}}
    <aside class="md:col-span-1 space-y-6 order-first md:order-last" data-aos="fade-left">
        {{-- Pencarian --}}
        <div class="bg-white rounded-xl shadow p-5">
            <h3 class="text-lg font-bold mb-4">Cari Informasi</h3>
            <form action="{{ route('informasi.index') }}" method="GET" class="flex flex-col gap-2">
                <input type="text" name="search" placeholder="Cari judul..."
                       value="{{ request('search') }}"
                       class="border rounded p-2 w-full">
                <button type="submit" class="bg-[#344966] text-white px-4 py-2 rounded hover:bg-[#2c3a57]">
                    Cari
                </button>
            </form>
        </div>

        {{-- Kategori --}}
        <div class="bg-white rounded-xl shadow p-5">
            <h3 class="text-lg font-bold mb-4">Kategori</h3>
            <ul class="space-y-2">
                @foreach($kategoris as $kat)
                    <li>
                        <a href="{{ route('informasi.index', ['kategori' => $kat->id]) }}"
                           class="text-blue-600 hover:underline {{ request('kategori') == $kat->id ? 'font-semibold' : '' }}">
                            {{ $kat->nama }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </aside>

    {{-- Konten utama (daftar informasi) --}}
    <div class="md:col-span-2 space-y-6 order-last md:order-first">
        @forelse($informasis as $info)
            <div class="bg-white rounded-xl shadow hover:shadow-lg transform hover:-translate-y-1 transition p-5"
                 data-aos="fade-up">

                @if($info->gambar->first())
                    <img src="{{ Storage::url($info->gambar->first()->nama_file) }}"
                         class="w-full h-40 object-cover rounded-lg mb-4">
                @endif

                <h2 class="text-xl font-semibold mb-2">{{ $info->judul }}</h2>
                <p class="text-sm text-gray-500 mb-2">
                    {{ $info->kategori->nama ?? '-' }} • {{ $info->tanggal_publish?->format('d M Y') }}
                </p>
                <p class="text-gray-600 mb-3 line-clamp-3">{!! Str::limit(strip_tags($info->isi), 100) !!}</p>
                <a href="{{ route('informasi.show', $info->slug) }}"
                   class="inline-block bg-[#344966] text-white px-4 py-2 rounded-lg hover:bg-[#2c3a57] transition">
                    Read More →
                </a>
            </div>
        @empty
            <p class="text-gray-500">Belum ada informasi.</p>
        @endforelse

        {{-- Pagination --}}
        <div>
            {{ $informasis->links() }}
        </div>
    </div>

</div>

@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init();</script>
@endsection
