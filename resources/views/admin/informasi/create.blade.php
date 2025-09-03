@extends('layouts.admin')

@section('title', 'Tambah Informasi')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Tambah Informasi</h2>

    <form id="informasiForm" action="{{ route('admin.informasi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Judul --}}
        <div class="mb-4">
            <label for="judul" class="block font-semibold">Judul</label>
            <input type="text" name="judul" id="judul" value="{{ old('judul') }}"
                class="w-full border rounded p-2 @error('judul') border-red-500 @enderror" required>
            @error('judul')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Pilih Kategori --}}
        <div class="mb-4">
            <label for="kategori_id" class="block font-semibold">Kategori</label>
            <select name="kategori_id" id="kategori_id"
                class="w-full border rounded p-2 @error('kategori_id') border-red-500 @enderror" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
            @error('kategori_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Status --}}
        <div class="mb-4">
            <label for="status" class="block font-semibold">Status</label>
            <select name="status" id="status"
                class="w-full border rounded p-2 @error('status') border-red-500 @enderror" required>
                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="publish" {{ old('status') == 'publish' ? 'selected' : '' }}>Publish</option>
            </select>
            @error('status')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

       {{-- Tanggal Publish --}}
<div class="mb-4">
    <label for="tanggal_publish" class="block font-semibold">Tanggal Publish</label>
    <input type="date" name="tanggal_publish" id="tanggal_publish"
        value="{{ old('tanggal_publish', date('Y-m-d')) }}"
        class="w-full border rounded p-2 @error('tanggal_publish') border-red-500 @enderror">
    @error('tanggal_publish')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>


        {{-- Upload Gambar (di atas isi) --}}
        <div class="mb-4">
            <label for="gambar" class="block font-semibold">Upload Gambar</label>
            <input type="file" name="gambar[]" id="gambar" multiple accept="image/*,.ico"
                class="w-full border rounded p-2 @error('gambar.*') border-red-500 @enderror">
            <div id="preview-gambar" class="gallery mt-2 flex flex-wrap gap-2"></div>
            @error('gambar.*')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Isi Konten --}}
        <div class="mb-4">
            <label class="block font-semibold mb-2">Isi Informasi</label>
            <div id="editor-isi" class="ql-editor">{!! old('isi','') !!}</div>
            <textarea name="isi" id="isi" class="hidden">{{ old('isi','') }}</textarea>
            @error('isi')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tombol --}}
        <div class="mt-6">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Simpan</button>
            <a href="{{ route('admin.informasi.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600 ml-2">Batal</a>
        </div>
    </form>
</div>
@endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css" rel="stylesheet">
<style>
    .ql-editor { min-height: 250px; background: #fff; border: 1px solid #ccc; border-radius: 4px; }
    .gallery img { width: 100px; height: 100px; object-fit: cover; border: 1px solid #e5e7eb; border-radius: 4px; }
    .img-wrapper { position: relative; display: inline-block; margin-right: 5px; margin-bottom: 5px; }
    .img-wrapper span { position: absolute; top: -6px; right: -6px; background: #dc2626; color: white; font-size: 14px; border-radius: 50%; width: 20px; height: 20px; line-height: 18px; text-align: center; cursor: pointer; }
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

document.addEventListener('DOMContentLoaded', () => {
    // Quill editor
    const quill = new Quill('#editor-isi', { theme: 'snow', modules: { toolbar: toolbarOptions } });
    const textarea = document.getElementById('isi');
    quill.root.innerHTML = textarea.value;
    quill.on('text-change', () => textarea.value = quill.root.innerHTML);

    // Multiple image preview
    const input = document.getElementById('gambar');
    const preview = document.getElementById('preview-gambar');

    input.addEventListener('change', e => {
        preview.innerHTML = ''; // hapus preview lama
        Array.from(input.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = ev => {
                const wrapper = document.createElement('div');
                wrapper.className = 'img-wrapper';
                const img = document.createElement('img');
                img.src = ev.target.result;
                const btn = document.createElement('span');
                btn.innerHTML = '×';
                btn.onclick = () => wrapper.remove();
                wrapper.appendChild(img);
                wrapper.appendChild(btn);
                preview.appendChild(wrapper);
            };
            reader.readAsDataURL(file);
        });
    });
});
</script>
@endsection
