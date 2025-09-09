@extends('layouts.admin')

@section('title', 'Tambah Galeri')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css" rel="stylesheet">
<style>
.card { border: 1px solid #ccc; border-radius: 6px; margin-bottom: 1rem; padding: 1rem; }
.card-header { background: #f3f4f6; padding: 0.5rem 1rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center; }
.card-header:hover { background: #e5e7eb; }
.ql-editor { min-height: 150px; background: #fff; border: 1px solid #ccc; border-radius: 4px; }
.gallery img, .gallery video { width: 120px; height: 120px; object-fit: cover; border-radius: 4px; margin-right: 0.5rem; margin-bottom: 0.5rem; }
.img-wrapper { position: relative; display: inline-block; margin-right:0.5rem; margin-bottom:0.5rem; }
.img-wrapper span { position: absolute; top: -6px; right: -6px; background: #dc2626; color: white; font-size: 16px; border-radius: 50%; width: 24px; height: 24px; line-height: 22px; text-align: center; cursor: pointer; font-weight: bold; }
.toggle-block { display: inline-block; transition: transform 0.3s ease; }
.card-body { overflow: hidden; transition: max-height 0.3s ease, padding 0.3s ease; }
.card-body.closed { max-height: 0; padding-top: 0; padding-bottom: 0; }
.card-body.open { max-height: 2000px; padding-top: 1rem; padding-bottom: 1rem; }
.link-input { display: flex; align-items: center; margin-bottom: 0.5rem; }
.link-input input { flex: 1; border: 1px solid #ccc; border-radius: 4px; padding: 0.25rem 0.5rem; margin-right: 0.5rem; }
.link-input button { background: #dc2626; color: #fff; border: none; border-radius: 4px; padding: 0.25rem 0.5rem; cursor: pointer; }
</style>
@endsection

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Tambah Galeri</h2>

    @if(session('success'))
        <p class="text-green-600 mb-4">{{ session('success') }}</p>
    @endif

    {{-- Cek apakah bisa buat galeri baru --}}
    @if(!$canCreateNew)
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4" role="alert">
            <p>Galeri sudah ada. Anda harus menghapus galeri lama terlebih dahulu sebelum membuat galeri baru.</p>
        </div>
    @endif

    <form id="galeriCreateForm" action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data" @if(!$canCreateNew) style="display:none;" @endif>
        @csrf

        {{-- Judul Galeri --}}
        <div class="mb-4">
            <label class="block font-semibold">Judul Galeri</label>
            <input type="text" name="judul" id="judul"
                   class="w-full border rounded p-2 @error('judul') border-red-500 @enderror"
                   value="{{ old('judul') }}" required>
            @error('judul')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Container blok --}}
        <div id="blocks-container"></div>
        <button type="button" id="add-block"
                class="bg-green-600 text-white px-4 py-2 rounded mb-4"
                @if(!$canCreateNew) disabled @endif>
            Tambah Blok
        </button>

        {{-- Simpan + Kembali sejajar --}}
        <div class="flex gap-2">
            <button type="submit" id="btnSubmit"
                    class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700"
                    @if(!$canCreateNew) disabled @endif>
                Simpan
            </button>
            <a href="{{ route('admin.galeri.index') }}"
               class="inline-block bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">
                Kembali
            </a>
        </div>
    </form>

    {{-- Kalau tidak bisa buat galeri baru, hanya tampil tombol kembali --}}
    @if(!$canCreateNew)
        <div class="mt-4">
            <a href="{{ route('admin.galeri.index') }}"
               class="inline-block bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">
                Kembali
            </a>
        </div>
    @endif

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

let blockIndex = 0;
const uploadedFiles = {};

function updateBlockNumbers(){
    document.querySelectorAll('#blocks-container .card').forEach((card,i)=>{
        card.querySelector('.card-header h3').textContent = `Blok Konten #${i+1}`;
    });
}

function handlePreview(input, previewContainerId, type='image', blockIdx) {
    const previewContainer = document.getElementById(previewContainerId);
    if(!uploadedFiles[blockIdx]) uploadedFiles[blockIdx] = { photos: [], videos: [], files: [] };

    input.addEventListener('change', (e) => {
        const newFiles = Array.from(e.target.files);
        newFiles.forEach((file) => {
            const wrapper = document.createElement('div');
            wrapper.className = 'img-wrapper';

            let media;
            if(type==='image'){
                media = document.createElement('img'); media.src = URL.createObjectURL(file);
            } else if(type==='video'){
                media = document.createElement('video'); media.src = URL.createObjectURL(file); media.controls = true;
            } else {
                media = document.createElement('span'); media.textContent = file.name;
                media.style.padding='4px 8px';
                media.style.background='#7f8caa';
                media.style.color='#fff';
                media.style.borderRadius='4px';
                media.style.display='inline-block';
            }

            const removeBtn = document.createElement('span');
            removeBtn.innerHTML='&times;';
            removeBtn.addEventListener('click', ()=>{
                wrapper.remove();
                uploadedFiles[blockIdx][type+'s'] = uploadedFiles[blockIdx][type+'s'].filter(f => f !== file);
                updateInputFiles(input, uploadedFiles[blockIdx][type+'s']);
            });

            wrapper.appendChild(media);
            wrapper.appendChild(removeBtn);
            previewContainer.appendChild(wrapper);

            uploadedFiles[blockIdx][type+'s'].push(file);
            updateInputFiles(input, uploadedFiles[blockIdx][type+'s']);
        });
    });
}

function updateInputFiles(input, filesArray){
    const dt = new DataTransfer();
    filesArray.forEach(f=> dt.items.add(f));
    input.files = dt.files;
}

function createBlock(index){
    const container=document.getElementById('blocks-container');
    const html=`<div class="card" data-index="${index}">
        <div class="card-header">
            <h3>Blok Konten #${index+1}</h3>
            <div>
                <span class="toggle-block mr-2">&#9660;</span>
                <button type="button" class="text-red-600 remove-block">Hapus</button>
            </div>
        </div>
        <div class="card-body open">
            <label class="block font-semibold mb-1">Judul Block</label>
            <input type="text" name="blocks[${index}][title]" class="w-full border rounded p-2 mb-3">

            <label class="block font-semibold mb-1">Konten</label>
            <div id="editor-text-${index}" class="ql-editor mb-2"></div>
            <textarea name="blocks[${index}][text]" id="text-${index}" class="hidden"></textarea>

            <label class="block font-semibold mt-3 mb-1">Foto</label>
            <input type="file" name="blocks[${index}][photos][]" multiple accept="image/*" class="mb-2">
            <div id="preview-photos-${index}" class="gallery mb-3"></div>

            <label class="block font-semibold mt-3 mb-1">Video</label>
            <input type="file" name="blocks[${index}][videos][]" multiple accept="video/*" class="mb-2">
            <div id="preview-videos-${index}" class="gallery mb-3"></div>

            <label class="block font-semibold mt-3 mb-1">File Lain</label>
            <input type="file" name="blocks[${index}][files][]" multiple class="mb-2">
            <div id="preview-files-${index}" class="gallery mb-3"></div>

            <label class="block font-semibold mt-3 mb-1">Link Video</label>
            <div id="links-container-${index}" class="mb-2"></div>
            <button type="button" class="add-link bg-gray-200 px-3 py-1 rounded">Tambah Link</button>
        </div>
    </div>`;

    container.insertAdjacentHTML('beforeend', html);

    const card=container.querySelector(`.card[data-index="${index}"]`);
    const body=card.querySelector('.card-body');
    const toggle=card.querySelector('.toggle-block');

    new Quill(`#editor-text-${index}`, { theme:'snow', modules:{toolbar:toolbarOptions} });

    toggle.addEventListener('click', ()=>{
        const isOpen=body.classList.contains('open');
        if(isOpen){
            body.classList.remove('open'); body.classList.add('closed'); toggle.innerHTML='&#9654;';
        }else{
            body.classList.remove('closed'); body.classList.add('open'); toggle.innerHTML='&#9660;';
        }
    });

    // Link Video
    const linksContainer=document.getElementById(`links-container-${index}`);
    function addLinkInput(){
        const div=document.createElement('div'); div.className='link-input';
        div.innerHTML=`<input type="url" name="blocks[${index}][videos_link][]" placeholder="https://example.com">
                         <button type="button">✖</button>`;
        div.querySelector('button').addEventListener('click', ()=>div.remove());
        linksContainer.appendChild(div);
    }
    addLinkInput();
    card.querySelector('.add-link').addEventListener('click', addLinkInput);

    // Preview media
    handlePreview(card.querySelector(`input[name="blocks[${index}][photos][]"]`), `preview-photos-${index}`, 'image', index);
    handlePreview(card.querySelector(`input[name="blocks[${index}][videos][]"]`), `preview-videos-${index}`, 'video', index);
    handlePreview(card.querySelector(`input[name="blocks[${index}][files][]"]`), `preview-files-${index}`, 'file', index);

    // Hapus blok
    card.querySelector('.remove-block').addEventListener('click', ()=>{
        card.remove();
        delete uploadedFiles[index];
        updateBlockNumbers();
    });
}

document.getElementById('add-block').addEventListener('click', ()=>createBlock(blockIndex++));
document.getElementById('galeriCreateForm').addEventListener('submit', ()=>{
    document.querySelectorAll('#blocks-container .card').forEach(card=>{
        const idx=card.dataset.index;
        const textArea=document.getElementById(`text-${idx}`);
        const editor=document.getElementById(`editor-text-${idx}`);
        if(textArea && editor) textArea.value=editor.querySelector('.ql-editor').innerHTML;
    });
});

// Tambah blok awal otomatis
createBlock(blockIndex++);
</script>
@endsection
