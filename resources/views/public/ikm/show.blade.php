@extends('layouts.visitor')

@section('title', $ikm->title ?? 'IKM Tidak Ditemukan')

@section('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<style>
.content-html { max-width: 100%; color: #4a5568; line-height: 1.7; font-family: sans-serif; }
.content-html h1, h2, h3 { font-weight: bold; margin-bottom: 1rem; }
.content-html p { margin-bottom: 1rem; }
.gallery-image { width: 100%; height: 250px; object-fit: cover; border-radius: 6px; transition: transform 0.3s ease; }
.gallery-image:hover { transform: scale(1.05); }
.download-btn { display: inline-block; background-color: #3b82f6; color: #fff; padding: 0.5rem 1rem; border-radius: 6px; text-decoration: none; margin-top: 0.5rem; }
.download-btn:hover { background-color: #2563eb; }
iframe.file-viewer { width: 100%; height: 400px; border: 1px solid #ccc; border-radius: 6px; margin-bottom: 0.5rem; }
.fallback { background: #f9fafb; border: 1px dashed #ccc; padding: 1rem; border-radius: 6px; text-align: center; color: #666; margin-bottom: 0.5rem; }
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
        @foreach($konten->blocks as $block)
            @php
                $hasContent = $block->title || $block->text
                    || (!empty($block->photos) && is_array($block->photos))
                    || (!empty($block->videos) && is_array($block->videos))
                    || (!empty($block->videos_link) && is_array($block->videos_link))
                    || (!empty($block->files) && is_array($block->files));
            @endphp

            @if(!$hasContent)
                @continue
            @endif

            <div class="mb-10" data-aos="fade-up">

                {{-- Judul Section --}}
                @if($block->title)
                    <h2 class="text-2xl font-bold text-gray-800 mb-3">{{ $block->title }}</h2>
                @endif

                {{-- Teks --}}
                @if($block->text)
                    <div class="content-html mb-4">{!! $block->text !!}</div>
                @endif

                {{-- Foto --}}
                @if(!empty($block->photos) && is_array($block->photos))
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                        @foreach($block->photos as $photo)
                            <img src="{{ Storage::url($photo) }}" alt="Foto" class="gallery-image" loading="lazy">
                        @endforeach
                    </div>
                @endif

                {{-- Video --}}
                @if(!empty($block->videos) && is_array($block->videos))
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                        @foreach($block->videos as $video)
                            <video src="{{ Storage::url($video) }}" controls class="w-full rounded-lg shadow"></video>
                            <a href="{{ Storage::url($video) }}" class="download-btn" download>Download Video</a>
                        @endforeach
                    </div>
                @endif

                {{-- Video Link --}}
                @if(!empty($block->videos_link) && is_array($block->videos_link))
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                        @foreach($block->videos_link as $link)
                            <iframe width="100%" height="400" src="{{ convertVideoLink($link) }}" frameborder="0" allowfullscreen class="rounded-lg shadow"></iframe>
                        @endforeach
                    </div>
                @endif

                {{-- File --}}
                @if(!empty($block->files) && is_array($block->files))
                    <div class="mt-6 space-y-6">
                        @foreach($block->files as $file)
                            @php
                                $url = Storage::url($file);
                                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                            @endphp

                            @if($ext === 'pdf')
                                <iframe src="{{ $url }}" class="file-viewer" onerror="this.style.display='none'; this.insertAdjacentHTML('afterend','<div class=&quot;fallback&quot;>Pratinjau tidak tersedia, silakan download file.</div>');"></iframe>
                                <a href="{{ $url }}" class="download-btn" download>Download PDF</a>

                            @elseif(in_array($ext, ['jpg','jpeg','png','gif','webp']))
                                <img src="{{ $url }}" alt="File Gambar" class="gallery-image">
                                <a href="{{ $url }}" class="download-btn" download>Download Gambar</a>

                            @elseif(in_array($ext, ['mp4','webm']))
                                <video src="{{ $url }}" controls class="w-full rounded-lg shadow"></video>
                                <a href="{{ $url }}" class="download-btn" download>Download Video</a>

                            @elseif(in_array($ext, ['doc','docx','xls','xlsx','ppt','pptx']))
                                <iframe src="https://docs.google.com/viewer?url={{ urlencode($url) }}&embedded=true"
                                        class="file-viewer"
                                        onerror="this.style.display='none'; this.insertAdjacentHTML('afterend','<div class=&quot;fallback&quot;>Pratinjau tidak tersedia, silakan download file.</div>');"></iframe>
                                <a href="{{ $url }}" class="download-btn" download>Download File Office</a>

                            @else
                                <a href="{{ $url }}" class="download-btn" target="_blank">Download File</a>
                            @endif
                        @endforeach
                    </div>
                @endif

            </div>
            <hr class="my-6 border-gray-300">
        @endforeach
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
