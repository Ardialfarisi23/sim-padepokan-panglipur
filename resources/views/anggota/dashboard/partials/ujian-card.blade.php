<div class="card-ujian-wrapper dash-card">
    <div class="card-header-flex">
        <h3 class="card-title-main">Hasil Ujian</h3>
    </div>
    <div class="ujian-table-container">
        <div class="ujian-header-row">
            <div class="col-tgl">Tanggal</div>
            <div class="col-sabuk">Sabuk Diuji</div>
            <div class="col-nilai text-center">Total Nilai</div>
            <div class="col-status text-center">Status</div>
        </div>

        @forelse($riwayatUjian as $ujian)
            <div class="ujian-row-item">
                <div class="col-tgl">
                    <span class="tgl-text">{{ \Carbon\Carbon::parse($ujian->tanggal_ujian)->format('d - m - Y') }}</span>
                </div>
                <div class="col-sabuk">
                    <span class="sabuk-badge badge-{{ strtolower($ujian->sabuk_diuji) }}">
                        {{ $ujian->sabuk_diuji }}
                    </span>
                </div>
                <div class="col-nilai text-center">
                    <span class="nilai-text">{{ $ujian->total_nilai ?? '-' }}</span>
                </div>
                <div class="col-status text-center">
                    <span class="status-badge {{ $ujian->status == 'lulus' ? 'status-lulus' : 'status-tidak' }}">
                        {{ ucfirst($ujian->status) }}
                    </span>
                </div>
            </div>
        @empty
            <div class="empty-state-simple">
                <p>Belum ada data hasil ujian.</p>
            </div>
        @endforelse
    </div>
</div>