@extends('layouts.admin')

@section('title', 'Edit Konten Menu')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Edit Konten Menu</h2>

    @if(session('success'))
        <p class="text-green-600 mb-4">{{ session('success') }}</p>
    @endif

    <form action="{{ route('menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Pilih Profile --}}
        <div class="mb-4">
            <label for="profile_id" class="block font-semibold">Pilih Profile</label>
            <select name="profile_id" id="profile_id" class="w-full border rounded p-2 @error('profile_id') border-red-500 @enderror" required>
                <option value="">-- Pilih Profile --</option>
                @foreach($profiles as $profile)
                    <option value="{{ $profile->id }}" {{ $menu->profile_id == $profile->id ? 'selected' : '' }}>
                        {{ $profile->title }}
                    </option>
                @endforeach
            </select>
            @error('profile_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

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
    <div id="editor-{{ $key }}" class="ql-editor">{!! old($key, $menu->content) !!}</div>
    <textarea name="{{ $key }}" id="{{ $key }}" class="hidden">{{ old($key, $menu->content) }}</textarea>
    @error($key)
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>


                {{-- Foto --}}
                <div class="mt-4">
                    <label for="{{ $key }}_photos" class="block font-semibold">Foto {{ $label }} (Opsional)</label>
                    <input type="file" name="{{ $key }}_photos[]" id="{{ $key }}_photos" multiple accept="image/*" class="w-full border rounded p-2">

                    {{-- Preview Foto --}}
                    <div id="preview-{{ $key }}" class="gallery mt-2 flex flex-wrap gap-2">
                        @foreach(json_decode($menu->content_section_photos ?? '[]') as $photo)
                        <div class="img-wrapper relative" data-old="1">
                            <span class="photo-order">{{ $loop->iteration }}.</span>
                            <img src="{{ asset('storage/'.$photo) }}" class="w-24 h-24 object-cover border rounded">
                            <span onclick="removeOldPhoto(this)">✖</span>
                            <input type="hidden" name="old_photos[]" value="{{ $photo }}">
                        </div>
                        @endforeach
                    </div>

                    {{-- Teks Foto --}}
                    <div class="mt-2">
                        <label class="block font-semibold mb-1">Teks Foto</label>
                        <div id="editor-{{ $key }}_photos_text" class="ql-editor">{!! old($key.'_photos_text', $menu->{$key.'_photos_text'}) !!}</div>
                        <textarea name="{{ $key }}_photos_text" id="{{ $key }}_photos_text" class="hidden">{{ old($key.'_photos_text', $menu->{$key.'_photos_text'}) }}</textarea>
                    </div>
                </div>

                {{-- File --}}
                <div class="mt-4">
                    <label for="{{ $key }}_files" class="block font-semibold">File {{ $label }} (Opsional)</label>
                    <input type="file" name="{{ $key }}_files[]" id="{{ $key }}_files" multiple class="w-full border rounded p-2">

                    {{-- Preview File --}}
                    <div id="file-preview-{{ $key }}" class="mt-2 flex flex-col gap-2">
                        @foreach(json_decode($menu->content_section_files ?? '[]') as $file)
                        <div class="file-wrapper" data-old="1">
                            <span>{{ basename($file) }}</span>
                            <span onclick="removeOldFile(this)" style="cursor:pointer;color:red;font-weight:bold;">✖</span>
                            <input type="hidden" name="old_files[]" value="{{ $file }}">
                        </div>
                        @endforeach
                    </div>
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

function removeOldPhoto(el){
    const wrapper = el.parentElement;
    const hiddenInput = wrapper.querySelector('input[name="old_photos[]"]');
    if(hiddenInput) hiddenInput.disabled = true;
    wrapper.remove();
    updatePhotoOrder(wrapper.closest('.gallery'));
}

function removeOldFile(el){
    const wrapper = el.parentElement;
    const hiddenInput = wrapper.querySelector('input[name="old_files[]"]');
    if(hiddenInput) hiddenInput.disabled = true;
    wrapper.remove();
}

function updatePhotoOrder(preview){
    if(!preview) return;
    const wrappers = preview.querySelectorAll('.img-wrapper');
    wrappers.forEach((el,i) => el.querySelector('.photo-order').textContent = (i+1)+'.');
}

function rebuildInputFiles(inputEl, filesArr){
    const dt = new DataTransfer();
    filesArr.forEach(f => dt.items.add(f));
    inputEl.files = dt.files;
}

document.addEventListener('DOMContentLoaded', () => {
    const key = 'content_section';

    // Quill editor utama
    const editorEl = document.getElementById(`editor-${key}`);
    const textareaEl = document.getElementById(key);
    const quill = new Quill(editorEl, { theme: 'snow', modules: { toolbar: toolbarOptions } });
    quill.root.innerHTML = textareaEl.value;
    quill.on('text-change', () => textareaEl.value = quill.root.innerHTML);

    // Quill teks foto
    const editorPhotoEl = document.getElementById(`editor-${key}_photos_text`);
    const textareaPhotoEl = document.getElementById(`${key}_photos_text`);
    if(editorPhotoEl){
        const quillPhoto = new Quill(editorPhotoEl, { theme: 'snow', modules: { toolbar: toolbarOptions } });
        quillPhoto.root.innerHTML = textareaPhotoEl.value;
        quillPhoto.on('text-change', () => textareaPhotoEl.value = quillPhoto.root.innerHTML);
    }

    // Foto baru
    const inputPhoto = document.getElementById(`${key}_photos`);
    const previewPhoto = document.getElementById(`preview-${key}`);
    let newPhotos = [];

    inputPhoto.addEventListener('change', e => {
        const files = Array.from(e.target.files);
        files.forEach(file => {
            newPhotos.push(file);

            const reader = new FileReader();
            reader.onload = ev => {
                const wrapper = document.createElement('div');
                wrapper.className = 'img-wrapper relative';
                wrapper.dataset.new = '1';

                const orderSpan = document.createElement('span');
                orderSpan.className = 'photo-order';
                orderSpan.textContent = previewPhoto.children.length + 1 + '.';

                const img = document.createElement('img');
                img.src = ev.target.result;
                img.className = 'w-24 h-24 object-cover border rounded';

                const btn = document.createElement('span');
                btn.innerHTML = '✖';
                btn.onclick = () => {
                    const idx = newPhotos.findIndex(f => f.name === file.name && f.size === file.size);
                    if(idx > -1) newPhotos.splice(idx,1);
                    wrapper.remove();
                    updatePhotoOrder(previewPhoto);
                    rebuildInputFiles(inputPhoto, newPhotos);
                };

                wrapper.appendChild(orderSpan);
                wrapper.appendChild(img);
                wrapper.appendChild(btn);
                previewPhoto.appendChild(wrapper);
                rebuildInputFiles(inputPhoto, newPhotos);
            };
            reader.readAsDataURL(file);
        });
    });

    // File baru
    const inputFile = document.getElementById(`${key}_files`);
    const previewFile = document.getElementById(`file-preview-${key}`);
    let newFiles = [];

    inputFile.addEventListener('change', e => {
        const files = Array.from(e.target.files);
        files.forEach(file => {
            newFiles.push(file);

            const wrapper = document.createElement('div');
            wrapper.className = 'file-wrapper';
            wrapper.dataset.new = '1';

            const span = document.createElement('span');
            span.textContent = file.name;

            const btn = document.createElement('button');
            btn.type = 'button';
            btn.textContent = '✖';
            btn.onclick = () => {
                const idx = newFiles.findIndex(f => f.name === file.name && f.size === file.size);
                if(idx > -1) newFiles.splice(idx,1);
                wrapper.remove();
                rebuildInputFiles(inputFile, newFiles);
            };

            wrapper.appendChild(span);
            wrapper.appendChild(btn);
            previewFile.appendChild(wrapper);
            rebuildInputFiles(inputFile, newFiles);
        });
    });

});
</script>
@endsection
