@extends('layouts.visitor')

@section('title', $jurusan->name ?? 'Jurusan Tidak Ditemukan')

@section('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
<style>
    /* Mengatur lebar, warna, dan margin untuk konten dalam .prose */
    .prose { max-width: 100%; color: #4a5568; }

    /* Mengatur style gambar yang diupload via Quill */
    .prose img {
        max-width: 100%;
        width: calc(100% - 2rem);
        height: auto;
        margin: 1rem auto;
        border: 1px solid #e5e7eb;
        border-radius: 4px;
        display: block;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .prose .ql-align-center img { margin-left:auto;margin-right:auto; }
    .prose .ql-align-left img { float:left; margin:0 1rem 1rem 0; }
    .prose .ql-align-right img { float:right; margin:0 0 1rem 1rem; }

    /* Mengatur list, pastikan padding-nya konsisten */
    .prose ol, .prose ul { padding-left: 2rem; margin: 1rem 0; }
    .prose li { margin-bottom:0.5rem; font-size:1rem; line-height:1.5; }

    /* Membersihkan float setelah gambar */
    .prose::after { content:''; display:table; clear:both; }

    /* Menyesuaikan tampilan galeri foto */
    .gallery { display:grid; grid-template-columns:repeat(auto-fit,minmax(150px,1fr)); gap:10px; margin:10px 0; justify-content:center; }
    .gallery-image { width:100%; height:150px; object-fit:cover; border:1px solid #e5e7eb; border-radius:4px; box-shadow:0 2px 4px rgba(0,0,0,0.1); transition:transform 0.3s ease; }
    .gallery-image:hover { transform:scale(1.05); }

    /* Media queries untuk tampilan responsif */
    @media (max-width:1024px){ .gallery { grid-template-columns: repeat(2,minmax(150px,1fr)); } }
    @media (max-width:768px){ .gallery { grid-template-columns: repeat(auto-fit,minmax(120px,1fr)); } .gallery-image { height:120px; } }
    @media (max-width:480px){ .gallery { grid-template-columns: repeat(auto-fit,minmax(100px,1fr)); } .gallery-image { height:100px; } }
</style>
@endsection

@section('content')
    <section class="relative w-full h-80 bg-cover bg-center text-white flex items-center justify-center overflow-hidden"
        style="background-image: url('{{ $jurusan->image ? Storage::url($jurusan->image) : asset('images/default-banner.jpg') }}');" data-aos="fade-in">
        <div class="absolute inset-0 bg-[#344966]/70 z-0"></div>
        <div class="relative z-10 text-center px-4">
            <h1 class="text-3xl md:text-4xl font-bold uppercase mb-2">{{ $jurusan->name ?? 'Jurusan Tidak Ditemukan' }}</h1>
            <p class="text-lg md:text-xl">SMK Negeri 1 Subang - The School of CEREN Models</p>
        </div>
    </section>

    <div class="w-full bg-white rounded-lg shadow my-8 px-4 sm:px-6 md:px-12 lg:px-20 py-6" data-aos="fade-up">

        {{-- Gunakan variabel untuk melacak apakah ada konten yang ditampilkan --}}
        @php
            $hasContent = false;
        @endphp

        @forelse($posts as $post)
            @if($post->image)
                @php $hasContent = true; @endphp
                <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" class="w-full max-w-md object-cover mb-4 rounded" data-aos="fade-up">
            @endif

            {{-- Definisikan sections di sini agar Blade lebih mandiri --}}
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
                        @if(!empty($post->$key))
                            <div class="prose max-w-none">{!! $post->$key !!}</div>
                        @endif
                        @if(!empty($post->{$key . '_photos'}))
                            <div class="gallery mt-4">
                                @foreach(json_decode($post->{$key . '_photos'}, true) as $photo)
                                    <img src="{{ Storage::url($photo) }}" alt="{{ $label }} Foto"
                                         class="gallery-image rounded-lg shadow" loading="lazy" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif
            @endforeach

            {{-- Tampilkan garis pemisah hanya jika ada konten --}}
            @if($hasContent)
                <hr class="my-8 border-gray-300">
            @endif
        @empty
            {{-- Tidak ada konten, set variabel ke false --}}
        @endforelse

        {{-- Tampilkan pesan jika variabel hasContent tetap false --}}
        @if(!$hasContent)
            <p class="text-xl text-red-600 font-semibold text-center">Belum ada data untuk jurusan ini.</p>
        @endif
    </div>
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        once: true,
    });
</script>
@endsection