<section id="informasi">
    <div class="lp-wrapper">
        <div class="lp-inner">


        {{-- ================= INFORMASI ================= --}}
<div class="lp-section">
    <h2 class="lp-title">Informasi</h2>


    <div class="info-ui-grid info-ui-scroll" data-aos="fade-left">
        @isset($informasi)
    @foreach ($informasi as $item)
                <div class="info-ui-card" >


    {{-- THUMBNAIL --}}
    <div class="info-ui-image">
        <img
            src="{{ !empty($item->thumbnail)
                ? asset('storage/'.$item->thumbnail)
                : asset('assets/img/default-informasi.jpg') }}"
            alt="{{ $item->judul }}">
    </div>


    {{-- CONTENT --}}
    <div class="info-ui-content">


        <span class="info-ui-label">Informasi</span>


        <h3 class="info-ui-title">
            {{ $item->judul }}
        </h3>


        <p class="info-ui-desc">
            {{ Str::limit(strip_tags($item->ringkasan), 300) }}
        </p>


        {{-- BUTTON --}}
        <div class="info-ui-action">
            <a href="{{ route('informasi.show', $item->slug) }}"
               class="animated-button animated-button--white info-ui-btn">
                <span class="text">Selengkapnya</span>
                <span class="circle"></span>


                <svg class="arr-1" viewBox="0 0 24 24">
                    <path d="M5 12h14M13 5l7 7-7 7"/>
                </svg>
                <svg class="arr-2" viewBox="0 0 24 24">
                    <path d="M5 12h14M13 5l7 7-7 7"/>
                </svg>
            </a>
        </div>


    </div>
</div>


             @endforeach
@else
    <p class="lp-empty">Data informasi belum tersedia.</p>
@endisset
    </div>
</div>




        {{-- ================= PRESTASI ================= --}}
<div id="prestasi" class="lp-section">
    <h2 class="lp-title">Prestasi</h2>


    <div class="prestasi-scroll" data-aos="fade-left">
        @isset($prestasi)
            @forelse ($prestasi as $item)
                <div class="prestasi-card">


                    {{-- THUMBNAIL --}}
                    <div class="prestasi-thumb">
                        <img
                            src="{{ !empty($item->thumbnail)
                                ? asset('storage/'.$item->thumbnail)
                                : asset('assets/img/default-prestasi.jpg') }}"
                            alt="{{ $item->judul }}">
                    </div>


                    {{-- CONTENT --}}
                    <div class="prestasi-content">
                        <span class="prestasi-label">Prestasi</span>


                        <h3 class="prestasi-title">
                            {{ $item->judul }}
                        </h3>


                        <p class="prestasi-desc">
                            {{ Str::limit(strip_tags($item->ringkasan), 120) }}
                        </p>
                    </div>


                </div>
            @empty
                <p class="lp-empty">Belum ada prestasi.</p>
            @endforelse
        @endisset
    </div>
    <div class="lp-center">
    <a href="{{ route('sejarah.show') }}"
       class="animated-button animated-button--outline-white">
        <span class="text">Selengkapnya</span>
        <span class="circle"></span>


        <svg class="arr-1" viewBox="0 0 24 24">
            <path d="M5 12h14M13 5l7 7-7 7"/>
        </svg>


        <svg class="arr-2" viewBox="0 0 24 24">
            <path d="M5 12h14M13 5l7 7-7 7"/>
        </svg>
    </a>
</div>
</div>




</section>
