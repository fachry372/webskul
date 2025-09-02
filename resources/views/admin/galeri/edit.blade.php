@extends('layouts.admin')

@section('title', 'Edit Galeri')

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
    <h2 class="text-2xl font-bold mb-4">Edit Galeri</h2>

    @if(session('success'))
        <p class="text-green-600 mb-4">{{ session('success') }}</p>
    @endif

    <form id="galeriEditForm" action="{{ route('admin.galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="judul" class="block font-semibold">Judul Galeri</label>
            <input type="text" name="judul" id="judul"
                   class="w-full border rounded p-2 @error('judul') border-red-500 @enderror"
                   value="{{ old('judul', $galeri->judul) }}" required>
            @error('judul')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div id="blocks-container"></div>
        <button type="button" id="add-block" class="bg-green-600 text-white px-4 py-2 rounded mb-4">Tambah Blok</button>

        <div>
            <button type="submit" id="btnSubmit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Simpan
            </button>
            <a href="{{ route('admin.galeri.index') }}"
               class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600 ml-2">
               Batal
            </a>
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

let blockIndex = 0;

function updateBlockNumbers(){
    document.querySelectorAll('#blocks-container .card').forEach((card,i)=>{
        card.querySelector('.card-header h3').textContent = `Blok Konten #${i+1}`;
    });
}

function createBlock(index, data=null){
    const container = document.getElementById('blocks-container');
    const html = `<div class="card" data-index="${index}">
        <div class="card-header">
            <h3>Blok Konten #${index+1}</h3>
            <div>
                <span class="toggle-block mr-2">&#9660;</span>
                <button type="button" class="text-red-600 remove-block">Hapus Blok</button>
            </div>
        </div>
        <div class="card-body open">
            ${data?.id ? `<input type="hidden" name="blocks[${index}][id]" value="${data.id}">` : ''}

            <label class="block font-semibold mb-1">Judul</label>
            <input type="text" name="blocks[${index}][title]" class="w-full border rounded p-2 mb-3" value="${data?.title ?? ''}">

            <label class="block font-semibold mb-1">Konten</label>
            <div id="editor-text-${index}" class="ql-editor mb-2">${data?.text ?? ''}</div>
            <textarea name="blocks[${index}][text]" id="text-${index}" class="hidden"></textarea>

            ${['photos','videos','files'].map(type => `
                <label class="block font-semibold mt-3 mb-1">${type.charAt(0).toUpperCase() + type.slice(1)}</label>
                <input type="file" name="blocks[${index}][${type}][]" multiple ${type==='photos'?'accept="image/*"':''}${type==='videos'?'accept="video/*"':''} class="mb-2">
                <div id="preview-${type}-${index}" class="gallery mb-3"></div>
            `).join('')}

            <label class="block font-semibold mt-3 mb-1">Link Video</label>
            <div id="links-container-${index}" class="mb-2"></div>
            <button type="button" class="add-link bg-gray-200 px-3 py-1 rounded">Tambah Link</button>
        </div>
    </div>`;
    container.insertAdjacentHTML('beforeend', html);

    const card = container.querySelector(`.card[data-index="${index}"]`);
    const body = card.querySelector('.card-body');
    const toggle = card.querySelector('.toggle-block');

    // Inisialisasi Quill
    new Quill(`#editor-text-${index}`, { theme:'snow', modules:{toolbar:toolbarOptions} });

    // Toggle
    toggle.addEventListener('click', ()=>{
        const isOpen = body.classList.contains('open');
        body.classList.toggle('open', !isOpen);
        body.classList.toggle('closed', isOpen);
        toggle.innerHTML = isOpen ? '&#9654;' : '&#9660;';
    });

    // Hapus blok
    card.querySelector('.remove-block').addEventListener('click', ()=>{
        if(data?.id){
            card.style.display='none';
            const delInput = document.createElement('input');
            delInput.type='hidden';
            delInput.name = `blocks[${index}][_delete]`;
            delInput.value='1';
            card.appendChild(delInput);
        } else {
            card.remove();
        }
        updateBlockNumbers();
    });

    // File handling
    ['photos','videos','files'].forEach(type=>{
        const inputElem = card.querySelector(`input[name="blocks[${index}][${type}][]"]`);
        const previewElem = document.getElementById(`preview-${type}-${index}`);
        let filesArr = []; // hanya file baru

        // Render file lama
        if(data && data[type]){
            let arr;
            try { arr = Array.isArray(data[type]) ? data[type] : JSON.parse(data[type]); }
            catch(e){ arr = []; }

            arr.forEach(f=>{
                const wrapper = document.createElement('div');
                wrapper.className='img-wrapper old-file';
                wrapper.style.position='relative';

                if(type==='photos'){
                    const img = document.createElement('img'); img.src=`/storage/${f}`; wrapper.appendChild(img);
                } else if(type==='videos'){
                    const video = document.createElement('video'); video.src=`/storage/${f}`; video.controls=true; wrapper.appendChild(video);
                } else {
                    const fileBox = document.createElement('div');
                    fileBox.style.cssText='display:flex;align-items:center;background:#f9fafb;border:1px solid #ddd;border-radius:6px;padding:6px 10px;margin-bottom:6px;';
                    fileBox.innerHTML=`📄 <span style="margin-left:8px;">${f.split('/').pop()}</span>`;
                    wrapper.appendChild(fileBox);
                }

                // Tombol hapus file lama
                const btn = document.createElement('span');
                btn.innerHTML='✖';
                btn.title='Hapus file ini';
                btn.style.cssText='position:absolute;top:-6px;right:-6px;background:#dc2626;color:#fff;width:24px;height:24px;display:flex;align-items:center;justify-content:center;border-radius:50%;cursor:pointer;';
                btn.onclick=()=>{
                    const delInput = document.createElement('input');
                    delInput.type='hidden';
                    delInput.name = `blocks[${index}][_delete_files][]`;
                    delInput.value=f;
                    card.appendChild(delInput);
                    wrapper.remove();
                };
                wrapper.appendChild(btn);

                previewElem.appendChild(wrapper);
            });
        }

        // Render file baru
        function renderPreview(){
            previewElem.querySelectorAll('.new-file').forEach(el=>el.remove());
            filesArr.forEach((file, idx)=>{
                const wrapper = document.createElement('div');
                wrapper.className='img-wrapper new-file'; wrapper.style.position='relative';

                if(type==='photos'){
                    const img = document.createElement('img'); img.src=URL.createObjectURL(file); img.alt=file.name; wrapper.appendChild(img);
                } else if(type==='videos'){
                    const video = document.createElement('video'); video.src=URL.createObjectURL(file); video.controls=true; wrapper.appendChild(video);
                } else {
                    const fileBox = document.createElement('div');
                    fileBox.style.cssText='display:flex;align-items:center;background:#f9fafb;border:1px solid #ddd;border-radius:6px;padding:6px 10px;margin-bottom:6px;';
                    fileBox.innerHTML=`📄 <span style="margin-left:8px;">${file.name}</span>`; wrapper.appendChild(fileBox);
                }

                const btn = document.createElement('span');
                btn.innerHTML='✖';
                btn.title='Hapus file ini';
                btn.style.cssText='position:absolute;top:-6px;right:-6px;background:#dc2626;color:#fff;width:24px;height:24px;display:flex;align-items:center;justify-content:center;border-radius:50%;cursor:pointer;';
                btn.onclick=()=>{ filesArr.splice(idx,1); renderPreview(); updateInputFiles(); };
                wrapper.appendChild(btn);

                previewElem.appendChild(wrapper);
            });
        }

        function updateInputFiles(){
            const dt = new DataTransfer();
            filesArr.forEach(f=>dt.items.add(f));
            inputElem.files = dt.files;
        }

        inputElem.addEventListener('change', e=>{
            filesArr = filesArr.concat(Array.from(e.target.files));
            renderPreview();
            updateInputFiles();
        });
    });

    // Link video
    const linksContainer = document.getElementById(`links-container-${index}`);
    function addLinkInput(val=''){
        const div = document.createElement('div'); div.className='link-input'; div.style.position='relative';
        div.innerHTML=`<input type="url" name="blocks[${index}][videos_link][]" placeholder="https://example.com" value="${val}"><button type="button" style="position:absolute;top:0;right:0;">✖</button>`;
        div.querySelector('button').addEventListener('click', ()=>div.remove());
        linksContainer.appendChild(div);
    }

    if(data && data.videos_link){
        let arr;
        try { arr = Array.isArray(data.videos_link) ? data.videos_link : JSON.parse(data.videos_link); }
        catch(e){ arr=[]; }
        if(arr.length) arr.forEach(link=>addLinkInput(link ?? ''));
        else addLinkInput('');
    } else { addLinkInput(''); }

    card.querySelector('.add-link').addEventListener('click', ()=>addLinkInput(''));
}


