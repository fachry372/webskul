@props(['id', 'content'])

<div x-data="tiptapEditor('{{ $id }}', '{!! addslashes($content ?? '') !!}')" x-init="init($refs.editor)" wire:ignore>
    <div class="flex w-full border-b divide-x divide-gray-300 bg-gray-50 p-2 flex-wrap gap-2">
        <button type="button" class="p-2 hover:bg-gray-200 rounded" @click="toggleBold()" x-bind:class="{ 'bg-gray-200': isActive('bold') }" title="Bold">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-6 0h6a3 3 0 003-3v-6a3 3 0 00-3-3h-6a3 3 0 00-3 3v6a3 3 0 003 3z" />
            </svg>
        </button>
        <button type="button" class="p-2 hover:bg-gray-200 rounded" @click="toggleItalic()" x-bind:class="{ 'bg-gray-200': isActive('italic') }" title="Italic">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m4-14H8" />
            </svg>
        </button>
        <button type="button" class="p-2 hover:bg-gray-200 rounded" @click="toggleHeading(2)" x-bind:class="{ 'bg-gray-200': isActive('heading', { level: 2 }) }" title="Heading 2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21h18M3 10h18M3 14h18M3 3v18M9 3v18M15 3v18" />
            </svg>
        </button>
        <button type="button" class="p-2 hover:bg-gray-200 rounded" @click="setTextAlign('left')" x-bind:class="{ 'bg-gray-200': isActive('textAlign', { textAlign: 'left' }) }" title="Align Left">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h18M3 10h14M3 15h18M3 20h14" />
            </svg>
        </button>
        <button type="button" class="p-2 hover:bg-gray-200 rounded" @click="setTextAlign('center')" x-bind:class="{ 'bg-gray-200': isActive('textAlign', { textAlign: 'center' }) }" title="Align Center">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h18M5 10h14M3 15h18M5 20h14" />
            </svg>
        </button>
        <button type="button" class="p-2 hover:bg-gray-200 rounded" @click="setTextAlign('right')" x-bind:class="{ 'bg-gray-200': isActive('textAlign', { textAlign: 'right' }) }" title="Align Right">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h18M7 10h14M3 15h18M7 20h14" />
            </svg>
        </button>
        <button type="button" class="p-2 hover:bg-gray-200 rounded" @click="insertImage()" title="Insert Image">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4-4 4 4 4-4 4 4m-16 0v4h16v-4m-12-8h8m-4 4h.01" />
            </svg>
        </button>
    </div>
    <div x-ref="editor" class="border border-gray-300 rounded-b-md p-4 prose max-w-none"></div>
    <textarea name="{{ $id }}" id="{{ $id }}" style="display: none;">{!! $content ?? '' !!}</textarea>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('tiptapEditor', (id, content) => ({
            editor: null,
            init(element) {
                this.editor = new window.Editor({
                    element: element,
                    extensions: [
                        window.StarterKit,
                        window.Image.configure({
                            inline: true,
                            allowBase64: false,
                        }),
                        window.TextAlign.configure({
                            types: ['heading', 'paragraph', 'image'],
                            alignments: ['left', 'center', 'right'],
                            defaultAlignment: 'left',
                        }),
                        window.Link,
                    ],
                    content: content,
                    onUpdate: ({ editor }) => {
                        document.querySelector(`#${id}`).value = editor.getHTML();
                    },
                });
            },
            toggleBold() {
                this.editor.chain().focus().toggleBold().run();
            },
            toggleItalic() {
                this.editor.chain().focus().toggleItalic().run();
            },
            toggleHeading(level) {
                this.editor.chain().focus().toggleHeading({ level: level }).run();
            },
            setTextAlign(align) {
                this.editor.chain().focus().setTextAlign(align).run();
            },
            isActive(type, attributes = {}) {
                return this.editor.isActive(type, attributes);
            },
            insertImage() {
                const input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.click();
                input.onchange = async () => {
                    const file = input.files[0];
                    if (file) {
                        console.log('Uploading image:', file.name);
                        const formData = new FormData();
                        formData.append('image', file);
                        formData.append('_token', '{{ csrf_token() }}');
                        try {
                            const response = await fetch('{{ route("admin.posts.upload") }}', {
                                method: 'POST',
                                body: formData
                            });
                            const data = await response.json();
                            console.log('Upload success:', data);
                            if (data.success) {
                                this.editor.chain().focus().setImage({ src: data.url }).run();
                            } else {
                                alert('Gagal mengunggah gambar: ' + data.error);
                            }
                        } catch (error) {
                            console.error('Upload error:', error);
                            alert('Gagal mengunggah gambar: ' + error);
                        }
                    }
                };
            },
        }));
    });
</script>
