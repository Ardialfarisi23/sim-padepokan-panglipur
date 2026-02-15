@extends('admin.layouts.admin')

  @vite(['resources/css/admin/jadwal-page.css'])
  @vite(['resources/js/admin/jadwal-index.js'])


@section('content')
<div class="pg-jadwal-wrapper">
    <h2 class="pg-jadwal-title">Jadwal Agenda</h2>

    <div class="jadwal-main-grid">
        <div class="jadwal-list-section">
            <div class="list-header">
                <span class="material-symbols-rounded">format_list_bulleted</span>
                <h4>Daftar Agenda</h4>
            </div>
            <div class="agenda-scroll-area" id="agenda-list-container">
                {{-- Data akan di-load via AJAX atau saat render pertama --}}
                @include('admin.jadwal.partials.agenda-list', ['agendas' => $agendas])
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
                    {{-- Grid tanggal akan di-render oleh JS --}}
                </div>
            </div>

            <div class="jadwal-action-group">
    <button class="btn-action btn-tambah" id="btnOpenTambah">
        <span class="material-symbols-rounded">add</span> Tambah
    </button>
    <button class="btn-action btn-edit" id="btnOpenEdit">
        <span class="material-symbols-rounded">edit</span> Edit
    </button>
    <button class="btn-action btn-hapus" id="btnOpenHapus">
        <span class="material-symbols-rounded">delete</span> Hapus
    </button>
</div>
        </div>
    </div>
</div>

<div class="modal-jadwal" id="modalTambahJadwal">
    <div class="modal-content-wrapper">
        <div class="modal-left-calendar">
    <div class="mini-cal-header">
        <button type="button" class="mini-nav" id="prevMiniTambah">‹</button>
        <span id="monthYearTambah">Januari 2026</span>
        <button type="button" class="mini-nav" id="nextMiniTambah">›</button>
    </div>
    
    <div class="mini-cal-weekdays">
        <span>M</span><span>S</span><span>S</span><span>R</span><span>K</span><span>J</span><span>S</span>
    </div>

    <div class="mini-cal-grid" id="gridTambah"></div>
</div>
        <div class="modal-right-form">
            <h3>Tambah Jadwal Baru</h3>
<form action="{{ route('admin.jadwal.store') }}" method="POST" id="formTambahJadwal">
    @csrf
    <input type="hidden" name="tanggal" id="input_tgl_tambah" required>

    <div class="form-group">
        <label>Nama Agenda</label>
        <input type="text" name="agenda" required placeholder="Contoh: Latihan Rutin Sabungan">
    </div>

    <div class="form-row">
        <div class="form-group">
            <label>Lokasi</label>
            <input type="text" name="lokasi" required placeholder="Gedung/Lap...">
        </div>
        <div class="form-group">
            <label>Kategori</label>
            <select name="status" required>
                <option value="latihan">Latihan</option>
                <option value="nasional">Nasional</option>
                <option value="internasional">Internasional</option>
                <option value="lainnya">Lainnya</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label>Keterangan (Opsional)</label>
        <textarea name="keterangan" rows="3" placeholder="Detail tambahan..."></textarea>
    </div>

    <div class="modal-actions">
        <button type="button" class="btn-batal close-modal">Batal</button>
        <button type="submit" class="btn-simpan">Simpan Jadwal</button>
    </div>
</form>
        </div>
    </div>
</div>

<div class="modal-jadwal" id="modalEditJadwal">
    <div class="modal-content-wrapper">
        <div class="modal-left-calendar">
            <div class="mini-cal-header">
                <button type="button" class="mini-nav" id="prevMiniEdit">‹</button>
                <span id="monthYearEdit">...</span>
                <button type="button" class="mini-nav" id="nextMiniEdit">›</button>
            </div>
            <div class="mini-cal-weekdays">
                <span>M</span><span>S</span><span>S</span><span>R</span><span>K</span><span>J</span><span>S</span>
            </div>
            <div class="mini-cal-grid" id="gridEdit"></div>
        </div>
        <div class="modal-right-form">
            <h3>Edit Jadwal</h3>
            
            <div id="edit-selection-list" class="mini-agenda-selector">
                </div>

            <form action="" method="POST" id="formEditJadwal" style="display: none;">
                @csrf @method('PUT')
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" id="edit_tanggal" required>
                </div>
                <div class="form-group">
                    <label>Nama Agenda</label>
                    <input type="text" name="agenda" id="edit_agenda" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Lokasi</label>
                        <input type="text" name="lokasi" id="edit_lokasi" required>
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="status" id="edit_status" required>
                            <option value="latihan">Latihan</option>
                            <option value="nasional">Nasional</option>
                            <option value="internasional">Internasional</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea name="keterangan" id="edit_keterangan" rows="2"></textarea>
                </div>
                <div class="modal-actions">
                    <button type="button" onclick="resetModalEdit()" class="btn-batal">Kembali</button>
                    <button type="submit" class="btn-simpan">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal-jadwal" id="modalHapusJadwal">
    <div class="modal-content-wrapper border-top-danger">
        <div class="modal-left-calendar">
            <div class="mini-cal-header">
                <button type="button" class="mini-nav" id="prevMiniHapus">‹</button>
                <span id="monthYearHapus">...</span>
                <button type="button" class="mini-nav" id="nextMiniHapus">›</button>
            </div>
            <div class="mini-cal-weekdays">
                <span>M</span><span>S</span><span>S</span><span>R</span><span>K</span><span>J</span><span>S</span>
            </div>
            <div class="mini-cal-grid" id="gridHapus"></div>
        </div>
        <div class="modal-right-form">
            <div class="list-header">
                <h3>Hapus Jadwal</h3>
            </div>
            
            <div id="hapus-selection-list" class="mini-agenda-selector">
                </div>

            <div class="modal-actions">
                <button type="button" class="btn-batal close-modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const Toast = Swal.mixin({
                toast: true, position: 'top-end', showConfirmButton: false, timer: 3000, timerProgressBar: true
            });
            @if(session('success')) Toast.fire({ icon: 'success', title: "{{ session('success') }}" }); @endif
            @if(session('error')) Toast.fire({ icon: 'error', title: "{{ session('error') }}" }); @endif
        });
    </script>
@endsection