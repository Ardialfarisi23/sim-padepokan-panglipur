{{-- ================= SEJARAH SECTION ================= --}}
<section id="sejarah" class="my-5">
    <div class="container">
        <div class="section-box sejarah-box p-4 p-md-5">

            {{-- Judul --}}
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="sejarah-title">Sejarah Laskar Panglipur</h2>
            </div>

            <div class="row align-items-center">
                {{-- Foto --}}
                <div class="col-md-4 text-center mb-4 mb-md-0" data-aos="fade-up" data-aos-delay="100">
                    <img src="{{ asset('assets/img/sejarah_abah_aleh.jpeg') }}" 
                         alt="Abah Aleh Panglipur" 
                         class="img-fluid sejarah-image shadow-sm">
                </div>

                {{-- Konten --}}
                <div class="col-md-8" data-aos="fade-up" data-aos-delay="200">
                    <div class="sejarah-text-wrapper">
                        <p class="mb-3">
                            Berakar dari Pencak Silat Panglipur, warisan Abah Aleh (1856–1980), 
                            seorang penjaga budaya Sunda dan pendiri silat tradisional Panglipur. 
                            Kami melangkah dengan satu keyakinan.
                        </p>

                        <blockquote class="sejarah-quote my-4">
                            “Silat bukan sekadar bela diri, tetapi<br class="d-none d-md-block"> 
                            jalan pembentukan jati diri.”
                        </blockquote>

                        <p class="mb-4">
                            Panglipur berarti penghibur hati, sebuah filosofi bahwa kekuatan sejati 
                            lahir dari ketenangan jiwa, keteguhan sikap, dan persaudaraan yang tulus. 
                            Di sinilah raga ditempa, mental diasah, dan budi pekerti dijunjung tinggi. 
                            Padepokan Laskar Panglipur hadir untuk melanjutkan amanah itu, menjaga 
                            tradisi, mengukir prestasi, dan menanamkan nilai luhur bagi generasi penerus.
                        </p>

                        {{-- Button --}}
                        <div class="mt-4">
                            <a href="{{ route('sejarah.show') }}" class="animated-button">
                                <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"/>
                                </svg>
                                <span class="text">Selengkapnya</span>
                                <span class="circle"></span>
                                <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>