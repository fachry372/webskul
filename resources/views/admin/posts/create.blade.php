@extends('layouts.admin')

@section('title', 'Tambah Post')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Tambah Post</h2>

    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="jurusan_id" class="block font-semibold">Jurusan</label>
            <select name="jurusan_id" id="jurusan_id" class="w-full border rounded p-2 @error('jurusan_id') border-red-500 @enderror" required>
                <option value="">Pilih Jurusan</option>
                @foreach ($jurusan as $item)
                    <option value="{{ $item->id }}" {{ old('jurusan_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
            </select>
            @error('jurusan_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="title" class="block font-semibold">Judul</label>
            <input type="text" name="title" id="title" class="w-full border rounded p-2 @error('title') border-red-500 @enderror" value="{{ old('title') }}" required>
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="image" class="block font-semibold">Gambar Utama (Opsional)</label>
            <input type="file" name="image" id="image" class="w-full border rounded p-2 @error('image') border-red-500 @enderror">
            @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

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
            <div class="mb-4 card border rounded">
                <div class="card-header bg-gray-100 p-3 flex justify-between items-center cursor-pointer" onclick="toggleCard('{{ $key }}')">
                    <h3 class="font-semibold">{{ $label }}</h3>
                    <svg id="arrow-{{ $key }}" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
                <div id="content-{{ $key }}" class="card-content p-3" style="display: none;">
                    <div class="mb-4">
                        <label class="block font-semibold mb-2">Konten {{ $label }}</label>
                        <div id="editor-{{ $key }}" class="ql-editor">
                            {!! old($key, '') !!}
                        </div>
                        <textarea name="{{ $key }}" id="{{ $key }}" class="hidden">{{ old($key, '') }}</textarea>
                        @error($key)
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label for="{{ $key }}_photos" class="block font-semibold">Foto {{ $label }} (Opsional)</label>
                        <input type="file" name="{{ $key }}_photos[]" id="{{ $key }}_photos" multiple accept="image/*" class="w-full border rounded p-2 @error($key . '_photos') border-red-500 @enderror">
                        @error($key . '_photos')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <div id="preview-{{ $key }}" class="gallery mt-2 flex flex-wrap gap-2"></div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="mt-6">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Simpan</button>
            <a href="{{ route('admin.posts.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600 ml-2">Batal</a>
        </div>
    </form>
</div>
@endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css" rel="stylesheet">
<style>
    .card-header:hover { background-color: #e5e7eb; }
    .card-header svg.rotate { transform: rotate(180deg); }
    .ql-editor {
        min-height: 200px;
        background: #fff;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    .ql-editor img {
        max-width: 100%;
        height: auto;
        margin: 10px 0;
    }
    .ql-container {
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    .ql-toolbar {
        border: 1px solid #ccc;
        border-bottom: none;
        border-radius: 4px 4px 0 0;
    }
    .gallery {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin: 10px 0;
    }
    .gallery img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border: 1px solid #e5e7eb;
        border-radius: 4px;
    }
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function toggleCard(id) {
        const content = document.getElementById(`content-${id}`);
        const arrow = document.getElementById(`arrow-${id}`);
        if (content && arrow) {
            content.style.display = content.style.display === 'none' ? 'block' : 'none';
            arrow.classList.toggle('rotate');
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        // Inisialisasi semua editor Quill
        @foreach ($sections as $key => $label)
            try {
                const editorElement = document.getElementById(`editor-{{ $key }}`);
                const textareaElement = document.getElementById(`{{ $key }}`);

                if (!editorElement || !textareaElement) {
                    console.error('Editor or textarea not found for: {{ $key }}');
                    return;
                }

                const quill = new Quill(editorElement, {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                            ['bold', 'italic', 'underline', 'strike'],
                            [{ 'color': [] }, { 'background': [] }],
                            [{ 'font': [] }],
                            [{ 'align': [] }],
                            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                            ['link', 'image', 'code-block'],
                            ['clean']
                        ]
                    },
                    placeholder: 'Tulis {{ $label }} di sini...'
                });

                // Set initial content
                if (textareaElement.value) {
                    quill.root.innerHTML = textareaElement.value;
                }

                // Update textarea on change
                quill.on('text-change', () => {
                    textareaElement.value = quill.root.innerHTML;
                });

                // Handle image upload
                quill.getModule('toolbar').addHandler('image', () => {
                    const input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');
                    input.click();

                    input.onchange = async () => {
                        const file = input.files[0];
                        if (file) {
                            const formData = new FormData();
                            formData.append('image', file);
                            formData.append('_token', '{{ csrf_token() }}');

                            try {
                                const response = await fetch('{{ route("admin.posts.upload") }}', {
                                    method: 'POST',
                                    body: formData
                                });

                                const result = await response.json();
                                if (result.success) {
                                    const range = quill.getSelection();
                                    quill.insertEmbed(range.index, 'image', result.url);
                                } else {
                                    Swal.fire('Gagal!', result.error || 'Gagal mengunggah gambar', 'error');
                                }
                            } catch (error) {
                                Swal.fire('Error!', 'Terjadi kesalahan: ' + error.message, 'error');
                            }
                        }
                    };
                });

            } catch (error) {
                console.error('Error initializing Quill for {{ $key }}:', error);
            }
        @endforeach

        // Handle photo upload preview
        @foreach (array_keys($sections) as $key)
            const input{{ $key }} = document.getElementById('{{ $key }}_photos');
            if (input{{ $key }}) {
                input{{ $key }}.addEventListener('change', function(e) {
                    const files = e.target.files;
                    const preview = document.getElementById('preview-{{ $key }}');
                    preview.innerHTML = '';

                    if (files.length > 0) {
                        for (let i = 0; i < files.length; i++) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const img = document.createElement('img');
                                img.src = e.target.result;
                                img.className = 'w-24 h-24 object-cover border rounded';
                                preview.appendChild(img);
                            }
                            reader.readAsDataURL(files[i]);
                        }
                    }
                });
            }
        @endforeach
    });
</script>
@endsection