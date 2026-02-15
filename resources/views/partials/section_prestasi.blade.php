<section class="prestasi-section">
    <div class="container">


        {{-- TITLE --}}
        <div class="text-center mb-5">
            <h2 class="section-sub-title with-line">Prestasi</h2>
            <div class="section-line"></div>
        </div>


        {{-- GRID --}}
        <div class="prtsi-grid">
            @forelse ($prestasi as $item)
                <div class="prtsi-card">


                    {{-- IMAGE --}}
                    <div class="prtsi-thumb">
                        <img src="{{ asset('storage/' . $item->thumbnail) }}"
                             alt="{{ $item->judul }}">
                    </div>


                    {{-- CONTENT --}}
                    <div class="prtsi-content">
                        <span class="prtsi-label">Prestasi</span>
                        <h3 class="prtsi-title">{{ $item->judul }}</h3>
                        <p class="prtsi-desc">
                            {{ Str::limit($item->ringkasan, 80) }}
                        </p>
                    </div>


                </div>
            @empty
                <p class="lp-empty">Belum ada data prestasi.</p>
            @endforelse
        </div>


    </div>
</section>
