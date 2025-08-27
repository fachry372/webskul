@extends('layouts.admin')

@section('title', 'Tambah Konten IKM')

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
            <button type="submit" id="btnSubmit"
                class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Simpan
            </button>
            <a href="{{ route('admin.ikm_konten.index') }}"
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

let blockIndex=0;

function updateBlockNumbers(){
    document.querySelectorAll('#blocks-container .card').forEach((card,i)=>{
        card.querySelector('.card-header h3').textContent = `Blok Konten #${i+1}`;
    });
}


// Fungsi preview untuk foto/video/file
function handlePreview(inputElem, previewElem, type){
    const previewContainer = document.getElementById(previewElem);

    // Simpan file lama di luar event
    let filesArr = [];

    // Fungsi update input.files
    function updateInputFiles(){
        const dt = new DataTransfer();
        filesArr.forEach(f=>dt.items.add(f));
        inputElem.files = dt.files;
    }

    // Event change untuk menambahkan file baru
    inputElem.addEventListener('change', e=>{
        const newFiles = Array.from(e.target.files);
        filesArr = filesArr.concat(newFiles); // gabungkan file lama + baru
        renderPreview();
        updateInputFiles();
    });

    // Render preview
    function renderPreview(){
        previewContainer.innerHTML = '';
        filesArr.forEach((file, idx)=>{
            const wrapper=document.createElement('div');
            wrapper.className='img-wrapper';

            if(type==='image'){
                const img=document.createElement('img'); img.src=URL.createObjectURL(file); img.alt=file.name; wrapper.appendChild(img);
            } else if(type==='video'){
                const video=document.createElement('video'); video.src=URL.createObjectURL(file); video.controls=true; wrapper.appendChild(video);
            } else if(type==='file'){
                const fileBox=document.createElement('div');
                fileBox.style.display='flex'; fileBox.style.alignItems='center';
                fileBox.style.background='#f9fafb'; fileBox.style.border='1px solid #ddd';
                fileBox.style.borderRadius='6px'; fileBox.style.padding='6px 10px'; fileBox.style.marginBottom='6px';
                fileBox.innerHTML=`📄 <span style="margin-left:8px;">${file.name}</span>`;
                wrapper.appendChild(fileBox);
            }

            const btn=document.createElement('span');
            btn.innerHTML='✖';
            btn.title='Hapus file ini';
            btn.onclick=()=>{
                filesArr.splice(idx, 1); // hapus dari array
                renderPreview();         // render ulang preview
                updateInputFiles();      // update input.files
            };

            wrapper.appendChild(btn);
            previewContainer.appendChild(wrapper);
        });
    }
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
            <label class="block font-semibold mb-1">Judul</label>
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

    // Quill editor
    new Quill(`#editor-text-${index}`, { theme:'snow', modules:{toolbar:toolbarOptions} });

    // Toggle fungsi
    toggle.addEventListener('click', ()=>{
        const isOpen=body.classList.contains('open');
        if(isOpen){
            body.classList.remove('open'); body.classList.add('closed'); toggle.innerHTML='&#9654;';
        }else{
            body.classList.remove('closed'); body.classList.add('open'); toggle.innerHTML='&#9660;';
        }
    });

    // Preview media: foto, video, file
    ['photos','videos','files'].forEach(type=>{
        const inputElem = card.querySelector(`input[name="blocks[${index}][${type}][]"]`);
        const previewElem = `preview-${type}-${index}`;
        const previewContainer = document.getElementById(previewElem);

        let filesArr = []; // array persisten untuk input ini

        function renderPreview(){
            previewContainer.innerHTML='';
            filesArr.forEach((file, idx)=>{
                const wrapper=document.createElement('div');
                wrapper.className='img-wrapper';

                if(type==='photos'){
                    const img=document.createElement('img'); img.src=URL.createObjectURL(file); img.alt=file.name; wrapper.appendChild(img);
                } else if(type==='videos'){
                    const video=document.createElement('video'); video.src=URL.createObjectURL(file); video.controls=true; wrapper.appendChild(video);
                } else if(type==='files'){
                    const fileBox=document.createElement('div');
                    fileBox.style.display='flex'; fileBox.style.alignItems='center';
                    fileBox.style.background='#f9fafb'; fileBox.style.border='1px solid #ddd';
                    fileBox.style.borderRadius='6px'; fileBox.style.padding='6px 10px'; fileBox.style.marginBottom='6px';
                    fileBox.innerHTML=`📄 <span style="margin-left:8px;">${file.name}</span>`;
                    wrapper.appendChild(fileBox);
                }

                const btn=document.createElement('span'); btn.innerHTML='✖'; btn.title='Hapus file ini';
                btn.onclick=()=>{
                    filesArr.splice(idx,1); // hapus file dari array
                    renderPreview();        // render ulang preview
                    updateInputFiles();     // sinkron input.files
                };
                wrapper.appendChild(btn);
                previewContainer.appendChild(wrapper);
            });
        }

        function updateInputFiles(){
            const dt = new DataTransfer();
            filesArr.forEach(f=>dt.items.add(f));
            inputElem.files = dt.files;
        }

        inputElem.addEventListener('change', e=>{
            const newFiles = Array.from(e.target.files);
            filesArr = filesArr.concat(newFiles); // gabungkan file lama + baru
            renderPreview();
            updateInputFiles();
        });
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

    // Hapus blok
    card.querySelector('.remove-block').addEventListener('click', ()=>{ card.remove(); updateBlockNumbers(); });
}




// Tambah blok baru
document.getElementById('add-block').addEventListener('click', ()=>createBlock(blockIndex++));

// Sync Quill ke textarea saat submit
document.getElementById('ikmCreateForm').addEventListener('submit', ()=>{
    document.querySelectorAll('#blocks-container .card').forEach(card=>{
        const idx=card.dataset.index;
        const textArea=document.getElementById(`text-${idx}`);
        const editor=document.getElementById(`editor-text-${idx}`);
        if(textArea && editor) textArea.value=editor.querySelector('.ql-editor').innerHTML;
    });
});

// Tambah satu blok awal otomatis
createBlock(blockIndex++);

// Disable tombol submit setelah diklik
document.getElementById('ikmCreateForm').addEventListener('submit', function () {
    const btn = document.getElementById('btnSubmit');
    btn.disabled = true;
    btn.innerText = 'Menyimpan...'; // optional biar user tahu lagi proses simpan
});

</script>
@endsection
