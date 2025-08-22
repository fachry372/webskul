@extends('layouts.visitor')

@section('title', $jurusan->name ?? 'Jurusan Tidak Ditemukan')

@section('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
<style>
    /* Konten HTML */
    .content-html {
        max-width: 100%;
        color: #4a5568;
        line-height: 1.7;
        font-family: sans-serif;
    }

    /* Heading */
    .content-html h1 { font-size: 2rem; font-weight: bold; margin-bottom: 1rem; }
    .content-html h2 { font-size: 1.5rem; font-weight: bold; margin-bottom: 0.75rem; }
    .content-html h3 { font-size: 1.25rem; font-weight: bold; margin-bottom: 0.5rem; }
    .content-html h4 { font-size: 1.125rem; font-weight: bold; margin-bottom: 0.5rem; }
    .content-html h5 { font-size: 1rem; font-weight: bold; margin-bottom: 0.5rem; }
    .content-html h6 { font-size: 0.875rem; font-weight: bold; margin-bottom: 0.5rem; }

    /* Paragraph & inline */
    .content-html p { margin-bottom: 1rem; }
    .content-html strong, .content-html b { font-weight: bold; }
    .content-html em, .content-html i { font-style: italic; }
    .content-html u { text-decoration: underline; }
    .content-html s, .content-html strike { text-decoration: line-through; }
    .content-html code { font-family: monospace; background-color: #f3f4f6; padding: 2px 4px; border-radius: 3px; }

    /* Quill fonts */
    .content-html .ql-font-monospace { font-family: monospace; }
    .content-html .ql-font-serif { font-family: serif; }
    .content-html .ql-font-sans { font-family: sans-serif; }

    /* Quill sizes */
    .content-html .ql-size-small { font-size: 0.75rem; }
    .content-html .ql-size-large { font-size: 1.25rem; }
    .content-html .ql-size-huge { font-size: 1.5rem; }
    .content-html .ql-size-normal { font-size: 1rem; }

    /* Alignment */
    .content-html .ql-align-left { text-align: left; }
    .content-html .ql-align-center { text-align: center; }
    .content-html .ql-align-right { text-align: right; }
    .content-html .ql-align-justify { text-align: justify; }

    /* Lists */
    .content-html ul, .content-html ol { padding-left: 2rem; margin: 1rem 0; }
    .content-html ul { list-style-type: disc; }
    .content-html ol { list-style-type: decimal; }
    .content-html li { margin-bottom: 0.5rem; }

    /* Blockquote */
    .content-html blockquote {
        border-left: 4px solid #ccc;
        padding-left: 1rem;
        color: #555;
        font-style: italic;
        margin: 1rem 0;
    }

    /* Links */
    .content-html a { color: #1d4ed8; text-decoration: underline; }
    .content-html a:hover { color: #2563eb; }

    /* Images */
    .content-html img {
        max-width: 100%;
        height: auto;
        border: 1px solid #e5e7eb;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin: 1rem auto;
        display: block;
    }

    /* Gallery */
    .gallery {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 10px;
        margin: 10px 0;
    }
    .gallery-image {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border: 1px solid #e5e7eb;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }
    .gallery-image:hover { transform: scale(1.05); }
</style>
@endsection

@section('content')
<!-- Banner -->
<section class="relative w-full h-80 bg-cover bg-center text-white flex items-center justify-center overflow-hidden"
    style="background-image: url('{{ $jurusan->image ? Storage::url($jurusan->image) : asset('images/default-banner.jpg') }}');"
    data-aos="fade-in">
    <div class="absolute inset-0 bg-[#344966]/70 z-0"></div>
    <div class="relative z-10 text-center px-4">
        <h1 class="text-3xl md:text-4xl font-bold uppercase mb-2">{{ $jurusan->name ?? 'Jurusan Tidak Ditemukan' }}</h1>
        <p class="text-lg md:text-xl">SMK Negeri 1 Subang - The School of CEREN Models</p>
    </div>
</section>

<!-- Konten -->
<div class="w-full bg-white rounded-lg shadow my-8 px-4 sm:px-6 md:px-12 lg:px-20 py-6" data-aos="fade-up">
    @php $hasContent = false; @endphp

    @forelse($posts as $post)
        {{-- Gambar utama --}}
        @if($post->image)
            @php $hasContent = true; @endphp
            <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}"
                 class="w-full max-w-md object-cover mb-4 rounded" data-aos="fade-up">
        @endif

        {{-- Sections --}}
        @php
            $sections = [
                'description' => 'Deskripsi',
                'kompetensi_dasar' => 'Kompetensi Dasar',
                'tujuan_pembelajaran' => 'Tujuan Pembelajaran',
                'kurikulum_sinkronisasi' => 'Kurikulum Sinkronisasi',
                'program_unggulan' => 'Program Unggulan',
                'tim_pengajar' => 'Tim Pengajar',
                'galeri_kegiatan' => 'Galeri Kegiatan',
                'kundudi' => 'Kundudi',
                'industri_pasangan' => 'Industri Pasangan',
            ];
        @endphp

        @foreach($sections as $key => $label)
            @if(!empty($post->$key) || !empty($post->{$key . '_photos'}))
                @php $hasContent = true; @endphp
                <div class="mb-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <h3 class="font-semibold text-lg text-gray-800 mb-2">{{ $label }}</h3>

                    {{-- HTML dari DB --}}
                    @if(!empty($post->$key))
                        <div class="content-html">{!! $post->$key !!}</div>
                    @endif

                    {{-- Galeri foto --}}
                    @if(!empty($post->{$key . '_photos'}))
                        <div class="gallery mt-4">
                            @foreach(json_decode($post->{$key . '_photos'}, true) as $photo)
                                <img src="{{ Storage::url($photo) }}" alt="{{ $label }} Foto"
                                     class="gallery-image rounded-lg shadow" loading="lazy"
                                     data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif
        @endforeach

        @if($hasContent)
            <hr class="my-8 border-gray-300">
        @endif
    @empty
        <p class="text-xl text-red-600 font-semibold text-center">Belum ada data untuk jurusan ini.</p>
    @endforelse
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 800, once: true });
</script>
@endsection
