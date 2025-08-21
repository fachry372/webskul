
<!-- File: resources/views/layouts/partial/header.blade.php -->
@php
    $jurusans = Cache::remember('jurusans', 60 * 60, function () {
        return App\Models\Jurusan::all();
    });
@endphp

<!-- HEADER: Desktop Only -->
<header class="bg-[#192f4a] text-white/80 text-[15px] shadow hidden md:block w-full z-[60]">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <div class="flex flex-row items-center justify-between gap-3">
            <!-- Info Kontak -->
            <div class="flex flex-nowrap items-center gap-x-4 whitespace-nowrap text-white/70 overflow-hidden text-ellipsis text-[15px]">
                <span class="flex items-center gap-2"><i class="fas fa-id-card text-[15px]"></i> NPSN: 20233680</span>
                <span class="text-white/40">|</span>
                <span class="flex items-center gap-2"><i class="fas fa-phone-alt text-[15px]"></i> 0260-411410</span>
                <span class="text-white/40">|</span>
                <span class="flex items-center gap-2"><i class="fas fa-envelope text-[15px]"></i> info@smkn1subang.sch.id</span>
                <span class="text-white/40">|</span>
                <span class="flex items-center gap-2"><i class="fas fa-map-marker-alt text-[15px]"></i> Jalan Arief Rahman Hakim No.35, Kabupaten Subang 41213</span>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex-shrink-0">
                <a href="https://drive.google.com/file/d/1N4twM4-MR6SdmQx0aj7FWWvj1LN_ZK09/view" target="_blank"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-[10px] rounded-md flex items-center gap-2 font-semibold text-[15px]">
                    <i class="fas fa-book text-[15px]"></i> Download ProfilBook
                </a>
            </div>
        </div>
    </div>
</header>

<!-- NAVBAR -->
<nav class="bg-white shadow sticky top-0 w-full z-40">
    <div class="max-w-7xl mx-auto px-4 py-2 flex items-center justify-between gap-4">
        <!-- Logo -->
        <div class="flex-shrink-0">
            <a href="{{ route('beranda') }}">
                <img src="{{ asset('logo.png') }}" alt="Logo SMK" class="h-[50px] md:h-[65px] w-auto object-contain">
            </a>
        </div>

        <!-- Search Bar: mobile (tengah) -->
        <div class="flex-grow px-2 md:hidden">
            <div class="relative text-gray-700 w-full max-w-md mx-auto">
                <input type="text" placeholder="Cari di website..."
                    class="w-full pl-10 pr-3 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 text-sm">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <i class="fas fa-search text-gray-500"></i>
                </div>
            </div>
        </div>

        <!-- Hamburger Menu: mobile only -->
        <div class="flex-shrink-0 md:hidden">
            <button id="hamburgerBtn" onclick="openMenu()" aria-label="Menu">
                <i class="fas fa-bars text-xl text-blue-900"></i>
            </button>
        </div>

        <!-- Menu Desktop -->
        <ul class="hidden md:flex flex-1 justify-center items-center gap-6 text-base font-semibold text-blue-900">
            <!-- Link tanpa dropdown -->
            <li>
                <a href="{{ route('beranda') }}"
                    class="{{ request()->routeIs('beranda') ? 'text-green-500 border-b-2 border-green-500' : 'hover:text-green-500 hover:border-b-2 hover:border-green-500' }} pb-1">Beranda</a>
            </li>

            <!-- Dropdowns -->
            @php
    $dropdowns = [
        'Profil' => [
            'Data Pokok Sekolah' => '#',
            'Visi dan Misi' => '#',
            'Struktur Organisasi' => '#',
            'Profil Kepala Sekolah' => '#',
            'Program Unggulan “CEREN”' => '#',
            'Data Siswa' => '#',
            'Roadmap' => '#',
            'Denah' => '#',
            'Sarana, Prasarana Kegiatan Produktif Siswa' => '#',
            'Ekstrakurikuler' => '#',
            'Prestasi Sekolah' => '#',
        ],
        // Ganti baris ini dengan variabel yang dikirim dari controller
        'Kompetensi Keahlian' => $kompetensiKeahlian,
        'Implementasi IKM' => [
            'Implementasi P5' => '#',
            'Modul Ajar' => '#',
            'KSP' => '#',
            'Vidio Pembelajaran' => '#',
        ],
    ];
