@extends('layouts.admin')

@section('title', 'Edit Konten IKM')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css" rel="stylesheet">
<style>
.card { border: 1px solid #ccc; border-radius: 6px; margin-bottom: 1rem; }
.card-header { background: #f3f4f6; padding: 0.5rem 1rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center; }
.card-header:hover { background: #e5e7eb; }
.card-header h3 { display: flex; align-items: center; gap: 0.5rem; }
.arrow { display: inline-block; transition: transform 0.3s ease; }
.arrow.down { transform: rotate(90deg); }
.card-body { max-height: 1000px; overflow: hidden; transition: max-height 0.3s ease; padding: 1rem; border-top: 1px solid #ccc; }
.card-body.collapsed { max-height: 0; padding: 0 1rem; }
.ql-editor { min-height: 150px; background: #fff; border: 1px solid #ccc; border-radius: 4px; }
.gallery img, .gallery video { width: 120px; height: 120px; object-fit: cover; border-radius: 4px; margin-right: 0.5rem; margin-bottom: 0.5rem; }
.img-wrapper { position: relative; display: inline-block; }
.img-wrapper span { position: absolute; top: -6px; right: -6px; background: #dc2626; color: white; font-size: 16px; border-radius: 50%; width: 24px; height: 24px; line-height: 22px; text-align: center; cursor: pointer; }
.download-btn { display: block; margin-bottom: 4px; color: #2563eb; text-decoration: underline; }
</style>
@endsection

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Edit Konten IKM</h2>

    @if(session('success'))
        <p class="text-green-600 mb-4">{{ session('success') }}</p>
    @endif

    <form id="ikmEditForm" action="{{ route('admin.ikm_konten.update', $ikmKonten->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Pilih IKM --}}
        <div class="mb-4">
            <label for="ikm_id" class="block font-semibold">Pilih IKM</label>
            <select name="ikm_id" id="ikm_id" class="w-full border rounded p-2" required>
                <option value="">-- Pilih IKM --</option>
                @foreach($ikms as $ikm)
                    <option value="{{ $ikm->id }}" {{ $ikmKonten->ikm_id == $ikm->id ? 'selected' : '' }}>
                        {{ $ikm->title }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Blok Konten --}}
        <div id="blocks-container">
            @foreach($ikmKonten->blocks as $i => $block)
            <div class="card" data-index="{{ $i }}">
                <div class="card-header">
                    <h3><span class="arrow">&#9654;</span> Blok Konten #{{ $i + 1 }}</h3>
                    <button type="button" class="text-red-600 remove-block">Hapus</button>
                </div>
                <div class="card-body">
                    <label class="block font-semibold mb-1">Judul</label>
                    <input type="text" name="blocks[{{ $i }}][title]" value="{{ $block['title'] ?? '' }}" class="w-full border rounded p-2 mb-3" required>

                    <label class="block font-semibold mb-1">Konten</label>
                    <div id="editor-text-{{ $i }}" class="ql-editor mb-2">{!! $block['text'] ?? '' !!}</div>
                    <textarea name="blocks[{{ $i }}][text]" id="text-{{ $i }}" class="hidden">{{ $block['text'] ?? '' }}</textarea>

                    {{-- Foto --}}
                    <label class="block font-semibold mt-3 mb-1">Foto</label>
                    <input type="file" name="blocks[{{ $i }}][photos][]" multiple class="w-full border rounded p-2">
                    <div class="gallery mt-2">
                        @foreach($block['photos'] ?? [] as $photo)
                        <div class="img-wrapper">
                            <img src="{{ Storage::url($photo) }}" alt="Foto">
                            <span class="remove-existing" data-type="photo">&times;</span>
                            <input type="hidden" name="blocks[{{ $i }}][old_photos][]" value="{{ $photo }}">
                        </div>
                        @endforeach
                    </div>

                    {{-- Video --}}
                    <label class="block font-semibold mt-3 mb-1">Video</label>
                    <input type="file" name="blocks[{{ $i }}][videos][]" multiple class="w-full border rounded p-2">
                    <div class="gallery mt-2">
                        @foreach($block['videos'] ?? [] as $video)
                            <video src="{{ Storage::url($video) }}" controls class="mb-2"></video>
                            <input type="hidden" name="blocks[{{ $i }}][old_videos][]" value="{{ $video }}">
                        @endforeach
                    </div>

                    {{-- File --}}
                    <label class="block font-semibold mt-3 mb-1">File</label>
                    <input type="file" name="blocks[{{ $i }}][files][]" multiple class="w-full border rounded p-2">
                    <div class="mt-2">
                        @foreach($block['files'] ?? [] as $file)
                            <a href="{{ Storage::url($file) }}" class="download-btn" download>{{ basename($file) }}</a>
                            <input type="hidden" name="blocks[{{ $i }}][old_files][]" value="{{ $file }}">
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <button type="button" id="add-block" class="bg-green-600 text-white px-4 py-2 rounded mb-4">Tambah Blok</button>

        <div class="mt-6">
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

document.addEventListener('DOMContentLoaded', () => {
    const blocksContainer = document.getElementById('blocks-container');

    function initQuill(index){
        const editorEl = document.getElementById(`editor-text-${index}`);
        const textareaEl = document.getElementById(`text-${index}`);
        const quill = new Quill(editorEl, { theme: 'snow', modules: { toolbar: toolbarOptions } });
        quill.root.innerHTML = textareaEl.value;
        quill.on('text-change', () => textareaEl.value = quill.root.innerHTML);
        editorEl.__quill = quill; // simpan referensi
    }

    // Inisialisasi semua blok yang sudah ada
    document.querySelectorAll('[id^="editor-text-"]').forEach((editor, idx) => initQuill(idx));

    // Collapse/expand blok
    blocksContainer.addEventListener('click', (e) => {
        const header = e.target.closest('.card-header');
        if (!header) return;
        const arrow = header.querySelector('.arrow');
        const body = header.nextElementSibling;
        body.classList.toggle('collapsed');
        arrow.classList.toggle('down');
    });

    // Tambah blok baru
    let blockIndex = blocksContainer.children.length;
    document.getElementById('add-block').addEventListener('click', () => {
        const html = `
        <div class="card" data-index="${blockIndex}">
            <div class="card-header">
                <h3><span class="arrow">&#9654;</span> Blok Konten #${blockIndex + 1}</h3>
                <button type="button" class="text-red-600 remove-block">Hapus</button>
            </div>
            <div class="card-body">
                <label class="block font-semibold mb-1">Judul</label>
                <input type="text" name="blocks[${blockIndex}][title]" class="w-full border rounded p-2 mb-3" required>
                <label class="block font-semibold mb-1">Konten</label>
                <div id="editor-text-${blockIndex}" class="ql-editor mb-2"></div>
                <textarea name="blocks[${blockIndex}][text]" id="text-${blockIndex}" class="hidden"></textarea>
                <label class="block font-semibold mt-3 mb-1">Foto</label>
                <input type="file" name="blocks[${blockIndex}][photos][]" multiple class="w-full border rounded p-2">
                <label class="block font-semibold mt-3 mb-1">Video</label>
                <input type="file" name="blocks[${blockIndex}][videos][]" multiple class="w-full border rounded p-2">
                <label class="block font-semibold mt-3 mb-1">File</label>
                <input type="file" name="blocks[${blockIndex}][files][]" multiple class="w-full border rounded p-2">
            </div>
        </div>`;
        blocksContainer.insertAdjacentHTML('beforeend', html);
        initQuill(blockIndex);
        blockIndex++;
    });

    // Hapus blok
    blocksContainer.addEventListener('click', (e) => {
        if(e.target.classList.contains('remove-block')){
            e.target.closest('.card').remove();
        }
        if(e.target.classList.contains('remove-existing')){
            const wrapper = e.target.closest('.img-wrapper');
            wrapper.remove();
        }
    });

    // Submit form: update Quill ke textarea
    document.getElementById('ikmEditForm').addEventListener('submit', () => {
        document.querySelectorAll('[id^="editor-text-"]').forEach(editorEl => {
            const textareaEl = document.getElementById(editorEl.id.replace('editor-text-', 'text-'));
            if(editorEl && textareaEl) textareaEl.value = editorEl.__quill.root.innerHTML;
        });
    });
});
</script>
@endsection
