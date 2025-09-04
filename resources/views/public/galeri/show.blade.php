@extends('layouts.visitor')

@section('title', $galeri->judul ?? 'Galeri Tidak Ditemukan')

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
.gallery-image-wrapper {
    width: 100%;
    max-width: 450px;
    height: auto;
    overflow: hidden;
    border-radius: 6px;
    display: flex;
    justify-content: center;
    align-items: center;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    margin: 1rem auto;
}
.gallery-image-wrapper img {
    width: 100%;
    height: auto;
    object-fit: contain;
    transition: transform 0.3s ease;
    border-radius: 6px;
}
.gallery-image-wrapper img:hover { transform: scale(1.03); }

.grid-photos {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1rem;
    justify-items: center;
}

.download-btn { display: inline-block; background-color: #3b82f6; color: #fff; padding: 0.5rem 1rem; border-radius: 6px; text-decoration: none; margin-top: 0.5rem; }
.download-btn:hover { background-color: #2563eb; }

iframe.file-viewer { width: 100%; height: 75vh; max-height: 600px; border: 1px solid #ccc; border-radius: 6px; margin-bottom: 0.5rem; }
.fallback { background: #f9fafb; border: 1px dashed #ccc; padding: 1rem; border-radius: 6px; text-align: center; color: #666; margin-bottom: 0.5rem; }

.video-embed-wrapper { width: 100%; position: relative; }
.video-embed-wrapper iframe, .video-embed-wrapper video { position: absolute; top:0; left:0; width:100%; height:100%; border:0; border-radius: 6px; }
.aspect-16-9 { padding-bottom: 56.25%; height: 0; }
.aspect-9-16 { padding-bottom: 177.78%; height: 0; }

.video-embed-wrapper.portrait {
    width: 100%;
    max-width: 400px;
    aspect-ratio: 9 / 16;
    margin: 0 auto;
    border-radius: 6px;
    overflow: hidden;
}
.video-embed-wrapper.portrait iframe,
.video-embed-wrapper.portrait video {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    border-radius: 6px;
}

/* Responsive */
@media (max-width: 1024px) { .video-embed-wrapper.portrait { max-width: 100%; } }
@media (max-width: 768px) { .video-embed-wrapper.portrait { max-width: 100%; } }
</style>
@endsection

@section('content')

<!-- Banner -->
<section class="relative w-full h-80 bg-cover bg-center text-white flex items-center justify-center overflow-hidden"
    style="background-image: url('{{ $galeri->image ? Storage::url($galeri->image) : asset('images/default-banner.jpg') }}');"
    data-aos="fade-in">
    <div class="absolute inset-0 bg-[#344966]/70 z-0"></div>
    <div class="relative z-10 text-center px-4">
        <h1 class="text-3xl md:text-4xl font-bold uppercase mb-2">{{ $galeri->judul }}</h1>
        <p class="text-lg md:text-xl">SMK Negeri 1 Subang - Galeri</p>
    </div>
</section>

<!-- Konten -->
<div class="w-full bg-white rounded-lg shadow my-8 px-4 sm:px-6 md:px-12 lg:px-20 py-6" data-aos="fade-up">

    @forelse($validBlocks as $index => $block)
        <div class="mb-10" data-aos="fade-up">

            {{-- Judul --}}
            @if(!empty($block['title']))
                <h2 class="text-2xl font-bold text-gray-800 mb-3">{{ $block['title'] }}</h2>
            @endif

            {{-- Text --}}
            @if(!empty($block['text']))
                <div class="content-html mb-4">{!! $block['text'] !!}</div>
            @endif

            {{-- Foto --}}
            @if(!empty($block['photos']) && is_array($block['photos']))
            <div class="grid-photos mt-4">
                @foreach($block['photos'] as $photo)
                <div class="gallery-image-wrapper">
                    <img src="{{ Storage::url($photo) }}" alt="Foto Galeri">
                </div>
                @endforeach
            </div>
            @endif

            {{-- Video Lokal --}}
            @if(!empty($block['videos']) && is_array($block['videos']))
                @php $videoCount = count(array_filter($block['videos'])); @endphp
                @if($videoCount === 1)
                    @foreach($block['videos'] as $video)
                        @if($video)
                            <div class="video-embed-wrapper aspect-16-9 w-full mb-4">
                                <video src="{{ Storage::url($video) }}" controls class="w-full h-full rounded-lg shadow"></video>
                            </div>
                        @endif
                    @endforeach
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                        @foreach($block['videos'] as $video)
                            @if($video)
                                <div class="video-embed-wrapper aspect-16-9">
                                    <video src="{{ Storage::url($video) }}" controls class="w-full h-full rounded-lg shadow"></video>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
            @endif

            {{-- Video Link --}}
            @if(!empty($block['videos_link']) && is_array($block['videos_link']))
                @php
                    $youtubeLinks = collect($block['videos_link'])->filter(fn($l) => str_contains($l,'youtube.com') || str_contains($l,'youtu.be'));
                    $instagramLinks = collect($block['videos_link'])->filter(fn($l) => str_contains($l,'instagram.com'));
                    $tiktokLinks = collect($block['videos_link'])->filter(fn($l) => str_contains($l,'tiktok.com'));
                    $portraitLinks = $instagramLinks->merge($tiktokLinks);
                @endphp

                {{-- YouTube --}}
                @if($youtubeLinks->isNotEmpty())
                    <h3 class="text-xl font-semibold mt-6 mb-2">YouTube Videos</h3>
                    <div class="grid gap-6 justify-items-center
                        @if($youtubeLinks->count()===2) md:grid-cols-2
                        @elseif($youtubeLinks->count()>=3) md:grid-cols-3 @endif">
                        @foreach($youtubeLinks as $link)
                            <div class="video-embed-wrapper aspect-16-9 w-full">
                                <iframe src="{{ convertVideoLink($link) }}" allowfullscreen></iframe>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Instagram / TikTok --}}
                @if($portraitLinks->isNotEmpty())
                    <h3 class="text-xl font-semibold mt-6 mb-2">Instagram / TikTok Videos</h3>
                    @php
                        $count = $portraitLinks->count();
                        $colsClass = $count === 1 ? 'grid-cols-1 justify-items-center' : ($count === 2 ? 'md:grid-cols-2 justify-items-center' : 'md:grid-cols-3 justify-items-start');
                    @endphp
                    <div class="grid gap-6 {{ $colsClass }}">
                        @foreach($portraitLinks as $link)
                            <div class="video-embed-wrapper portrait w-full max-w-md">
                                <iframe src="{{ convertVideoLink(trim($link)) }}" allowfullscreen></iframe>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endif

            {{-- Files --}}
            @if(!empty($block['files']) && is_array($block['files']))
                <div class="mt-6 space-y-6">
                    @foreach($block['files'] as $file)
                        @if($file)
                            @php
                                $url = Storage::url($file);
                                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                            @endphp
                            @if($ext==='pdf')
                                <iframe src="{{ $url }}" class="file-viewer"></iframe>
                                <a href="{{ $url }}" class="download-btn" download>Download PDF</a>
                            @elseif(in_array($ext,['jpg','jpeg','png','gif','webp']))
                                <img src="{{ $url }}" class="gallery-image">
                                <a href="{{ $url }}" class="download-btn" download>Download Gambar</a>
                            @elseif(in_array($ext,['mp4','webm']))
                                <video src="{{ $url }}" controls class="w-full rounded-lg shadow"></video>
                                <a href="{{ $url }}" class="download-btn" download>Download Video</a>
                            @else
                                <div class="fallback">
                                    <p><strong>Pratinjau tidak tersedia.</strong></p>
                                    <p>Silakan download file untuk membukanya.</p>
                                </div>
                                <a href="{{ $url }}" class="download-btn" target="_blank">Download File</a>
                            @endif
                        @endif
                    @endforeach
                </div>
            @endif

        </div>
        @if(isset($validBlocks[$index+1])) <hr class="my-6 border-gray-300"> @endif
    @empty
        <p class="text-xl text-red-600 font-semibold text-center">Belum ada konten untuk galeri ini.</p>
    @endforelse

</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
AOS.init({ duration: 800, once: true });
</script>
@endsection
