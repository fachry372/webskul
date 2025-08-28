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
            width: 100%;
            height: auto;
            object-fit: contain;
            border-radius: 6px;
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
            margin-top: 0.5rem;
        }

        .download-btn:hover {
            background-color: #2563eb;
        }

        iframe.file-viewer {
            width: 100%;
            height: 75vh;
            max-height: 600px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-bottom: 0.5rem;
        }

        @media (max-width: 640px) {
            iframe.file-viewer {
                height: auto;
                max-height: 250px;
            }
        }

        .fallback {
            background: #f9fafb;
            border: 1px dashed #ccc;
            padding: 1rem;
            border-radius: 6px;
            text-align: center;
            color: #666;
            margin-bottom: 0.5rem;
        }
    </style>
@endsection

@section('content')

    <!-- Banner -->
    <section class="relative w-full h-80 bg-cover bg-center text-white flex items-center justify-center overflow-hidden"
        style="background-image: url('{{ $ikm->image ? Storage::url($ikm->image) : asset('images/default-banner.jpg') }}');"
        data-aos="fade-in">
        <div class="absolute inset-0 bg-[#344966]/70 z-0"></div>
        <div class="relative z-10 text-center px-4">
            <h1 class="text-3xl md:text-4xl font-bold uppercase mb-2">{{ $ikm->title }}</h1>
            <p class="text-lg md:text-xl">SMK Negeri 1 Subang - IKM</p>
        </div>
    </section>

    <!-- Konten -->
    <div class="w-full bg-white rounded-lg shadow my-8 px-4 sm:px-6 md:px-12 lg:px-20 py-6" data-aos="fade-up">

        @forelse($kontens as $konten)
            @php
                // filter block kosong
                $validBlocks = collect($konten->blocks)->filter(function ($block) {
                    $isValidArray = function ($arr) {
                        return is_array($arr) && collect($arr)->filter(function ($v) {
                            return !is_null($v) && $v !== '';
                        })->isNotEmpty();
                    };

                    return $block->title
                        || $block->text
                        || $isValidArray($block->photos ?? [])
                        || $isValidArray($block->videos ?? [])
                        || $isValidArray($block->videos_link ?? [])
                        || $isValidArray($block->files ?? []);
                })->values();
            @endphp

            @forelse ($validBlocks as $index => $block)
                <div class="mb-10" data-aos="fade-up">

                    {{-- Judul Section --}}
                    @if ($block->title)
                        <h2 class="text-2xl font-bold text-gray-800 mb-3">{{ $block->title }}</h2>
                    @endif

                    {{-- Teks --}}
                    @if ($block->text)
                        <div class="content-html mb-4">{!! $block->text !!}</div>
                    @endif

                    {{-- Foto --}}
                    @if (!empty($block->photos) && is_array($block->photos))
                        <div class="grid gap-4 mt-4" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));">
                            @foreach ($block->photos as $photo)
                                @if ($photo)
                                    <div class="w-full flex justify-center">
                                        <img src="{{ Storage::url($photo) }}" alt="Foto" class="rounded-lg shadow"
                                            style="width: 100%; height: auto; object-fit: contain;">
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif

                    {{-- Video --}}
                    @if (!empty($block->videos) && is_array($block->videos))
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                            @foreach ($block->videos as $video)
                                @if ($video)
                                    <div>
                                        <video src="{{ Storage::url($video) }}" controls class="w-full rounded-lg shadow"></video>
                                        <a href="{{ Storage::url($video) }}" class="download-btn" download>Download Video</a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif

                    {{-- Video Link --}}
                    @if (!empty($block->videos_link) && is_array($block->videos_link))
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                            @foreach ($block->videos_link as $link)
                                @if ($link)
                                    <iframe width="100%" height="200" src="{{ convertVideoLink($link) }}" frameborder="0"
                                        allowfullscreen class="rounded-lg shadow"></iframe>
                                @endif
                            @endforeach
                        </div>
                    @endif

                    {{-- File --}}
                    @if (!empty($block->files) && is_array($block->files))
                        <div class="mt-6 space-y-6">
                            @foreach ($block->files as $file)
                                @if ($file)
                                    @php
                                        $url = Storage::url($file);
                                        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                                    @endphp

                                    @if ($ext === 'pdf')
                                        <div class="overflow-x-auto mb-4">
                                            <iframe src="{{ $url }}" class="file-viewer"></iframe>
                                        </div>
                                        <a href="{{ $url }}" class="download-btn" download>Download PDF</a>
                                    @elseif(in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                        <img src="{{ $url }}" alt="File Gambar" class="gallery-image">
                                        <a href="{{ $url }}" class="download-btn" download>Download Gambar</a>
                                    @elseif(in_array($ext, ['mp4', 'webm']))
                                        <video src="{{ $url }}" controls class="w-full rounded-lg shadow"></video>
                                        <a href="{{ $url }}" class="download-btn" download>Download Video</a>
                                    @elseif(in_array($ext, ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx']))
                                        <iframe src="https://docs.google.com/viewer?url={{ urlencode($url) }}&embedded=true"
                                            class="file-viewer"
                                            onerror="this.style.display='none'; this.insertAdjacentHTML('afterend','<div class=&quot;fallback&quot;>Pratinjau tidak tersedia, silakan download file.</div>');"></iframe>
                                        <a href="{{ $url }}" class="download-btn" download>Download File Office</a>
                                    @else
                                        <a href="{{ $url }}" class="download-btn" target="_blank">Download File</a>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    @endif

                </div>

                {{-- HR hanya kalau ada block valid berikutnya --}}
                @if (isset($validBlocks[$index + 1]))
                    <hr class="my-6 border-gray-300">
                @endif
            @empty
                <p class="text-xl text-red-600 font-semibold text-center">Belum ada konten valid untuk IKM ini.</p>
            @endforelse
        @empty
            <p class="text-xl text-red-600 font-semibold text-center">Belum ada konten untuk IKM ini.</p>
        @endforelse

    </div>

@endsection

@section('scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });
    </script>
@endsection
