@extends('layouts.admin')

@section('title', 'Tambah Konten Menu')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Tambah Konten Menu</h2>

    @if(session('success'))
        <p class="text-green-600 mb-4">{{ session('success') }}</p>
    @endif

    <form id="menuForm" action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Pilih Profile --}}
        <div class="mb-4">
            <label for="profile_id" class="block font-semibold">Pilih Profile</label>
            <select name="profile_id" id="profile_id" class="w-full border rounded p-2 @error('profile_id') border-red-500 @enderror" required>
                <option value="">-- Pilih Profile --</option>
                @foreach($profiles as $profile)
                    <option value="{{ $profile->id }}" {{ old('profile_id') == $profile->id ? 'selected' : '' }}>
                        {{ $profile->title }}
                    </option>
                @endforeach
            </select>
            @error('profile_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Section --}}
        @php
            $key = 'content_section';
            $label = 'Konten Menu';
        @endphp
        <div class="mb-4 card border rounded">
            <div class="card-header bg-gray-100 p-3 flex justify-between items-center cursor-pointer" onclick="toggleCard('{{ $key }}')">
                <h3 class="font-semibold">{{ $label }}</h3>
                <svg id="arrow-{{ $key }}" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
            <div id="content-{{ $key }}" class="card-content p-3" style="display: block;">

                {{-- Konten Quill --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-2">Konten {{ $label }}</label>
                    <div id="editor-{{ $key }}" class="ql-editor">{!! old($key, '') !!}</div>
                    <textarea name="{{ $key }}" id="{{ $key }}" class="hidden">{{ old($key, '') }}</textarea>
                    @error($key)
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Upload Foto --}}
                <div class="mt-4">
                    <label for="{{ $key }}_photos" class="block font-semibold">Foto {{ $label }} (Opsional)</label>
                    <input type="file" name="{{ $key }}_photos[]" id="{{ $key }}_photos" multiple accept="image/*" class="w-full border rounded p-2">
                    <div id="preview-{{ $key }}" class="gallery mt-2 flex flex-wrap gap-2"></div>

                    {{-- Teks di bawah foto --}}
                    <div class="mt-2">
                        <label class="block font-semibold mb-1">Teks Foto</label>
                        <div id="editor-{{ $key }}_photos_text" class="ql-editor">{!! old($key.'_photos_text','') !!}</div>
                        <textarea name="{{ $key }}_photos_text" id="{{ $key }}_photos_text" class="hidden">{{ old($key.'_photos_text','') }}</textarea>
                    </div>
                </div>

                {{-- Upload File --}}
                <div class="mt-4">
                    <label for="{{ $key }}_files" class="block font-semibold">File {{ $label }} (Opsional)</label>
                    <input type="file" name="{{ $key }}_files[]" id="{{ $key }}_files" multiple class="w-full border rounded p-2">
                    <div id="file-preview-{{ $key }}" class="mt-2 flex flex-col gap-2"></div>
                </div>

            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Simpan</button>
            <a href="{{ route('menus.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600 ml-2">Batal</a>
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
.img-wrapper span.photo-order { position: absolute; top: 2px; left: 2px; background: rgba(0,0,0,0.4); color: white; font-size: 14px; font-weight: bold; width: auto; height: auto; line-height: normal; padding: 2px 4px; border-radius: 3px; }
.file-wrapper { display: flex; justify-content: space-between; align-items: center; padding: 5px 10px; background: #f3f4f6; border: 1px solid #e5e7eb; border-radius: 4px; }
.file-wrapper button { color: #dc2626; font-weight: bold; }
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.js"></script>
<script>
const toolbarOptions = [
    [{ 'header': [1,2,3,4,5,6,false] }],
    ['bold','italic','underline','strike'],
    [{ 'color': [] }, { 'background': [] }],
    [{ 'font': [] }],
    [{ 'align': [] }],
    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
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

document.addEventListener('DOMContentLoaded', () => {
    const key = 'content_section';

    // Quill editors
    const editorEl = document.getElementById(`editor-${key}`);
    const textareaEl = document.getElementById(key);
    const quill = new Quill(editorEl, { theme: 'snow', modules: { toolbar: toolbarOptions } });
    quill.root.innerHTML = textareaEl.value;
    quill.on('text-change', () => textareaEl.value = quill.root.innerHTML);

    const editorPhotoEl = document.getElementById(`editor-${key}_photos_text`);
    const textareaPhotoEl = document.getElementById(`${key}_photos_text`);
    const quillPhoto = new Quill(editorPhotoEl, { theme: 'snow', modules: { toolbar: toolbarOptions } });
    quillPhoto.root.innerHTML = textareaPhotoEl.value;
    quillPhoto.on('text-change', () => textareaPhotoEl.value = quillPhoto.root.innerHTML);

    // Photo preview
    const inputPhoto = document.getElementById(`${key}_photos`);
    const preview = document.getElementById(`preview-${key}`);
    let newPhotos = [];

    inputPhoto.addEventListener('change', e => {
        const files = Array.from(e.target.files);
        files.forEach(file => {
            newPhotos.push(file);
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
                btn.onclick = () => {
                    const idx = newPhotos.indexOf(file);
                    if(idx > -1) newPhotos.splice(idx,1);
                    wrapper.remove();
                    updatePhotoOrder(preview);
                };

                wrapper.appendChild(orderSpan);
                wrapper.appendChild(img);
                wrapper.appendChild(btn);
                preview.appendChild(wrapper);
            };
            reader.readAsDataURL(file);
        });
        // rebuild input files sebelum submit
        inputPhoto.files = new DataTransfer().files;
        newPhotos.forEach(f => inputPhoto.files = appendFile(inputPhoto.files, f));
    });

    function updatePhotoOrder(preview){
        const wrappers = preview.querySelectorAll('.img-wrapper');
        wrappers.forEach((el,i) => el.querySelector('.photo-order').textContent = (i+1)+'.');
    }

    function appendFile(fileList, file){
        const dt = new DataTransfer();
        Array.from(fileList).forEach(f => dt.items.add(f));
        dt.items.add(file);
        return dt.files;
    }

    // File preview
    const inputFile = document.getElementById(`${key}_files`);
    const filePreview = document.getElementById(`file-preview-${key}`);
    let newFiles = [];

    inputFile.addEventListener('change', e => {
        const files = Array.from(e.target.files);
        files.forEach(file => {
            newFiles.push(file);
            const wrapper = document.createElement('div');
            wrapper.className = 'file-wrapper';

            const span = document.createElement('span');
            span.textContent = file.name;

            const btn = document.createElement('button');
            btn.type = 'button';
            btn.textContent = '✖';
            btn.onclick = () => {
                const idx = newFiles.indexOf(file);
                if(idx > -1) newFiles.splice(idx,1);
                wrapper.remove();
            };

            wrapper.appendChild(span);
            wrapper.appendChild(btn);
            filePreview.appendChild(wrapper);
        });
        // rebuild input files
        inputFile.files = new DataTransfer().files;
        newFiles.forEach(f => inputFile.files = appendFile(inputFile.files, f));
    });

    // Pastikan Quill update textarea sebelum submit
    const form = document.getElementById('menuForm');
    form.addEventListener('submit', () => {
        textareaEl.value = quill.root.innerHTML;
        textareaPhotoEl.value = quillPhoto.root.innerHTML;
    });
});
</script>
@endsection
