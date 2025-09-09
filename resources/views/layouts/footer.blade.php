

<!-- Footer -->
<footer class="bg-gray-900 text-white pt-10 pb-6 mt-auto">
    <div class="container mx-auto px-5 max-w-6xl">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Kontak Kami -->
            <div class="mb-6">
                <h5 class="text-xl font-bold border-b-2 border-green-500 pb-2 mb-4">Kontak Kami</h5>
                <p class="font-bold mb-1">SMK NEGERI 1 SUBANG</p>
                <p class="italic mb-1">The School of CEREN Models</p>
                <p class="italic mb-3">"We Are The First, and Our Commitment is Your Satisfaction"</p>

                <div class="flex items-start mb-2">
                    <i class="fas fa-map-marker-alt mt-1 mr-2"></i>
                    <span>Jalan Arief Rahman Hakim No 35, Kabupaten Subang, Jawa Barat 41213.</span>
                </div>

                <div class="flex items-center mb-2">
                    <i class="fas fa-map-marked-alt mr-2"></i>
                    <a href="https://goo.gl/maps/rSNoSaWb6SH2XUdW9" class="text-cyan-400 hover:text-blue-600 hover:underline transition-colors" target="_blank">
                        Lihat di Google Maps
                    </a>
                </div>

                <div class="flex items-center mb-2">
                    <i class="fas fa-phone-alt mr-2"></i>
                    <span>Telp: 0260–411410</span>
                </div>

                <div class="flex items-center mb-2">
                    <i class="fas fa-envelope mr-2"></i>
                    <a href="mailto:info@smkn1subang.sch.id" class="text-white hover:text-cyan-400">info@smkn1subang.sch.id</a>
                </div>

                <div class="flex items-center">
                    <i class="fas fa-id-card mr-2"></i>
                    <span>NPSN: 20233680</span>
                </div>
            </div>

          <!-- Facebook Info -->
<div class="mb-6">
    <h5 class="text-xl font-bold border-b-2 border-green-500 pb-2 mb-4">
        Halaman Resmi Facebook
    </h5>

    <div id="fb-root"></div>
<script async defer crossorigin="anonymous"
    src="https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v17.0" nonce="XYZ"></script>

<div class="fb-page"
    data-href="https://www.facebook.com/officialsmkn1subang"
    data-tabs="timeline"
    data-width=""
    data-height=""
    data-small-header="false"
    data-adapt-container-width="true"
    data-hide-cover="false"
    data-show-facepile="true">
</div>

</div>

            <!-- Statistik & Sosial Media -->
            <div class="mb-6">
                 <h5 class="text-xl font-bold border-b-2 border-green-500 pb-2 mb-4">Statistik Website</h5>
                 <div class="mb-6">
                    <div class="flex justify-between mb-2">
                        <span>Pengunjung Hari Ini:</span>
                        <strong>{{ $hariIni }}</strong>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span>Total Pengunjung:</span>
                        <strong>{{ number_format($totalPengunjung) }}</strong>
                    </div>
                    <div class="flex justify-between">
                        <span>Total Tampilan Halaman:</span>
                        <strong>{{ number_format($totalHalaman) }}</strong>
                    </div>
                </div>


                <h5 class="text-xl font-bold border-b-2 border-green-500 pb-2 mb-4 mt-6">Sosial Media</h5>
                <div class="flex space-x-4">
                    <a href="https://www.facebook.com/officialsmkn1subang" target="_blank" class="social-icon">
                        <i class="fab fa-facebook text-3xl text-white hover:text-blue-500"></i>
                    </a>
                    <a href="https://www.instagram.com/officialsmkn1subang?igsh=eWZseDA0OXd0NXkw" target="_blank" class="social-icon">
                        <i class="fab fa-instagram text-3xl text-white hover:text-pink-500"></i>
                    </a>
                    <a href="https://www.youtube.com/@NesasCeren" target="_blank" class="social-icon">
                        <i class="fab fa-youtube text-3xl text-white hover:text-red-600"></i>
                    </a>
                    <a href="https://www.tiktok.com/@nesasofficial?_t=ZS-8ypZVcIuAvo&_r=1" target="_blank" class="social-icon">
                        <i class="fab fa-tiktok text-3xl text-white hover:text-black"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-700 pt-4 mt-6 text-center text-gray-400 text-sm">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-2 md:mb-0">
                    © <span id="current-year"></span> – SMK Negeri 1 Subang
                </div>
                <div>
                    <a href="#" class="text-gray-400 hover:text-white mr-3 transition-colors">Kebijakan Privasi</a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<script>
    document.getElementById('current-year').textContent = new Date().getFullYear();
</script>
