@extends('layouts.admin')

@section('title', 'Edit Post')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Edit Post</h2>

    <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Pilihan Jurusan --}}
        <div class="mb-4">
            <label for="jurusan_id" class="block font-semibold">Jurusan</label>
            <select name="jurusan_id" id="jurusan_id" class="w-full border rounded p-2 @error('jurusan_id') border-red-500 @enderror" required>
                <option value="">Pilih Jurusan</option>
                @foreach ($jurusan as $item)
                    <option value="{{ $item->id }}" {{ old('jurusan_id', $post->jurusan_id) == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
            </select>
            @error('jurusan_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Judul --}}
        <div class="mb-4">
            <label for="title" class="block font-semibold">Judul</label>
            <input type="text" name="title" id="title" class="w-full border rounded p-2 @error('title') border-red-500 @enderror" value="{{ old('title', $post->title) }}" required>
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Gambar Utama --}}
        <div class="mb-4">
            <label for="image" class="block font-semibold">Gambar Utama (Opsional)</label>
            @if ($post->image)
                <div class="mb-2 relative">
                    <span class="photo-order">1.</span>
                    <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" class="w-32 h-32 object-cover border rounded">
                </div>
            @endif
            <input type="file" name="image" id="image" class="w-full border rounded p-2 @error('image') border-red-500 @enderror">
            @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

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

        @foreach ($sections as $key => $label)
            @php
                $photos = json_decode($post->{$key . '_photos'} ?? '[]', true);
                $files  = json_decode($post->{$key . '_files'} ?? '[]', true);
            @endphp
            <div class="mb-4 card border rounded">
                <div class="card-header bg-gray-100 p-3 flex justify-between items-center cursor-pointer" onclick="toggleCard('{{ $key }}')">
                    <h3 class="font-semibold">{{ $label }}</h3>
                    <svg id="arrow-{{ $key }}" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
                <div id="content-{{ $key }}" class="card-content p-3" style="display: none;">
                    {{-- Quill Editor --}}
                    <div class="mb-4">
                        <label class="block font-semibold mb-2">Konten {{ $label }}</label>
                        <div id="editor-{{ $key }}" class="ql-editor"></div>
                        <textarea name="{{ $key }}" id="{{ $key }}" class="hidden">{{ old($key, $post->$key) }}</textarea>
                        @error($key)
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Foto --}}
                    <div class="mt-4">
                        <label for="{{ $key }}_photos" class="block font-semibold">Foto {{ $label }} (Opsional)</label>
                        <input type="file" name="{{ $key }}_photos[]" id="{{ $key }}_photos" multiple accept="image/*" class="w-full border rounded p-2">
                        <input type="hidden" name="{{ $key }}_photos_json" id="{{ $key }}_photos_json" value="{{ json_encode($photos) }}">
                        <div id="preview-{{ $key }}" class="gallery mt-2 flex flex-wrap gap-2">
                            @if($photos)
                                @foreach($photos as $i => $photo)
                                    <div class="img-wrapper relative">
                                        <span class="photo-order">{{ $i+1 }}.</span>
                                        <img src="{{ Storage::url($photo) }}" class="w-24 h-24 object-cover border rounded">
                                        <span onclick="removeImage('{{ $key }}', '{{ $photo }}', this)">✖</span>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        {{-- Teks di bawah foto --}}
                        <div class="mt-2">
                            <label class="block font-semibold mb-1">Teks Foto</label>
                            <div id="editor-{{ $key }}_photos_text" class="ql-editor"></div>
                            <textarea name="{{ $key }}_photos_text" id="{{ $key }}_photos_text" class="hidden">{{ old($key.'_photos_text', $post->{$key.'_photos_text'}) }}</textarea>
                        </div>
                    </div>

                    {{-- File --}}
                    <div class="mt-4">
                        <label for="{{ $key }}_files" class="block font-semibold">File {{ $label }} (Opsional)</label>
                        <input type="file" name="{{ $key }}_files[]" id="{{ $key }}_files" multiple class="w-full border rounded p-2">
                        <input type="hidden" name="{{ $key }}_files_json" id="{{ $key }}_files_json" value="{{ json_encode($files) }}">
                        <div id="file-preview-{{ $key }}" class="mt-2 flex flex-col gap-2">
                            @if($files)
                                @foreach($files as $file)
                                    <div class="flex items-center gap-2">
                                        <a href="{{ Storage::url($file['path']) }}" target="_blank" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">{{ $file['filename'] ?? basename($file['path']) }}</a>
                                        <button type="button" class="text-red-500 font-bold" onclick="removeFile('{{ $key }}', '{{ $file['path'] }}', this)">✖</button>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="mt-6">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Update</button>
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
.ql-editor { min-height: 200px; background: #fff; border: 1px solid #ccc; border-radius: 4px; }
.ql-editor img { max-width: 100%; height: auto; margin: 10px 0; }
.ql-container { border: 1px solid #ccc; border-radius: 4px; }
.ql-toolbar { border: 1px solid #ccc; border-bottom: none; border-radius: 4px 4px 0 0; }

.gallery { display: flex; flex-wrap: wrap; gap: 10px; margin: 10px 0; }
.gallery img { width: 100px; height: 100px; object-fit: cover; border: 1px solid #e5e7eb; border-radius: 4px; }

.img-wrapper { position: relative; display: inline-block; }
.img-wrapper span { position: absolute; top: -6px; right: -6px; background: #dc2626; color: white; font-size: 16px; border-radius: 50%; width: 24px; height: 24px; line-height: 22px; text-align: center; cursor: pointer; font-weight: bold; box-shadow: 0 2px 6px rgba(0,0,0,0.2); }
.img-wrapper span:hover { background: #b91c1c; }

.img-wrapper span.photo-order {
    position: absolute;
    top: 2px;
    left: 2px;
    background: rgba(0,0,0,0.4);
    color: white;
    font-size: 14px;
    font-weight: bold;
    width: auto;
    height: auto;
    line-height: normal;
    padding: 2px 4px;
    border-radius: 3px;
}
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
const toolbarOptions = [
    [{ 'header': [1,2,3,4,5,6,false] }],
    ['bold','italic','underline','strike'],
    [{ 'color': [] }, { 'background': [] }],
    [{ 'font': [] }],
    [{ 'align': [] }],
    [{ 'list': 'ordered' }, { 'list':'bullet' }],
    ['link','image','code-block'],
    ['clean']
];

function toggleCard(id) {
    const content = document.getElementById(`content-${id}`);
    const arrow = document.getElementById(`arrow-${id}`);
    if(content && arrow){
        content.style.display = content.style.display === 'none' ? 'block' : 'none';
        arrow.classList.toggle('rotate');
    }
}

function removeImage(sectionKey, photoPath, buttonElement){
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Gambar ini akan dihapus dari post!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if(result.isConfirmed){
            const jsonInput = document.getElementById(`${sectionKey}_photos_json`);
            let photos = JSON.parse(jsonInput.value || '[]');
            photos = photos.filter(p => p !== photoPath);
            jsonInput.value = JSON.stringify(photos);
            buttonElement.parentElement.remove();
            const wrappers = document.querySelectorAll(`#preview-${sectionKey} .img-wrapper`);
            wrappers.forEach((el,i) => el.querySelector('.photo-order').textContent = (i+1)+'.');
            Swal.fire('Terhapus!', 'Gambar berhasil dihapus.', 'success');
        }
    });
}

function removeFile(sectionKey, filePath, buttonElement){
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "File ini akan dihapus dari post!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if(result.isConfirmed){
            const jsonInput = document.getElementById(`${sectionKey}_files_json`);
            let files = JSON.parse(jsonInput.value || '[]');
            files = files.filter(f => f.path !== filePath);
            jsonInput.value = JSON.stringify(files);
            buttonElement.parentElement.remove();
            Swal.fire('Terhapus!', 'File berhasil dihapus.', 'success');
        }
    });
}

document.addEventListener('DOMContentLoaded', () => {
    const sections = @json(array_keys($sections));
    sections.forEach(key => {
        // Quill untuk konten utama
        const editorContainer = document.getElementById(`editor-${key}`);
        const textareaEl = document.getElementById(key);
        const quill = new Quill(editorContainer, { theme: 'snow', modules: { toolbar: toolbarOptions } });
        quill.root.innerHTML = textareaEl.value;
        quill.on('text-change', () => textareaEl.value = quill.root.innerHTML);

        // Quill untuk teks di bawah foto
        const editorPhotoContainer = document.getElementById(`editor-${key}_photos_text`);
        const textareaPhotoEl = document.getElementById(`${key}_photos_text`);
        if(editorPhotoContainer){
            const quillPhoto = new Quill(editorPhotoContainer, { theme: 'snow', modules: { toolbar: toolbarOptions } });
            quillPhoto.root.innerHTML = textareaPhotoEl.value;
            quillPhoto.on('text-change', () => textareaPhotoEl.value = quillPhoto.root.innerHTML);
        }

        // Preview foto baru
        const inputPhoto = document.getElementById(`${key}_photos`);
        if(inputPhoto){
            let dt = new DataTransfer();
            inputPhoto.addEventListener('change', e => {
                const files = Array.from(e.target.files);
                const preview = document.getElementById(`preview-${key}`);
                files.forEach(file => {
                    dt.items.add(file);
                    const reader = new FileReader();
                    reader.onload = ev => {
                        const wrapper = document.createElement('div');
                        wrapper.className = 'img-wrapper relative';
                        const orderSpan = document.createElement('span');
                        orderSpan.className = 'photo-order';
                        orderSpan.textContent = preview.children.length + 1 + '.';
                        const img = document.createElement('img');
                        img.src = ev.target.result;
                        img.className = 'w-24 h-24 object-cover border rounded';
                        const btn = document.createElement('span');
                        btn.innerHTML = '✖';
                        btn.onclick = () => { wrapper.remove(); updatePhotoOrder(preview); };
                        wrapper.appendChild(orderSpan);
                        wrapper.appendChild(img);
                        wrapper.appendChild(btn);
                        preview.appendChild(wrapper);
                    };
                    reader.readAsDataURL(file);
                });
                inputPhoto.files = dt.files;
            });
        }
    });
});

function updatePhotoOrder(preview){
    const wrappers = preview.querySelectorAll('.img-wrapper');
    wrappers.forEach((el,i) => el.querySelector('.photo-order').textContent = (i+1)+'.');
}
</script>
@endsection
