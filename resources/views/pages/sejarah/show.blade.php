@extends('layouts.landing')


@section('title', 'Sejarah Laskar Panglipur')




@section('content')
{{-- NAVBAR --}}


@include('layouts.navbar')


<body style="background-color: #E6FFDA;">


{{-- ================= DETAIL SEJARAH ================= --}}
<div class="sejarah-page">
<section class="section-sejarah-detail">
    <div class="container">


        {{-- JUDUL --}}
        <div class="text-center mb-5" >
            <h1 class="section-sub-title with-line">Sejarah Laskar Panglipur</h1>
            <div class="section-line"></div>
        </div>


        {{-- BLOK 1 --}}
        <div class="row align-items-start mb-5" data-aos="fade-left">


            {{-- TEKS --}}
            <div class="col-lg-7 sejarah-text">
                <judul class="fw-semibold">
                    Silat bukan tentang seberapa keras pukulanmu,
                    tetapi seberapa kuat jiwamu.
                </judul>


                <p>
                    Padepokan Laskar Panglipur berakar dari warisan Pencak Silat Panglipur, yang dirintis oleh Abah Aleh (1856–1980) — seorang tokoh pelestari budaya Sunda dan pendiri silat tradisional Panglipur.Beliau menanamkan keyakinan bahwa pencak silat adalah jalan pembentukan karakter, bukan sekadar seni bela diri.
Nama Panglipur, yang berarti penghibur hati, mencerminkan filosofi luhur bahwa silat hadir untuk menenangkan jiwa, menguatkan batin, dan mempererat persaudaraan.Di dalamnya diajarkan bahwa ketenangan adalah sumber kekuatan, dan adab adalah pondasi setiap jurus.


                </p>


                <p>
                    Nama Panglipur berarti penghibur hati, mencerminkan
                    filosofi luhur bahwa silat bukan untuk menyombongkan
                    kekuatan, melainkan untuk menenangkan jiwa dan
                    mempererat persaudaraan.
                </p>


                <blockquote>
                    “Karena pendekar sejati adalah ia yang mampu berdiri
                    tegak tanpa harus menjatuhkan orang lain.”
                </blockquote>
            </div>


            {{-- FOTO --}}
            <div class="col-lg-5 text-center">
                <img src="{{ asset('assets/img/sejarah_abah_aleh.jpeg') }}"
                     alt="Abah Aleh Panglipur"
                     class="sejarah-image">
            </div>


        </div>


        {{-- BLOK 2 --}}
        <div class="row align-items-center" data-aos="fade-right">


            {{-- FOTO --}}
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="{{ asset('assets/img/sejarah2.jpeg') }}"
                     alt="Latihan Panglipur"
                     class="sejarah-image-large">
            </div>


            {{-- TEKS --}}
            <div class="col-lg-6 sejarah-text">
                <judul>Latihan membentuk raga, nilai membentuk manusia.</judul>


                <p>
                    Padepokan Laskar Panglipur hadir sebagai penerus amanah leluhur menjaga tradisi, mengembangkan prestasi, dan menanamkan nilai luhur kepada generasi penerus.Setiap jurus adalah warisan, setiap latihan adalah pembelajaran hidup, dan setiap pesilat adalah penjaga kehormatan budaya.
Kami meyakini bahwa kekuatan sejati lahir dari disiplin, kesabaran, dan pengendalian diri.Di sinilah pesilat ditempa bukan hanya agar mampu membela diri, tetapi juga mampu menjadi pelindung, penuntun, dan teladan bagi lingkungannya.
                </p>


                <blockquote>
                    “Karena silat sejati bukan untuk menyombongkan kekuatan,melainkan untuk mengabdi dengan keteguhan dan kehormatan.”
                </blockquote>
            </div>


        </div>


    </div>
</section>
@include('partials.section_informasi')


@include('partials.section_prestasi')
@include('landing.sections.pendaftaran')


</div>
</body>
@endsection
