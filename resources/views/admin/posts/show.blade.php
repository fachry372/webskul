@extends('layouts.admin')

@section('title', 'Detail Post')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
<style>
    .content-html {
        max-width: 100%;
        color: #4a5568;
        line-height: 1.7;
        font-family: sans-serif;
    }
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
        height: 200px;
        object-fit: cover;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
<div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow my-8">

    <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>
    <p class="mb-4"><strong>Jurusan:</strong> {{ $post->jurusan->name }}</p>

    @if($post->image)
        <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" class="w-full max-w-2xl object-cover mb-6 rounded mx-auto">
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
        @endphp

        @if(!empty($content) || !empty($photos) || !empty($files))
            <div class="mb-8">
                <h2 class="font-semibold text-lg text-gray-800 mb-2">{{ $label }}</h2>

                {{-- Konten HTML --}}
                @if(!empty($content))
                    <div class="content-html">{!! $content !!}</div>
                @endif

                {{-- Galeri Foto --}}
                @if(!empty($photos) && is_array($photos))
                    <div class="grid mt-4 gap-4
                        @if(count($photos) > 4) grid-cols-4
                        @elseif(count($photos) === 2) grid-cols-2
                        @elseif(count($photos) === 3) grid-cols-3
                        @else grid-cols-1 @endif">
                        @foreach($photos as $photo)
                            <img src="{{ Storage::url($photo) }}" alt="{{ $label }} Foto" class="gallery-image">
                        @endforeach
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
        @endif
    @endforeach

    <div class="mt-6">
        <a href="{{ route('admin.posts.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kembali</a>
    </div>

</div>
@endsection
