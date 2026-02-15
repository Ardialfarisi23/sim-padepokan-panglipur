{{-- ================= PENDAFTARAN SECTION ================= --}}
<section id="pendaftaran" class="my-5" data-aos="fade-up">
    <div class="container">
        <div class="pendaftaran-box position-relative overflow-visible">


            {{-- Foto kiri --}}
            <img
                src="{{ asset('assets/img/pesilat_kiri.png') }}"
                alt="Pesilat kiri"
                class="pendaftaran-img left"
            >


            {{-- Foto kanan --}}
            <img
                src="{{ asset('assets/img/pesilat_kanan.png') }}"
                alt="Pesilat kanan"
                class="pendaftaran-img right"
            >


            {{-- Konten --}}
            <div class="pendaftaran-content text-center">
                <h3 class="pendaftaran-title">
                    Jadilah Bagian dari Perjalanan Kami!
                </h3>


                <p class="pendaftaran-desc mt-3">
                    Satu langkah kecil untuk pengalaman besar.<br>
                    Klik tombol di bawah dan isi formulir pendaftaran sekarang.
                </p>


                <div class="pendaftaran-btn-wrapper">
                    <a href="{{ route('pendaftaran.index') }}" class="animated-button animated-button--yellow">
                        <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"/>
                        </svg>


                        <span class="text">Daftar</span>
                        <span class="circle"></span>


                        <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"/>
                        </svg>
                    </a>
                </div>
            </div>


        </div>
    </div>
</section>
