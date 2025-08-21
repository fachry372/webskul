@extends('layouts.visitor') <!-- Untuk pengunjung -->

@section('title', 'Beranda')

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>

    <!-- BANNER SLIDER -->
    <div class="relative w-full overflow-hidden">
        <!-- Slides -->
        <div class="relative w-full">
            <img src="{{ asset('images/banner1.jpg') }}" alt="Banner 1"
                class="fade-slide w-full h-auto object-cover object-center opacity-100 transition-opacity duration-[3000ms]" />
            <img src="{{ asset('images/banner2.jpg') }}" alt="Banner 2"
                class="fade-slide w-full h-auto object-cover object-center opacity-0 transition-opacity duration-[3000ms] absolute top-0 left-0" />
        </div>
    </div>





    <!-- Sambutan Kepala Sekolah -->
    <section class="relative w-full bg-cover bg-center text-white/90 py-12 px-4 md:px-8 overflow-hidden"
        style="background-image: url('{{ asset('images/gerbang.jpeg') }}');">
        <!-- Overlay navy -->
        <div class="absolute inset-0 bg-[#344966]/90 z-0"></div>

        <!-- Konten -->
        <div class="relative z-10 max-w-7xl mx-auto flex flex-col md:flex-row gap-8 md:gap-12">

            <!-- Foto Kepala Sekolah -->
            <div class="w-full md:w-1/3 flex-shrink-0">
                <img src="{{ asset('images/foto kepsek.png') }}" alt="Foto Kepala Sekolah"
                    class="w-full h-auto max-w-[325px] mx-auto md:mx-0 object-contain rounded-lg ring-0 outline-none border-none" />
            </div>

            <!-- Teks + Tombol -->
            <div class="w-full md:w-2/3 flex flex-col justify-between">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold uppercase mb-1 text-white">DEDEN SURYANTO, M.Pd.</h2>
                    <p class="text-base md:text-lg font-semibold text-green-400 mb-3">
                        Kepala SMK Negeri 1 Subang - NIP. 19740315 199903 1 006
                    </p>

                    <div class="space-y-4 text-base md:text-lg leading-relaxed text-[#c1d3ff]">
                        <p>
                            Assalamualaikum wr wb, selamat datang di kampus SMKN 1 Subang, sekolah yang menerapkan model “C
                            E R E N”, dengan motto:
                            <em>“We are The First, and Our Commitment is Your Satisfaction“</em>. Kami sekolah yang
                            menerapkan program penumbuhkembangan dan pembinaan karakter siswa dengan Program Character
                            building meliputi kegiatan pokok Islamic School Culture (ISC), Bela Negara dan kebersamaan.
                        </p>
                        <p>
                            Menanamkan jiwa kewirausahaan yaitu mampu membaca peluang, pantang menyerah, berani, ulet dan
                            bekerja keras, mewujudkan lulusan yang mampu beradaptasi dengan perkembangan zaman, mewujudkan
                            lulusan yang professional di bidangnya dan mewujudkan lulusan yang peduli terhadap lingkungan
                            sekitar baik secara nasional maupun global.
                        </p>
                        <p>
                            Seluruh program tersebut terintegrasi dalam model yang kami terapkan yaitu model C E R E N. Kami
                            menyambut dengan tangan terbuka seluruh peserta didik yang berhasil diterima sebagai siswa di
                            sekolah kami, InsyaAllah kami sepenuh hati melaksanakan komitmen untuk memuaskan berbagai pihak
                            terutama siswa, orang tua dan IDUKA (Industri, Dunia Usaha, dan Wirausaha) serta pemerintahan
                            daerah baik kabupaten, provinsi maupun Pemerintah Republik Indonesia.
                        </p>
                        <p>
                            Kami juga komitmen untuk pengembangan smart school dengan konsep “One for All”, pengembangan
                            program SMK Masuk Desa, program Start Up for Business, juga program Center of Excellence. Semoga
                            Allah SWT selalu melindungi kita semua dan memberikan kemudahan, kelancaran dan bimbingan-Nya.
                            Aamiin. Wassalamualaikum wr wb.
                        </p>
                    </div>

                    <!-- Tombol -->
                    <div class="mt-6">
                        <a href="#"
                            class="inline-block bg-green-500 hover:bg-green-600 text-white/90 text-lg font-semibold px-6 py-3 rounded shadow transition">
                            Biodata Lengkap Kepala Sekolah
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <!-- Profil Sekolah: CEREN Model -->
    <section class="w-full bg-[#344966] text-white/90 py-12 px-4 md:px-8 relative overflow-hidden">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row gap-8 md:gap-12 relative z-10">

            <!-- Konten Kiri (lebih kecil - 33%) -->
            <div class="w-full md:w-1/3 flex-shrink-0">
                <div class="space-y-4">
                    <!-- Judul Atas -->
                    <h2 class="text-xl md:text-2xl font-bold text-[#22c55e]">The School of</h2>

                    <!-- Teks CEREN -->
                    <p class="text-2xl md:text-3xl font-bold text-[#22c55e]">
                        "CEREN" Models
                    </p>

                    <!-- Slogan -->
                    <p class="italic text-[#22c55e]">
                        We are The First, and Our Commitment is Your Satisfaction
                    </p>

                    <!-- Subjudul -->
                    <h3 class="text-lg md:text-xl font-semibold text-[#22c55e] mt-6">
                        Kompetensi Keahlian:
                    </h3>

                    <!-- Daftar Keahlian -->
                    <ol class="list-decimal list-inside space-y-1 text-[#22c55e] text-base">
                        <li>Akuntansi dan Keuangan Lembaga
                        </li>
                        <li>Pemasaran</li>
                        <li>Manajemen Perkantoran dan Layanan Bisnis</li>
                        <li>Pengembangan Perangkat Lunak dan Gim</li>
                        <li>Teknik Jaringan Komputer dan Telekomunikasi</li>
                        <li>Desain Komunikasi Visual</li>
                        <li>Teknik Otomotif</li>
                        <li>Teknik Mesin</li>
                        <li>Teknik Logistik</li>
                        <li>Kuliner</li>
                    </ol>
                </div>
            </div>

            <!-- Konten Kanan (lebih lebar - 67%) -->
            <div class="w-full md:w-2/3">
                <div class="border border-white/20 rounded-xl overflow-hidden shadow-md bg-white h-[650px]">
                    <iframe src="https://drive.google.com/file/d/1dsrdfB0KJQbf-l1BBtwfxLgDFVN3QnmG/preview"
                        class="w-full h-full" frameborder="0" allow="autoplay">
                    </iframe>
                </div>

                <!-- Tombol Unduh -->
                <div class="mt-4">
                    <a href="https://drive.google.com/uc?export=download&id=1dsrdfB0KJQbf-l1BBtwfxLgDFVN3QnmG"
                        target="_blank"
                        class="inline-block bg-green-500 hover:bg-green-600 text-white/90 text-lg font-semibold px-6 py-3 rounded shadow transition">
                        Unduh Profil SMK Negeri 1 Subang Tahun 2024 (.pdf)
                    </a>
                </div>
            </div>

        </div>
    </section>

    <!-- Profil Sekolah: CEREN Model (5 Box Horizontal) -->
    <section class="w-full bg-[#344966] text-white py-12 px-4 md:px-8 relative overflow-hidden">
        <div class="max-w-7xl mx-auto relative z-10">
            {{-- <h2 class="text-center text-3xl md:text-4xl font-bold text-white mb-10">
        CEREN Model
      </h2> --}}

            <!-- Grid 5 Box Horizontal -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8">
                <!-- Character Building -->
                <div>
                    <h3 class="text-xl md:text-2xl font-bold text-white mb-3">Character Building</h3>
                    <p class="text-base md:text-lg leading-relaxed" style="color: #c1d3ff;">
                        Meyiapkan lulusan yang berkarakter Agamis dan Tangguh secara mental & fisik serta cinta tanah air
                        dimana terintegrasi dalam model sekolah “Character Building” melalui Program Islamic School Culture
                        dan Program Bela Negara.
                    </p>
                </div>

                <!-- Entrepreneurship -->
                <div>
                    <h3 class="text-xl md:text-2xl font-bold text-white mb-3">Entrepreneurship</h3>
                    <p class="text-base md:text-lg leading-relaxed" style="color: #c1d3ff;">
                        Menyiapkan lulusan yang berjiwa wirausaha dimana terintegrasi dalam model sekolah “Enterpreneurship”
                        melalui Program Unit Produksi setiap Program Keahlian.
                    </p>
                </div>

                <!-- Responsive -->
                <div>
                    <h3 class="text-xl md:text-2xl font-bold text-white mb-3">Responsive</h3>
                    <p class="text-base md:text-lg leading-relaxed" style="color: #c1d3ff;">
                        Menyiapkan lulusan yang mampu beradaptasi dengan perkembangan zaman dimana terintegrasi dalam model
                        sekolah “Responsive” melalui Program Smart School dengan konsep One Card for All.
                    </p>
                </div>

                <!-- Excellent of Competency -->
                <div>
                    <h3 class="text-xl md:text-2xl font-bold text-white mb-3">Excellent of Competency</h3>
                    <p class="text-base md:text-lg leading-relaxed" style="color: #c1d3ff;">
                        Menyiapkan lulusan yang cakap dan profesional dibidangnya dimana terintegrasi dalam model sekolah
                        “Execellent Competency” melalui Program Kelas Industri dan Teaching Factory pada masing-masing
                        Program Keahlian.
                    </p>
                </div>

                <!-- Nature -->
                <div>
                    <h3 class="text-xl md:text-2xl font-bold text-white mb-3">Nature</h3>
                    <p class="text-base md:text-lg leading-relaxed" style="color: #c1d3ff;">
                        Menyiapkan lulusan yang peduli terhadap lingkungan sekitar, baik secara nasional maupun global
                        dimana terintegrasi dalam model sekolah “Nature” melalui Program Green School.
                    </p>
                </div>
            </div>
        </div>
    </section>



    <!-- Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const slides = document.querySelectorAll('.fade-slide');
            let current = 0;

            setInterval(() => {
                slides[current].classList.remove('opacity-100');
                slides[current].classList.add('opacity-0');
                slides[current].classList.remove('z-10');
                slides[current].classList.add('z-0');

                current = (current + 1) % slides.length;

                slides[current].classList.remove('opacity-0');
                slides[current].classList.add('opacity-100');
                slides[current].classList.remove('z-0');
                slides[current].classList.add('z-10');
            }, 7000); // Ganti setiap 7 detik
        });
    </script>
@endsection
