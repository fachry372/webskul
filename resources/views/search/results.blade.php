@extends('layouts.visitor')

@section('title', 'Hasil Pencarian')

@section('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection

@section('content')
<section class="relative w-full h-64 bg-cover bg-center text-white flex items-center justify-center overflow-hidden"
    style="background-image: url('{{ asset('images/search-banner.jpg') }}');"
    data-aos="fade-in">
    <div class="absolute inset-0 bg-[#344966]/70 z-0"></div>
    <div class="relative z-10 text-center px-4">
        <h1 class="text-3xl md:text-4xl font-bold uppercase mb-2">Hasil Pencarian</h1>
        <p class="text-lg">Kata kunci: <span class="font-semibold">"{{ $query }}"</span></p>
    </div>
</section>

<div class="max-w-6xl mx-auto my-8 px-6 md:px-12"
     x-data="{ tab: 'all' }">

    @php
        $sections = [
            'Postingan' => $posts ?? collect(),
            'Informasi Terbaru' => $informasi ?? collect(),
            'Jurusan' => $jurusans ?? collect(),
            'Menu Lainnya' => $lainnya ?? collect(),
            'Kelulusan' => $kelulusans ?? collect(),
            'Galeri' => $galeris ?? collect(),
            'Implementasi IKM' => $ikms ?? collect(),
        ];

        // total hasil
        $totalResults = collect($sections)->flatten()->count();

        // fungsi highlight
        function highlight($text, $query) {
            return preg_replace("/(" . preg_quote($query, '/') . ")/i", "<mark class='bg-yellow-200'>$1</mark>", $text);
        }
    @endphp

    {{-- Jumlah total hasil --}}
    <div class="text-center my-6">
        @if($totalResults > 0)
            <p class="text-gray-700">
                Ditemukan <span class="font-bold text-blue-600">{{ $totalResults }}</span> hasil untuk
                "<span class="font-semibold">{{ $query }}</span>"
            </p>
        @else
            <p class="text-gray-600">Tidak ada hasil untuk "<span class="font-semibold">{{ $query }}</span>"</p>
        @endif
    </div>

    {{-- Tab kategori --}}
    <div class="flex gap-3 mb-6 flex-wrap justify-center">
        <button @click="tab = 'all'"
            class="px-3 py-1 rounded-full text-sm font-medium"
            :class="tab === 'all' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-600'">
            Semua
        </button>
        @foreach(array_keys($sections) as $cat)
            @if(($sections[$cat] ?? collect())->count())
                <button @click="tab = '{{ $cat }}'"
                    class="px-3 py-1 rounded-full text-sm font-medium"
                    :class="tab === '{{ $cat }}' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-600'">
                    {{ $cat }} ({{ $sections[$cat]->count() }})
                </button>
            @endif
        @endforeach
    </div>

    {{-- Grid hasil --}}
    @foreach($sections as $title => $items)
        @if($items->count())
            <div x-show="tab === 'all' || tab === '{{ $title }}'"
                 class="mb-10"
                 x-transition>
                <h3 class="font-bold text-xl text-gray-800 mb-4">
                    {{ $title }}
                </h3>

                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($items as $index => $item)
                        <a href="
                            @switch($title)
                                @case('Postingan') {{ $item->jurusan ? route('jurusan.show', $item->jurusan->slug) : '#' }} @break
                                @case('Informasi Terbaru') {{ route('informasi.show', $item->slug) }} @break
                                @case('Jurusan') {{ route('jurusan.show', $item->slug) }} @break
                                @case('Menu Lainnya') {{ route('lainnya.show', $item->slug) }} @break
                                @case('Kelulusan') {{ route('kelulusan.show', $item->slug) }} @break
                                @case('Galeri') {{ route('galeri.show', $item->slug) }} @break
                                @case('Implementasi IKM') {{ route('ikm.show', $item->slug) }} @break
                                @default #
                            @endswitch
                        "
                        class="block bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md hover:border-blue-400 transition p-5"
                        data-aos="fade-up" data-aos-delay="{{ $index * 80 }}">

                            {{-- Judul + highlight --}}
                            <h4 class="font-semibold text-gray-800 mb-1 line-clamp-2">
                                {!! highlight($item->title ?? $item->judul ?? $item->name ?? 'Tanpa Judul', $query) !!}
                            </h4>

                            {{-- Tanggal --}}
                            @if(!empty($item->created_at))
                                <p class="text-xs text-gray-400 mb-2">
                                    {{ $item->created_at->translatedFormat('d F Y') }}
                                </p>
                            @endif

                            {{-- Deskripsi --}}
                            @if(!empty($item->excerpt) || !empty($item->deskripsi))
                                <p class="text-sm text-gray-600 line-clamp-3 mb-3">
                                    {!! highlight($item->excerpt ?? Str::limit(strip_tags($item->deskripsi), 100), $query) !!}
                                </p>
                            @endif

                            <div class="flex justify-between items-center">
                                <span class="inline-block text-xs bg-blue-100 text-blue-600 px-2 py-0.5 rounded">
                                    {{ ucfirst($title) }}
                                </span>
                                <span class="text-blue-500 text-xs font-semibold">Baca →</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach

    {{-- State kosong --}}
    @if($totalResults === 0)
        <div class="text-center py-12" data-aos="fade-in">
            <p class="text-xl text-gray-600 font-semibold">
                Tidak ada hasil ditemukan untuk "<span class="text-red-500">{{ $query }}</span>".
            </p>
            <p class="text-gray-500 mt-2">Coba gunakan kata kunci lain yang lebih spesifik.</p>
            <a href="{{ url('/') }}"
               class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Kembali ke Beranda
            </a>
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 800, once: true });
</script>
@endsection
