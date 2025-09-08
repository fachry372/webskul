@extends('layouts.visitor')

@section('title', $profile->title ?? $profile->name ?? 'Profil Tidak Ditemukan')

@section('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<style>
   <style>
    .content-html {
        max-width: 100%;
        color: #000000;
        line-height: 1.7;
        font-family: sans-serif;
    }
    .content-html pre,
.content-html code {
    white-space: pre-wrap;   /* wrap teks yang panjang */
    word-wrap: break-word;   /* memecah kata panjang */
    font-family: monospace;  /* tetap monospace */
    background-color: #f3f4f6;
    padding: 0.5rem;
    border-radius: 6px;
    overflow-x: auto;        /* scroll horizontal jika terlalu panjang */
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

    .gallery-image {
    width: 100%;         /* lebar penuh container */
    height: auto;        /* tinggi mengikuti rasio asli */
    object-fit: contain; /* tampil seluruh gambar, tidak crop */
    border-radius: 6px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
    display: block;
    margin: 0 auto;
    background-color: #f3f4f6; /* latar supaya rapi */
}
.gallery-image:hover {
    transform: scale(1.05);
}




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
</style>
@endsection

@section('content')
<section class="relative w-full h-80 bg-cover bg-center text-white flex items-center justify-center overflow-hidden"
    style="background-image: url('{{ $profile->image ? Storage::url($profile->image) : asset('images/default-banner.jpg') }}');"
    data-aos="fade-in">
    <div class="absolute inset-0 bg-[#344966]/70 z-0"></div>
    <div class="relative z-10 text-center px-4">
        <h1 class="text-3xl md:text-4xl font-bold uppercase mb-2">{{ $profile->title ?? $profile->name }}</h1>
    </div>
</section>

<div class="w-full bg-white rounded-lg shadow my-8 px-4 sm:px-6 md:px-12 lg:px-20 py-6" data-aos="fade-up">
    @forelse($menus as $menu)
        @php
            $hasContent = !empty($menu->content) || !empty($menu->content_section_photos) || !empty($menu->content_section_files);
            $content = $menu->content;
            $photos = json_decode($menu->content_section_photos, true);
            $files = json_decode($menu->content_section_files, true);
            $photosText = $menu->content_section_photos_text;
        @endphp

        @if($hasContent)
            <div class="mb-6" data-aos="fade-up">
                <h3 class="font-semibold text-lg text-gray-800 mb-2">{{ $menu->title }}</h3>

                {{-- Konten HTML --}}
                @if(!empty($content))
                    <div class="content-html">{!! $content !!}</div>
                @endif

                {{-- Galeri Foto --}}
                @if(!empty($photos) && is_array($photos))
                    @php $totalPhotos = count($photos); @endphp
                    <div class="grid mt-4 gap-4
                        @if($totalPhotos > 4) grid-cols-4
                        @elseif($totalPhotos === 2) grid-cols-2
                        @elseif($totalPhotos === 3) grid-cols-3
                        @else grid-cols-{{ $totalPhotos }} @endif">
                        @foreach($photos as $index => $photo)
                            <div class="relative flex flex-col items-center">
                                <div class="absolute top-2 left-2 bg-black bg-opacity-50 text-white text-sm px-2 py-1 rounded z-10">
                                    {{ $index + 1 }}
                                </div>
                                <img src="{{ Storage::url($photo) }}" alt="{{ $menu->title }} Foto"
                                     class="gallery-image" loading="lazy" data-aos="zoom-in">
                            </div>
                        @endforeach
                        @if(!empty($photosText))
                            <div class="content-html col-span-full mt-4">
                                {!! $photosText !!}
                            </div>
                        @endif
                    </div>
                @endif

                {{-- Files --}}
                @if(!empty($files) && is_array($files))
                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach($files as $file)
                            @php
                                $filePath = is_array($file) && isset($file['path']) ? $file['path'] : $file;
                            @endphp
                            <a href="{{ Storage::url($filePath) }}" class="download-btn" download>
                                Download {{ pathinfo($filePath, PATHINFO_BASENAME) }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
            <hr class="my-8 border-gray-300">
        @endif
    @empty
        <p class="text-xl text-red-600 font-semibold text-center">Belum ada data untuk profil ini.</p>
    @endforelse
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 800, once: true });
</script>
@endsection
