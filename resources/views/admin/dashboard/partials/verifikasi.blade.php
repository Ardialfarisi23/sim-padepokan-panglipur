<div class="dash-card card-pendaftaran-wrapper">
    <div class="card-header-flex">
        <h3 class="card-title-main">Verifikasi</h3>
        <span class="badge-count-orange">{{ $totalPendaftaranBaru }} Calon</span>
    </div>
    <p class="section-subtitle">Pendaftar Anggota Baru</p>

    <div class="pendaftaran-list-container">
        @forelse($pendaftarBaru as $pendaftar)
        <div class="pendaftaran-row-item">
            <div class="pendaftaran-info">
                <span class="name-text">{{ $pendaftar->nama_lengkap }}</span>
                <span class="location-text">
                    <span class="material-symbols-rounded">location_on</span> 
                    {{ Str::limit($pendaftar->alamat, 25) }}
                </span>
            </div>
            <div class="pendaftaran-contact">
    <div class="contact-box-static">
        <span class="material-symbols-rounded">call</span>
        <span class="phone-text">{{ $pendaftar->no_telepon }}</span>
    </div>
</div>
        </div>
        @empty
        <div class="empty-state-mini">
            <p>Tidak ada pendaftar baru.</p>
        </div>
        @endforelse
    </div>
</div>