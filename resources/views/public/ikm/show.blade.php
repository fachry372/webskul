@extends('layouts.visitor')

@section('title', $ikm->title ?? 'IKM Tidak Ditemukan')

@section('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<style>
    .content-html {
        max-width: 100%;
        color: #4a5568;
        line-height: 1.7;
        font-family: sans-serif;
    }
    .content-html h1 { font-size: 2rem; font-weight: bold; margin-bottom: 1rem; }
    .content-html h2 { font-size: 1.5rem; font-weight: bold; margin-bottom: 0.75rem; }
    .content-html h3 { font-size: 1.25rem; font-weight: bold; margin-bottom: 0.5rem; }
    .content-html p { margin-bottom: 1rem; }
    .content-html ul, .content-html ol { padding-left: 2rem; margin: 1rem 0; }
    .content-html ul { list-style-type: disc; }
    .content-html ol { list-style-type: decimal; }
    .content-html li { margin-bottom: 0.5rem; }
    .content-html img {
        max-width: 100%;
        height: auto;
        border-radius: 6px;
        margin: 1rem auto;
        display: block;
    }
    .gallery-image {
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-radius: 6px;
        transition: transform 0.3s ease;
    }
    .gallery-image:hover { transform: scale(1.05); }
    .download-btn {
        display: inline-block;
        background-color: #3b82f6;
        color: #fff;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 500;
        transition: background 0.3s;
    }
    .download-btn:hover { background-color: #2563eb; }
</style>
@endsection

@section('content')
<section class="relative w-full h-80 bg-cover bg-center text-white flex items-center justify-center overflow-hidden"
    style="background-image: url('{{ $ikm->image ? Storage::url($ikm->image) : asset('images/default-banner.jpg') }}');"
    data-aos="fade-in">
    <div class="absolute inset-0 bg-[#344966]/70 z-0"></div>
    <div class="relative z-10 text-center px-4">
        <h1 class="text-3xl md:text-4xl font-bold uppercase mb-2">{{ $ikm->title ?? 'IKM Tidak Ditemukan' }}</h1>
        <p class="text-lg md:text-xl">SMK Negeri 1 Subang - IKM</p>
    </div>
</section>

<div class="w-full bg-white rounded-lg shadow my-8 px-4 sm:px-6 md:px-12 lg:px-20 py-6" data-aos="fade-up">
    @forelse($konten as $item)
        <div class="mb-10" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
            {{-- Judul --}}
            @if($item->title)
                <h2 class="text-2xl font-bold text-gray-800 mb-3">{{ $item->title }}</h2>
            @endif

            {{-- Konten utama --}}
            @if($item->text)
                <div class="content-html mb-4">{!! $item->text !!}</div>
            @endif

            {{-- Foto --}}
            @if(!empty($item->photos) && is_array($item->photos))
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                    @foreach($item->photos as $photo)
                        <img src="{{ Storage::url($photo) }}" alt="Foto IKM"
                             class="gallery-image" loading="lazy" data-aos="zoom-in">
                    @endforeach
                </div>
            @endif

            {{-- Video --}}
            @if(!empty($item->videos) && is_array($item->videos))
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                    @foreach($item->videos as $video)
                        <video src="{{ Storage::url($video) }}" controls
                               class="w-full rounded-lg shadow" data-aos="fade-up"></video>
                    @endforeach
                </div>
            @endif

            {{-- File --}}
            @if(!empty($item->file))
                <div class="mt-6">
                    <a href="{{ Storage::url($item->file) }}" class="download-btn" download>
                        Download File Tambahan
                    </a>
                </div>
            @endif
        </div>
        <hr class="my-6 border-gray-300">
    @empty
        <p class="text-xl text-red-600 font-semibold text-center">Belum ada konten untuk IKM ini.</p>
    @endforelse
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 800, once: true });
</script>
@endsection
