
@extends('layouts.admin')

@section('title', 'Detail Post')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">{{ $post->title }}</h2>
    <p><strong>Jurusan:</strong> {{ $post->jurusan->name }}</p>
    @if ($post->image)
        <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" class="w-full max-w-md object-cover mb-4 rounded">
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

    @foreach ($sections as $key => $label)
        @if ($post->$key || $post->{$key . '_photos'})
            <div class="mb-4">
                <h3 class="font-semibold text-lg">{{ $label }}</h3>
                @if ($post->$key)
                    <div class="prose max-w-none">{!! $post->$key !!}</div>
                @endif
                @if ($post->{$key . '_photos'})
                    <div class="gallery mb-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 justify-center">
                        @foreach (json_decode($post->{$key . '_photos'}, true) as $photo)
                            <img src="{{ Storage::url($photo) }}" alt="{{ $label }}" class="gallery-image rounded-lg shadow">
                        @endforeach
                    </div>
                @endif
            </div>
        @endif
    @endforeach

    <div class="mt-6">
        <a href="{{ route('admin.posts.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kembali</a>
        <a href="{{ route('admin.posts.edit', $post) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Edit</a>
        <button onclick="confirmDelete({{ $post->id }})" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Hapus</button>
    </div>
</div>
@endsection

@section('styles')
<style>
    .prose img {
        max-width: 100%;
        width: calc(100% - 2rem);
        height: auto;
        margin: 10px 1rem;
        border: 1px solid #e5e7eb;
        border-radius: 4px;
        display: block;
    }
    .prose .ql-align-center img {
        margin-left: auto;
        margin-right: auto;
    }
    .prose .ql-align-left img {
        float: left;
        margin-right: 1rem;
        margin-left: 1rem;
    }
    .prose .ql-align-right img {
        float: right;
        margin-left: 1rem;
        margin-right: 1rem;
    }
    .prose::after {
        content: '';
        display: table;
        clear: both;
    }
    .gallery {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 10px;
        margin: 10px 0;
        justify-content: center;
    }
    .gallery-image {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border: 1px solid #e5e7eb;
        border-radius: 4px;
    }
    @media (max-width: 768px) {
        .gallery {
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        }
        .gallery-image {
            height: 120px;
        }
    }
    @media (max-width: 480px) {
        .gallery {
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
        }
        .gallery-image {
            height: 100px;
        }
    }
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak akan dapat mengembalikan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route('admin.posts.destroy', '__ID__') }}'.replace('__ID__', id);
                form.innerHTML = '@csrf @method("DELETE")';
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>
@endsection

