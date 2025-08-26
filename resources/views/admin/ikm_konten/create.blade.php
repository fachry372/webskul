@extends('layouts.admin')

@section('title', 'Tambah Konten IKM')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css" rel="stylesheet">
<style>
    .card { border: 1px solid #ccc; border-radius: 6px; margin-bottom: 1rem; }
    .card-header { background: #f3f4f6; padding: 0.5rem 1rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center; }
    .card-header:hover { background: #e5e7eb; }
    .ql-editor { min-height: 150px; background: #fff; border: 1px solid #ccc; border-radius: 4px; }
    .gallery img, .gallery video { width: 120px; height: 120px; object-fit: cover; border-radius: 4px; margin-right: 0.5rem; margin-bottom: 0.5rem; }
    .img-wrapper { position: relative; display: inline-block; }
    .img-wrapper span { position: absolute; top: -6px; right: -6px; background: #dc2626; color: white; font-size: 16px; border-radius: 50%; width: 24px; height: 24px; line-height: 22px; text-align: center; cursor: pointer; }
</style>
@endsection

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Tambah Konten IKM</h2>

    @if(session('success'))
        <p class="text-green-600 mb-4">{{ session('success') }}</p>
    @endif

    <form id="ikmCreateForm" action="{{ route('admin.ikm_konten.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Pilih IKM --}}
        <div class="mb-4">
            <label for="ikm_id" class="block font-semibold">Pilih IKM</label>
            <select name="ikm_id" id="ikm_id" class="w-full border rounded p-2 @error('ikm_id') border-red-500 @enderror" required>
                <option value="">-- Pilih IKM --</option>
                @foreach($ikms as $ikm)
                    <option value="{{ $ikm->id }}" {{ old('ikm_id') == $ikm->id ? 'selected' : '' }}>{{ $ikm->title }}</option>
                @endforeach
            </select>
            @error('ikm_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Container blok --}}
        <div id="blocks-container"></div>

        <button type="button" id="add-block" class="bg-green-600 text-white px-4 py-2 rounded mb-4">Tambah Blok</button>

        <div>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Simpan</button>
            <a href="{{ route('admin.ikm_konten.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600 ml-2">Batal</a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.js"></script>
<script>
const toolbarOptions = [
    [{ 'header': [1,2,3,false] }],
    ['bold','italic','underline','strike'],
    [{ 'color': [] }, { 'background': [] }],
    [{ 'align': [] }],
    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
    ['link','image','code-block'],
    ['clean']
];

let blockIndex = 0;

function createBlock(index){
    const container = document.getElementById('blocks-container');
    const html = `
    <div class="card" data-index="${index}">
        <div class="card-header">
            <h3>Blok Konten #${index + 1}</h3>
            <button type="button" class="text-red-600 remove-block">Hapus</button>
        </div>
        <div class="card-body p-3">
            <label class="block font-semibold mb-1">Judul</label>
            <input type="text" name="blocks[${index}][title]" class="w-full border rounded p-2 mb-3" required>

            <label class="block font-semibold mb-1">Konten</label>
            <div id="editor-text-${index}" class="ql-editor mb-2"></div>
            <textarea name="blocks[${index}][text]" id="text-${index}" class="hidden"></textarea>

            <label class="block font-semibold mt-3 mb-1">Foto</label>
            <input type="file" name="blocks[${index}][photos][]" multiple accept="image/*">
            <div class="gallery" id="preview-photos-${index}"></div>

            <label class="block font-semibold mt-3 mb-1">Video</label>
            <input type="file" name="blocks[${index}][videos][]" multiple accept="video/*">
            <div class="gallery" id="preview-videos-${index}"></div>

            <label class="block font-semibold mt-3 mb-1">File</label>
            <input type="file" name="blocks[${index}][files][]" multiple class="w-full border rounded p-2">
        </div>
    </div>`;
    container.insertAdjacentHTML('beforeend', html);

    // Quill init
    const quill = new Quill(`#editor-text-${index}`, { theme: 'snow', modules:{ toolbar: toolbarOptions } });

    // Preview Foto
    const photoInput = document.querySelector(`input[name="blocks[${index}][photos][]"]`);
    const photoPreview = document.getElementById(`preview-photos-${index}`);
    photoInput.addEventListener('change', e => {
        photoPreview.innerHTML = '';
        Array.from(e.target.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = ev => {
                const img = document.createElement('img');
                img.src = ev.target.result;
                photoPreview.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    });

    // Preview Video
    const videoInput = document.querySelector(`input[name="blocks[${index}][videos][]"]`);
    const videoPreview = document.getElementById(`preview-videos-${index}`);
    videoInput.addEventListener('change', e => {
        videoPreview.innerHTML = '';
        Array.from(e.target.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = ev => {
                const video = document.createElement('video');
                video.src = ev.target.result;
                video.controls = true;
                videoPreview.appendChild(video);
            };
            reader.readAsDataURL(file);
        });
    });

    // Hapus blok
    const removeBtn = container.querySelector(`.card[data-index="${index}"] .remove-block`);
    removeBtn.addEventListener('click', () => {
        container.querySelector(`.card[data-index="${index}"]`).remove();
    });
}

// Tambah blok baru
document.getElementById('add-block').addEventListener('click', () => {
    createBlock(blockIndex++);
});

// Pastikan Quill update textarea saat submit
document.getElementById('ikmCreateForm').addEventListener('submit', () => {
    for(let i=0; i<blockIndex; i++){
        const textarea = document.getElementById(`text-${i}`);
        const editor = document.getElementById(`editor-text-${i}`);
        if(textarea && editor){
            textarea.value = editor.querySelector('.ql-editor').innerHTML;
        }
    }
});

// Tambahkan satu blok awal otomatis
createBlock(blockIndex++);
</script>
@endsection
