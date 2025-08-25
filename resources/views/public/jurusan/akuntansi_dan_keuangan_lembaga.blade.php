@extends('layouts.visitor')

@section('title', $jurusan->name ?? 'Jurusan Tidak Ditemukan')

@section('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
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

/* Foto grid konsisten, full tanpa latar putih */
.gallery-image {
    width: 100%;
    height: 250px; /* tinggi seragam */
    object-fit: cover; /* isi penuh, tidak ada ruang kosong */
    border-radius: 6px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
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
@endsection

@section('content')
<section class="relative w-full h-80 bg-cover bg-center text-white flex items-center justify-center overflow-hidden"
    style="background-image: url('{{ $jurusan->image ? Storage::url($jurusan->image) : asset('images/default-banner.jpg') }}');"
    data-aos="fade-in">
    <div class="absolute inset-0 bg-[#344966]/70 z-0"></div>
    <div class="relative z-10 text-center px-4">
        <h1 class="text-3xl md:text-4xl font-bold uppercase mb-2">{{ $jurusan->name ?? 'Jurusan Tidak Ditemukan' }}</h1>
        <p class="text-lg md:text-xl">SMK Negeri 1 Subang - The School of CEREN Models</p>
    </div>
</section>

<div class="w-full bg-white rounded-lg shadow my-8 px-4 sm:px-6 md:px-12 lg:px-20 py-6" data-aos="fade-up">
    @forelse($posts as $post)
        @php $hasContent = false; @endphp

        @if($post->image)
            @php $hasContent = true; @endphp
            <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}"
                 class="w-full max-w-md object-cover mb-4 rounded mx-auto" data-aos="fade-up">
        @endif

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
            @php
                $content = $post->$key;
                $photos = json_decode($post->{$key . '_photos'}, true);
                $files = json_decode($post->{$key . '_files'}, true);
                $photosText = $post->{$key . '_photos_text'};
            @endphp

            @if(!empty($content) || !empty($photos) || !empty($files))
                @php $hasContent = true; @endphp
                <div class="mb-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <h3 class="font-semibold text-lg text-gray-800 mb-2">{{ $label }}</h3>

                    {{-- Konten HTML --}}
                    @if(!empty($content))
                        <div class="content-html">{!! $content !!}</div>
                    @endif

                    {{-- Galeri Foto --}}
                    @if(!empty($photos) && is_array($photos))
                        @php $totalPhotos = count($photos); @endphp
                        @if($totalPhotos === 1)
                            <div class="relative flex justify-center mt-4">
                                <div class="absolute top-2 left-2 bg-black bg-opacity-50 text-white text-sm px-2 py-1 rounded">1</div>
                                <img src="{{ Storage::url($photos[0]) }}" alt="{{ $label }} Foto"
                                     class="max-w-2xl w-full object-contain rounded-lg shadow"
                                     loading="lazy" data-aos="zoom-in">
                            </div>
                            @if(!empty($photosText))
                                <div class="content-html mt-4">
                                    {!! $photosText !!}
                                </div>
                            @endif
                        @else
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
                                        <img src="{{ Storage::url($photo) }}" alt="{{ $label }} Foto"
                                             class="gallery-image"
                                             loading="lazy" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                                    </div>
                                @endforeach
                                @if(!empty($photosText))
                                    <div class="content-html col-span-full mt-4">
                                        {!! $photosText !!}
                                    </div>
                                @endif
                            </div>
                        @endif
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
