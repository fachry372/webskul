@extends('layouts.visitor')

@section('title', $informasi->judul)

@section('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<style>
  .content-html {
        max-width: 100%;
        color: #000000;
        line-height: 1.7;
        font-family: sans-serif;
    }
    .content-html h1 { font-size: 2rem; font-weight: bold; margin-bottom: 1rem; }
    .content-html h2 { font-size: 1.5rem; font-weight: bold; margin-bottom: 0.75rem; }
    .content-html h3 { font-size: 1.25rem; font-weight: bold; margin-bottom: 0.5rem; }
    .content-html h4 { font-size: 1.125rem; font-weight: bold; margin-bottom: 0.5rem; }
    .content-html h5 { font-size: 1rem; font-weight: bold; margin-bottom: 0.5rem; }
    .content-html h6 { font-size: 0.875rem; font-weight: bold; margin-bottom: 0.5rem; }
    .content-html p { margin-bottom: 1rem; }
    .content-html strong, .content-html b { font-weight: bold; }
    .content-html em, .content-html i { font-style: italic; }
    .content-html u { text-decoration: underline; }
    .content-html s, .content-html strike { text-decoration: line-through; }
    .content-html code { font-family: monospace; background-color: #f3f4f6; padding: 2px 4px; border-radius: 3px; }
    .content-html .ql-font-monospace { font-family: monospace; }
    .content-html .ql-font-serif { font-family: serif; }
    .content-html .ql-font-sans { font-family: sans-serif; }
    .content-html .ql-size-small { font-size: 0.75rem; }
    .content-html .ql-size-large { font-size: 1.25rem; }
    .content-html .ql-size-huge { font-size: 1.5rem; }
    .content-html .ql-size-normal { font-size: 1rem; }
    .content-html .ql-align-left { text-align: left; }
    .content-html .ql-align-center { text-align: center; }
    .content-html .ql-align-right { text-align: right; }
    .content-html .ql-align-justify { text-align: justify; }
    .content-html ul, .content-html ol { padding-left: 2rem; margin: 1rem 0; }
    .content-html ul { list-style-type: disc; }
    .content-html ol { list-style-type: decimal; }
    .content-html li { margin-bottom: 0.5rem; }
    .content-html blockquote {
        border-left: 4px solid #ccc;
        padding-left: 1rem;
        color: #555;
        font-style: italic;
        margin: 1rem 0;
    }
    .content-html a { color: #1d4ed8; text-decoration: underline; }
    .content-html a:hover { color: #2563eb; }
    .content-html img {
        max-width: 100%;
        height: auto;
        border: 1px solid #e5e7eb;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin: 1rem auto;
        display: block;
    }
    /* Styling hover dan rata tengah */
    .gallery img {
        object-fit: cover;
        border-radius: 0.5rem;
        transition: transform 0.3s;
    }
    .gallery img:hover {
        transform: scale(1.05);
    }
</style>
@endsection

@section('content')
{{-- Header --}}
<section class="relative w-full h-72 bg-gray-200 flex items-center justify-center">
    <div class="absolute inset-0 bg-[#344966]/70"></div>
    <div class="relative z-10 text-center text-white">
        <h1 class="text-3xl md:text-4xl font-bold uppercase" data-aos="fade-down">{{ $informasi->judul }}</h1>
        <p class="text-sm mt-2 opacity-90" data-aos="fade-up">
            {{ $informasi->kategori->nama ?? '-' }} • {{ $informasi->tanggal_publish?->format('d M Y') }}
        </p>
    </div>
</section>

{{-- Konten & Galeri --}}
<div class="max-w-4xl mx-auto py-10 px-4">
    <article class="bg-white p-6 rounded-lg shadow" data-aos="fade-up">

        @if($informasi->gambar->count())
    <div class="flex flex-wrap justify-center gap-4 mb-6 gallery">
        @foreach($informasi->gambar as $img)
            <img src="{{ Storage::url($img->nama_file) }}"
                 @if($informasi->gambar->count() == 1)
                    class="w-2/3 rounded-lg shadow"
                 @else
                    class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 rounded-lg shadow"
                 @endif
                 style="height: auto; object-fit: contain;">
        @endforeach
    </div>
@endif


        {{-- Konten --}}
        <div class="content-html">
            {!! $informasi->isi !!}
        </div>

        {{-- Navigasi Next & Previous --}}
        <div class="flex justify-between items-center mt-10">
            @if($prev)
                <a href="{{ route('informasi.show', $prev->slug) }}"
                   class="px-4 py-2 bg-[#344966] text-white rounded-lg hover:bg-[#2c3a57] transition">
                   ← {{ Str::limit($prev->judul, 40) }}
                </a>
            @else
                <span></span>
            @endif

            @if($next)
                <a href="{{ route('informasi.show', $next->slug) }}"
                   class="px-4 py-2 bg-[#344966] text-white rounded-lg hover:bg-[#2c3a57] transition">
                   {{ Str::limit($next->judul, 40) }} →
                </a>
            @endif
        </div>

        {{-- Tombol kembali ke daftar --}}
        <div class="mt-6 text-center">
            <a href="{{ route('informasi.index') }}"
               class="inline-block px-5 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                ← Kembali ke Daftar Informasi
            </a>
        </div>
    </article>
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
@endsection
