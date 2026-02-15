<div class="dash-card card-seragam-wrapper">
    <div class="card-header-flex">
    <h3 class="card-title-main">Seragam</h3>
    <span class="badge-count">{{ $totalSeragamBaru }} Baru</span>
</div>
    <p class="section-subtitle">Daftar Pembelian Seragam</p>

    <div class="seragam-list-container">
        <div class="seragam-header-row">
            <div class="col-name">Nama Lengkap</div>
            <div class="col-meta">Uk</div>
            <div class="col-meta">Qty</div>
        </div>

        <div class="seragam-scroll-area">
            @forelse($pengajuanSeragam as $seragam)
            <div class="seragam-row-item">
                <div class="seragam-info">
                    <span class="name-text">{{ $seragam->anggota->nama_lengkap }}</span>
                    <span class="location-text"><i class="bi bi-geo-alt"></i> Garut</span>
                </div>
                <div class="seragam-meta-group">
                    <span class="badge-size-mini">{{ $seragam->ukuran }}</span>
                    <span class="badge-qty-mini">{{ $seragam->jumlah }}</span>
                </div>
            </div>
            @empty
            <div class="empty-state-mini">
                <p>Belum ada pembelian baru.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>