@endphp
            @foreach ($dropdowns as $title => $items)
                <li class="relative group">
                    <a href="#" onclick="event.preventDefault();"
                        class="pb-1 hover:text-green-500 hover:border-b-2 hover:border-green-500">
                        {{ $title }}
                    </a>
                    <ul class="absolute left-0 top-full bg-white shadow-md rounded-md w-64 py-2 z-50 hidden group-hover:block">
                        @foreach ($items as $item => $url)
                            <li><a href="{{ $url }}"
                                    class="block px-4 py-2 text-sm text-gray-500 hover:text-gray-700 hover:bg-green-100">{{ $item }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach

            <!-- Galeri & Kelulusan -->
            <li><a href="#"
                    class="{{ request()->routeIs('galeri') ? 'text-green-500 border-b-2 border-green-500' : 'hover:text-green-500 hover:border-b-2 hover:border-green-500' }} pb-1">Galeri</a>
            </li>
            <li><a href="#"
                    class="{{ request()->routeIs('kelulusan') ? 'text-green-500 border-b-2 border-green-500' : 'hover:text-green-500 hover:border-b-2 hover:border-green-500' }} pb-1">Kelulusan</a>
            </li>

            <!-- Lainnya dengan Submenu -->
            <li class="relative group">
                <a href="#" onclick="event.preventDefault();"
                    class="pb-1 hover:text-green-500 hover:border-b-2 hover:border-green-500">Lainnya</a>
                <ul class="absolute left-0 top-full bg-white shadow-md rounded-md w-64 py-2 z-50 hidden group-hover:block">
                    <li><a href="#" class="block px-4 py-2 text-sm text-gray-500 hover:text-gray-700 hover:bg-green-100">BKK</a></li>
                    <li><a href="#" class="block px-4 py-2 text-sm text-gray-500 hover:text-gray-700 hover:bg-green-100">SPW</a></li>
                    <li><a href="#" class="block px-4 py-2 text-sm text-gray-500 hover:text-gray-700 hover:bg-green-100">TEFA</a></li>
                    <li><a href="#" class="block px-4 py-2 text-sm text-gray-500 hover:text-gray-700 hover:bg-green-100">SPMB</a></li>
                    <li><a href="#" class="block px-4 py-2 text-sm text-gray-500 hover:text-gray-700 hover:bg-green-100">Informasi Terbaru</a></li>
                    <li class="relative group/submenu">
                        <a href="#" class="flex items-center justify-between px-4 py-2 text-sm text-gray-500 hover:text-gray-700 hover:bg-green-100">
                            Layanan TU
                            <svg class="w-4 h-4 ml-2 text-gray-400 group-hover/submenu:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                        <ul class="absolute top-0 right-full mr-2 w-48 bg-white shadow-md rounded-md py-2 z-50 hidden group-hover/submenu:block">
                            <li><a href="#" class="block px-4 py-2 text-sm text-gray-500 hover:text-gray-700 hover:bg-green-100">Legalisir</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- Search Bar: desktop only (kanan) -->
        <div class="hidden md:block ml-auto">
            <div class="relative text-gray-700 w-full max-w-xs">
                <input type="text" placeholder="Cari di website..."
                    class="w-full pl-10 pr-3 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 text-sm">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <i class="fas fa-search text-gray-500"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- MOBILE MENU WRAPPER -->
    <div id="mobile-wrapper" class="fixed inset-0 z-50 bg-black/50 hidden">
        <!-- MAIN MENU -->
        <div id="main-menu" class="absolute right-0 w-3/4 h-full bg-[#1a1a1a] text-white transform translate-x-full transition-transform duration-300 z-10 overflow-y-auto">
            <!-- HEADER STICKY -->
            <div class="sticky top-0 bg-[#1a1a1a] z-20 p-6">
                <div class="flex items-center justify-start">
                    <button onclick="closeMenu()"><i class="fas fa-times text-xl"></i></button>
                </div>
            </div>

            <!-- MENU LIST -->
            <div class="p-6 pt-4">
                <ul class="font-semibold text-base text-white/80">
                    <li class="py-4 border-b border-white/30">
                        <a href="{{ route('beranda') }}" class="hover:text-green-400">Beranda</a>
                    </li>
                    <li class="py-4 border-b border-white/30">
                        <button onclick="openSubmenu('profil')" class="w-full text-left hover:text-green-400">
                            Profil <i class="fas fa-chevron-right float-right"></i>
                        </button>
                    </li>
                    <li class="py-4 border-b border-white/30">
                        <button onclick="openSubmenu('kompetensi')" class="w-full text-left hover:text-green-400">
                            Kompetensi Keahlian <i class="fas fa-chevron-right float-right"></i>
                        </button>
                    </li>
                    <li class="py-4 border-b border-white/30">
                        <a href="#" class="hover:text-green-400">Galeri</a>
                    </li>
                    <li class="py-4 border-b border-white/30">
                        <a href="#" class="hover:text-green-400">Kelulusan</a>
                    </li>
                    <li class="py-4 border-b border-white/30">
                        <button onclick="openSubmenu('lainnya')" class="w-full text-left hover:text-green-400">
                            Lainnya <i class="fas fa-chevron-right float-right"></i>
                        </button>
                    </li>
                </ul>
            </div>
        </div>

        <!-- SUBMENU: PROFIL -->
        <div id="submenu-profil" class="absolute right-0 w-3/4 h-full bg-[#1a1a1a] text-white transform translate-x-full transition-transform duration-300 top-0 p-6 z-20">
            <div class="flex items-center mb-6">
                <button onclick="closeSubmenu('profil')" class="flex items-center gap-2 text-white/80">
                    <i class="fas fa-arrow-left text-xl"></i> <span>Kembali</span>
                </button>
            </div>
            <ul class="font-semibold text-base text-white/80 divide-y divide-white/30">
                @foreach ($dropdowns['Profil'] as $item => $url)
                    <li class="py-4">
                        <a href="{{ $url }}" class="block hover:text-green-400">{{ $item }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- SUBMENU: KOMPETENSI -->
        <div id="submenu-kompetensi" class="absolute right-0 w-3/4 h-full bg-[#1a1a1a] text-white transform translate-x-full transition-transform duration-300 top-0 p-6 z-20">
            <div class="flex items-center mb-6">
                <button onclick="closeSubmenu('kompetensi')" class="flex items-center gap-2 text-white/80">
                    <i class="fas fa-arrow-left text-xl"></i> <span>Kembali</span>
                </button>
            </div>
            <ul class="font-semibold text-base text-white/80 divide-y divide-white/30">
                @foreach ($jurusans as $jurusan)
                    <li class="py-4">
                        <a href="{{ route('jurusan.show', Str::slug($jurusan->name)) }}" class="block hover:text-green-400">{{ $jurusan->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- SUBMENU: LAINNYA -->
        <div id="submenu-lainnya" class="absolute right-0 w-3/4 h-full bg-[#1a1a1a] text-white transform translate-x-full transition-transform duration-300 top-0 p-6 z-20">
            <div class="flex items-center mb-6">
                <button onclick="closeSubmenu('lainnya')" class="flex items-center gap-2 text-white/80">
                    <i class="fas fa-arrow-left text-xl"></i> <span>Kembali</span>
                </button>
            </div>
            <ul class="font-semibold text-base text-white/80">
                <li class="py-4 border-b border-white/30">
                    <a href="#" class="block hover:text-green-400">BKK</a>
                </li>
                <li class="py-4 border-b border-white/30">
                    <a href="#" class="block hover:text-green-400">SPW</a>
                </li>
                <li class="py-4 border-b border-white/30">
                    <a href="#" class="block hover:text-green-400">TEFA</a>
                </li>
                <li class="py-4 border-b border-white/30">
                    <a href="#" class="block hover:text-green-400">SPMB</a>
                </li>
                <li class="py-4 border-b border-white/30">
                    <a href="#" class="block hover:text-green-400">Informasi Terbaru</a>
                </li>
                <li class="py-4 border-b border-white/30">
                    <button onclick="openSubmenu('layanan')" class="w-full text-left hover:text-green-400">
                        Layanan TU <i class="fas fa-chevron-right float-right"></i>
                    </button>
                </li>
            </ul>
        </div>

        <!-- SUBMENU: LAYANAN -->
        <div id="submenu-layanan" class="absolute right-0 w-3/4 h-full bg-[#1a1a1a] text-white transform translate-x-full transition-transform duration-300 top-0 p-6 z-20">
            <div class="flex items-center mb-6">
                <button onclick="closeSubmenu('layanan')" class="flex items-center gap-2 text-white/80">
                    <i class="fas fa-arrow-left text-xl"></i> <span>Kembali</span>
                </button>
            </div>
            <ul class="font-semibold text-base text-white/80">
                <li class="py-4 border-b border-white/30">
                    <a href="#" class="block hover:text-green-400">Legalisir</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Scripts -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script>
    const wrapper = document.getElementById('mobile-wrapper');
    const mainMenu = document.getElementById('main-menu');

    function openMenu() {
        wrapper.classList.remove('hidden');
        setTimeout(() => {
            mainMenu.classList.remove('translate-x-full');
        }, 10);
    }

    function closeMenu() {
        mainMenu.classList.add('translate-x-full');
        document.querySelectorAll('[id^="submenu-"]').forEach(menu => menu.classList.add('translate-x-full'));
        setTimeout(() => wrapper.classList.add('hidden'), 300);
    }

    function openSubmenu(id) {
        const submenu = document.getElementById(`submenu-${id}`);
        submenu.classList.remove('translate-x-full');
    }

    function closeSubmenu(id) {
        const submenu = document.getElementById(`submenu-${id}`);
        submenu.classList.add('translate-x-full');
    }

    wrapper.addEventListener('click', function(e) {
        const isInsideAnyMenu = [
            mainMenu,
            ...document.querySelectorAll('[id^="submenu-"]')
        ].some(menu => menu.contains(e.target));

        if (!isInsideAnyMenu) {
            closeMenu();
        }
    });
</script>

