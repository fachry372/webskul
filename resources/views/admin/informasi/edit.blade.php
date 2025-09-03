@extends('layouts.admin')

@section('title', 'Edit Informasi')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css" rel="stylesheet">
<style>
    .ql-editor { min-height: 250px; background: #fff; border: 1px solid #ccc; border-radius: 4px; }
    .gallery { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 8px; }
    .img-wrapper { position: relative; display: inline-block; margin-right: 5px; margin-bottom: 5px; }
    .img-wrapper img { width: 100px; height: 100px; object-fit: cover; border: 1px solid #e5e7eb; border-radius: 4px; }
    .img-wrapper span { position: absolute; top: -6px; right: -6px; background: #dc2626; color: white; font-size: 14px; border-radius: 50%; width: 20px; height: 20px; line-height: 18px; text-align: center; cursor: pointer; }
</style>
@endsection

@section('content')
<div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Edit Informasi</h2>

    <form action="{{ route('admin.informasi.update', $informasi->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Judul --}}
        <div class="mb-4">
            <label class="block font-semibold">Judul</label>
            <input type="text" name="judul" value="{{ old('judul', $informasi->judul) }}"
                class="w-full border rounded p-2 @error('judul') border-red-500 @enderror" required>
            @error('judul') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Kategori --}}
        <div class="mb-4">
            <label class="block font-semibold">Kategori</label>
            <select name="kategori_id" class="w-full border rounded p-2 @error('kategori_id') border-red-500 @enderror" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ old('kategori_id', $informasi->kategori_id)==$kategori->id ? 'selected':'' }}>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
            @error('kategori_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Status --}}
        <div class="mb-4">
            <label class="block font-semibold">Status</label>
            <select name="status" class="w-full border rounded p-2 @error('status') border-red-500 @enderror" required>
                <option value="draft" {{ old('status', $informasi->status)=='draft' ? 'selected':'' }}>Draft</option>
                <option value="publish" {{ old('status', $informasi->status)=='publish' ? 'selected':'' }}>Publish</option>
            </select>
            @error('status') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Tanggal Publish --}}
        <div class="mb-4">
            <label class="block font-semibold">Tanggal Publish</label>
            <input type="date" name="tanggal_publish"
                value="{{ old('tanggal_publish', $informasi->tanggal_publish? $informasi->tanggal_publish->format('Y-m-d') : now()->format('Y-m-d')) }}"
                class="w-full border rounded p-2 @error('tanggal_publish') border-red-500 @enderror">
            @error('tanggal_publish') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Upload & Preview Gambar --}}
        <div class="mb-4">
            <label class="block font-semibold">Gambar</label>
            <input type="file" id="gambar" name="gambar[]" multiple accept="image/*" class="w-full border rounded p-2 @error('gambar.*') border-red-500 @enderror">

            <div id="preview-gambar" class="gallery">
                {{-- Gambar lama --}}
                @foreach($informasi->gambar as $img)
                    <div class="img-wrapper old" data-id="{{ $img->id }}">
                        <img src="{{ asset('storage/'.$img->nama_file) }}">
                        <span class="remove-old">×</span>
                    </div>
                @endforeach
            </div>

            <input type="hidden" name="delete_gambar" id="delete-gambar">
            @error('gambar.*') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Isi Konten --}}
        <div class="mb-4">
            <label class="block font-semibold mb-2">Isi Informasi</label>
            <div id="editor-isi" class="ql-editor">{!! old('isi', $informasi->isi) !!}</div>
            <textarea name="isi" id="isi" class="hidden">{{ old('isi', $informasi->isi) }}</textarea>
            @error('isi') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Tombol --}}
        <div class="mt-6">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Update</button>
            <a href="{{ route('admin.informasi.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600 ml-2">Batal</a>
        </div>
    </form>
</div>
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

    // Preview gambar lama & baru
    const input = document.getElementById('gambar');
    const preview = document.getElementById('preview-gambar');
    const deleteInput = document.getElementById('delete-gambar');

    // Hapus gambar lama
    preview.addEventListener('click', e => {
        if(e.target.classList.contains('remove-old')){
            const wrapper = e.target.closest('.img-wrapper');
            const oldId = wrapper.dataset.id;
            let current = deleteInput.value ? deleteInput.value.split(',') : [];
            if(!current.includes(oldId)) current.push(oldId);
            deleteInput.value = current.join(',');
            wrapper.remove();
        }
    });

    // Preview gambar baru
    input.addEventListener('change', () => {
        // Hapus preview lama file baru
        preview.querySelectorAll('.new').forEach(el => el.remove());

        Array.from(input.files).forEach((file, idx) => {
            const reader = new FileReader();
            reader.onload = e => {
                const wrapper = document.createElement('div');
                wrapper.className = 'img-wrapper new';
                wrapper.style.position = 'relative';

                const img = document.createElement('img');
                img.src = e.target.result;

                const btn = document.createElement('span');
                btn.innerHTML = '×';
                btn.onclick = () => {
                    wrapper.remove();
                    // hapus file dari input
                    const dt = new DataTransfer();
                    Array.from(input.files).forEach((f, i) => { if(i !== idx) dt.items.add(f); });
                    input.files = dt.files;
                };

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