// Render blok lama
@foreach($galeri->blocks as $b)
createBlock(blockIndex++, @json($b));
@endforeach

document.getElementById('add-block').addEventListener('click', ()=>createBlock(blockIndex++));

document.getElementById('galeriEditForm').addEventListener('submit', function (e) {
    // Iterasi semua blok
    document.querySelectorAll('#blocks-container .card').forEach(card => {
        const idx = card.dataset.index;

        // 1. Simpan isi Quill ke textarea
        const editor = card.querySelector(`#editor-text-${idx} .ql-editor`);
        const textArea = document.getElementById(`text-${idx}`);
        if(editor && textArea) textArea.value = editor.innerHTML;

        // 2. Tangani file lama yang dihapus
        ['photos','videos','files'].forEach(type => {
            const previewElem = document.getElementById(`preview-${type}-${idx}`);
            previewElem.querySelectorAll('.old-file').forEach(el => {
                if(el.dataset.deleted){
                    // sudah dikirim hidden input _delete_files[], cukup dihapus dari DOM
                    el.remove();
                }
            });
        });

        // 3. Tangani file baru (pastikan DataTransfer sudah diupdate)
        ['photos','videos','files'].forEach(type => {
            const inputElem = card.querySelector(`input[name="blocks[${idx}][${type}][]"]`);
            if(!inputElem.files) inputElem.value=''; // aman jika kosong
        });

        // 4. Tangani link video, kosongkan input yang kosong
        const linksContainer = document.getElementById(`links-container-${idx}`);
        linksContainer.querySelectorAll('input').forEach(input=>{
            if(!input.value) input.value='';
        });
    });

    // 5. Disable tombol submit agar tidak double click
    const btn = document.getElementById('btnSubmit');
    btn.disabled = true;
    btn.innerText = 'Menyimpan...';
});

</script>
@endsection
