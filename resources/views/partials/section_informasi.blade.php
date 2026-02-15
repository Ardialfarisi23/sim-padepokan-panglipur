@php use Illuminate\Support\Str; @endphp


<section class="informasi-section">
    <div class="container">


        {{-- Header --}}
        <div class="informasi-header text-center mb-5">
            <h2 class="section-sub-title with-line">Informasi</h2>
            <p class="section-desc">
                Berita dan informasi terbaru Laskar Panglipur
            </p>
        </div>


        {{-- Grid --}}
        <div class="informasi-grid">
            @forelse ($informasi as $item)
                <div class="informasi-card">


                    {{-- Thumbnail --}}
                    <div class="informasi-thumb">
                        <img
                            src="{{ $item->thumbnail
                                ? asset('storage/' . $item->thumbnail)
                                : asset('assets/img/default-informasi.jpg') }}"
                            alt="{{ $item->judul }}">
                    </div>


                    {{-- Content --}}
                    <div class="informasi-content">
                        <span class="informasi-tag">Informasi</span>


                        <h3 class="informasi-title">
                            {{ $item->judul }}
                        </h3>


                        <p class="informasi-desc">
                            {{ Str::limit($item->ringkasan, 110) }}
                        </p>


                        <a href="{{ route('informasi.show', $item->slug) }}"
   class="animated-button animated-button--white informasi-btn">


    <svg class="arr-1" viewBox="0 0 24 24">
        <path d="M5 12h14M13 5l6 7-6 7"/>
    </svg>


    <span class="text">Selengkapnya</span>


    <span class="circle"></span>


    <svg class="arr-2" viewBox="0 0 24 24">
        <path d="M5 12h14M13 5l6 7-6 7"/>
    </svg>


</a>


                    </div>


                </div>
            @empty
                <p class="text-center">Belum ada informasi.</p>
            @endforelse
        </div>


    </div>
</section>
