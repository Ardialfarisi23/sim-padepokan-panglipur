@extends('anggota.layouts.anggota')

@section('title', 'Jadwal Agenda - Laskar Panglipur')

@push('styles')
    @vite(['resources/css/anggota/pages/jadwal-page.css'])

@endpush

@section('content')
<div class="pg-jadwal-wrapper">
    <h2 class="pg-jadwal-title">Kalender Agenda Laskar Panglipur</h2>

    <div class="jadwal-main-grid">
        <div class="jadwal-list-section">
            <div class="list-header">
                <span class="material-symbols-rounded">event_note</span>
                <h4>Daftar Kegiatan</h4>
            </div>
            <div class="agenda-scroll-area" id="agenda-list-container">
                @include('anggota.jadwal.partials.agenda-list', ['agendas' => $agendas])
            </div>
        </div>

        <div class="jadwal-calendar-section">
            <div class="calendar-card-main">
                <div class="cal-header">
                    <button type="button" class="nav-btn" id="btn-prev-month">‹</button>
                    <span class="month-year" id="display-month-year">
                        {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}
                    </span>
                    <button type="button" class="nav-btn" id="btn-next-month">›</button>
                </div>

                <div class="cal-weekdays">
                    <span>MIN</span><span>SEN</span><span>SEL</span><span>RAB</span><span>KAM</span><span>JUM</span><span>SAB</span>
                </div>

                <div class="cal-grid" id="calendar-grid">
                    </div>
            </div>

            <div class="calendar-card-main mt-3">
                <div style="font-size: 12px; font-weight: 700; color: #64748b; margin-bottom: 10px; text-transform: uppercase;">Keterangan Warna</div>
                <div style="display: flex; flex-direction: column; gap: 8px;">
                    <div style="display: flex; align-items: center; gap: 10px; font-size: 12px;">
                        <span style="width: 12px; height: 12px; background: #dcfce7; border-radius: 3px; border: 1px solid #22c55e;"></span> Latihan Rutin
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px; font-size: 12px;">
                        <span style="width: 12px; height: 12px; background: #dbeafe; border-radius: 3px; border: 1px solid #3b82f6;"></span> Event Nasional
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px; font-size: 12px;">
                        <span style="width: 12px; height: 12px; background: #fef9c3; border-radius: 3px; border: 1px solid #facc15;"></span> Event Internasional
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modalDetailAgenda" class="modal-overlay">
    <div class="modal-content-v2">
        <div id="modalAccentBar" class="modal-accent-bar"></div>
        
        <button class="modal-close-v2" onclick="closeAgendaModal()">
            <span class="material-symbols-rounded">close</span>
        </button>

        <div class="modal-body-v2">
            <div class="modal-header-section">
                <span id="detailStatus" class="status-badge-v2">Status</span>
                <h2 id="detailTitle" class="modal-title-v2">Judul Agenda</h2>
                <div class="modal-date-v2">
                    <span class="material-symbols-rounded">event</span>
                    <span id="detailTanggal">14 Februari 2026</span>
                </div>
            </div>

            <div class="info-card-grid">
                <div class="info-card">
                    <div class="icon-circle">
                        <span class="material-symbols-rounded">location_on</span>
                    </div>
                    <div class="info-content">
                        <label>Lokasi Pelaksanaan</label>
                        <p id="detailTempat">Nama Tempat</p>
                    </div>
                </div>

                <div class="info-card description-card">
                    <div class="icon-circle">
                        <span class="material-symbols-rounded">description</span>
                    </div>
                    <div class="info-content">
                        <label>Informasi Tambahan</label>
                        <p id="detailKeterangan">Keterangan lengkap agenda...</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer-v2">
            <button class="btn-done-v2" onclick="closeAgendaModal()">Selesai</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function openAgendaModal(title, date, location, desc, status, color) {
        const modal = document.getElementById('modalDetailAgenda');
        
        // Isi Konten
        document.getElementById('detailTitle').innerText = title;
        document.getElementById('detailTanggal').innerText = date;
        document.getElementById('detailTempat').innerText = location;
        document.getElementById('detailKeterangan').innerText = desc || 'Tidak ada keterangan tambahan.';
        
        // Atur Warna & Status
        const statusTag = document.getElementById('detailStatus');
        statusTag.innerText = status;
        statusTag.className = 'status-badge-v2 tag-' + color;

        const accentBar = document.getElementById('modalAccentBar');
        accentBar.className = 'modal-accent-bar tag-' + color;

        // Tampilkan dengan gaya Flex
        modal.style.display = 'flex';
        // Kunci scroll body agar tidak bisa gerak saat modal buka
        document.body.style.overflow = 'hidden';
    }

    function closeAgendaModal() {
        const modal = document.getElementById('modalDetailAgenda');
        modal.style.display = 'none';
        // Kembalikan scroll body
        document.body.style.overflow = 'auto';
    }

    // Tutup jika klik area di luar kotak putih (overlay)
    window.onclick = function(event) {
        const modal = document.getElementById('modalDetailAgenda');
        if (event.target === modal) {
            closeAgendaModal();
        }
    }

    // Tutup jika tekan tombol ESC di keyboard
    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") {
            closeAgendaModal();
        }
    });
</script>
    @vite(['resources/js/anggota/jadwal-index.js'])
@endpush