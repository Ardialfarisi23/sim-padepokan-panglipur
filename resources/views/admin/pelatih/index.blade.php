@extends('admin.layouts.admin')

@section('content')
<div class="pg-pelatih-wrapper">
    <div class="pg-pelatih-header">
        <h2 class="pg-pelatih-title">Pelatih</h2>
    </div>

    {{-- Action Bar: Search, Tambah & Filter --}}
    <form action="{{ route('admin.pelatih.index') }}" method="GET" id="filterForm">
        <div class="pg-pelatih-action-container">
            <div class="pg-pelatih-action-bar">
                <div class="pg-pelatih-search-wrapper">
                    <span class="material-symbols-rounded">search</span>
                    <input type="text" name="search" placeholder="Cari nama pelatih..." class="pg-pelatih-input-search" value="{{ request('search') }}">
                </div>

                <div class="action-btns-right">
                    <button type="button" class="btn-tambah-pelatih" id="btnOpenModalTambah">
                        <span class="material-symbols-rounded">add</span>
                        Tambah Pelatih
                    </button>
                    <button type="button" class="pg-pelatih-btn-filter-toggle" id="toggleFilterBtn">
                        <span class="material-symbols-rounded">tune</span>
                        Filter
                        <span class="material-symbols-rounded" id="arrowIcon">expand_more</span>
                    </button>
                </div>
            </div>

            {{-- Panel Filter (Sliding) --}}
<div class="pg-pelatih-filter-panel" id="filterPanel">
    <div class="pg-pelatih-filter-grid">
        {{-- Filter Jenis Kelamin --}}
        <div class="filter-group">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" onchange="this.form.submit()">
                <option value="">Semua</option>
                <option value="laki_laki" {{ request('jenis_kelamin') == 'laki_laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="perempuan" {{ request('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        {{-- Filter Tingkat --}}
        <div class="filter-group">
            <label>Tingkat</label>
            <select name="tingkat" onchange="this.form.submit()">
                <option value="">Semua Tingkat</option>
                @foreach(['putih', 'kuning', 'hijau', 'merah', 'hitam'] as $tkt)
                    <option value="{{ $tkt }}" {{ request('tingkat') == $tkt ? 'selected' : '' }}>{{ ucfirst($tkt) }}</option>
                @endforeach
            </select>
        </div>

        {{-- Filter Rentang Usia --}}
        <div class="filter-group">
            <label>Rentang Usia</label>
            <select name="usia" onchange="this.form.submit()">
                <option value="">Semua Usia</option>
                <option value="muda" {{ request('usia') == 'muda' ? 'selected' : '' }}>Muda (< 30 thn)</option>
                <option value="senior" {{ request('usia') == 'senior' ? 'selected' : '' }}>Senior (30 - 50 thn)</option>
                <option value="master" {{ request('usia') == 'master' ? 'selected' : '' }}>Master (> 50 thn)</option>
            </select>
        </div>

        <div class="filter-actions">
            <a href="{{ route('admin.pelatih.index') }}" class="btn-reset-filter">
                <span class="material-symbols-rounded">restart_alt</span> Reset
            </a>
        </div>
    </div>
</div>
    </form>

    {{-- Tabel Pelatih --}}
    <div class="pg-pelatih-table-scroll-container">
        <table class="pg-pelatih-table">
            <thead>
                <tr>
                    <th>Nama Lengkap</th>
                    <th>Jenis Kelamin</th>
                    <th>Tingkat</th>
                    <th>Usia</th>
                    <th>Tanggal Lahir</th>
                    <th>No. Telepon</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pelatih as $item)
                <tr>
                    <td><strong>{{ $item->nama_lengkap }}</strong></td>
                    <td class="text-center">{{ $item->jenis_kelamin == 'laki_laki' ? 'Laki-laki' : 'Perempuan' }}</td>
                    <td class="text-center">
                        <span class="badge-tingkat {{ $item->tingkat }}">{{ ucfirst($item->tingkat) }}</span>
                    </td>
                     <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal_lahir)->age }}</td>
                     <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('d-m-Y') }}</td>
                    <td>{{ $item->no_telepon }}</td>
                    <td>{{ $item->email }}</td>
                    <td class="cell-truncate" title="{{ $item->alamat }}">{{ $item->alamat }}</td>
                    <td>
                        <div class="pg-pelatih-actions">
    {{-- Tambahkan type="button" di bawah ini --}}
    <button type="button" class="btn-action-circle btn-edit btn-edit-trigger" 
        data-id="{{ $item->id }}"
        data-nama="{{ $item->nama_lengkap }}"
        data-email="{{ $item->email }}"
        data-gender="{{ $item->jenis_kelamin }}"
        data-tingkat="{{ $item->tingkat }}"
        data-tempat="{{ $item->tempat_lahir }}"
        data-tanggal="{{ $item->tanggal_lahir }}"
        data-telepon="{{ $item->no_telepon }}"
        data-alamat="{{ $item->alamat }}">
        <span class="material-symbols-rounded">edit</span>
    </button>
    
    {{-- Tambahkan type="button" di bawah ini --}}
    <button type="button" class="btn-action-circle btn-delete btn-delete-trigger" data-id="{{ $item->id }}">
        <span class="material-symbols-rounded">delete</span>
    </button>

    <form id="delete-form-{{ $item->id }}" action="{{ route('admin.pelatih.destroy', $item->id) }}" method="POST" style="display: none;">
        @csrf @method('DELETE')
    </form>
</div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-5">Data pelatih tidak ditemukan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="pg-pelatih-pagination-area">
        <div class="pg-info">
            Menampilkan {{ $pelatih->firstItem() ?? 0 }} - {{ $pelatih->lastItem() ?? 0 }} dari {{ $pelatih->total() }} Pelatih
        </div>
        <div class="pg-links">
            {{ $pelatih->links() }}
        </div>
    </div>
</div>

{{-- MODAL TAMBAH PELATIH --}}
<div id="modalTambahPelatih" class="modal-overlay">
    <div class="modal-container">
        <div class="modal-header">
            <h3 class="modal-title">Tambah Pelatih Baru</h3>
            <button type="button" class="btn-close-modal close-tambah">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>
        <form action="{{ route('admin.pelatih.store') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" required placeholder="Nama lengkap pelatih">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" required placeholder="email@contoh.com">
                    </div>
                    <div class="form-group">
                        <label>Tingkat</label>
                        <select name="tingkat">
                            <option value="hitam">Hitam</option>
                            <option value="merah">Merah</option>
                            <option value="hijau">Hijau</option>
                            <option value="kuning">Kuning</option>
                            <option value="putih">Putih</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin">
                            <option value="laki_laki">Laki-laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>No. Telepon</label>
                        <input type="text" name="no_telepon" placeholder="08xxxxxxxx">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir">
                    </div>
                    <div class="form-group full-width">
                        <label>Alamat</label>
                        <textarea name="alamat" rows="2" placeholder="Alamat lengkap pelatih..."></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-batal close-tambah">Batal</button>
                <button type="submit" class="btn-simpan">Tambah Pelatih</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT PELATIH --}}
<div id="modalEditPelatih" class="modal-overlay">
    <div class="modal-container">
        <div class="modal-header">
            <h3 class="modal-title">Edit Biodata Pelatih</h3>
            <button type="button" class="btn-close-modal close-edit">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>
        <form id="formEditPelatih" method="POST">
            @csrf @method('PUT')
            <div class="modal-body">
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" id="edit_nama">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" id="edit_email">
                    </div>
                    <div class="form-group">
                        <label>No. Telepon</label>
                        <input type="text" name="no_telepon" id="edit_telepon">
                    </div>
                    <div class="form-group">
    <label>Jenis Kelamin</label>
    <input type="text" id="edit_gender_display" readonly 
           style="background: #f1f5f9; cursor: not-allowed; border: 1px solid #e2e8f0;" 
           placeholder="Memuat data...">
    
    <input type="hidden" name="jenis_kelamin" id="edit_gender_value">
</div>
                    <div class="form-group">
                        <label>Tingkat</label>
                        <select name="tingkat" id="edit_tingkat">
                            <option value="hitam">Hitam</option>
                            <option value="merah">Merah</option>
                            <option value="hijau">Hijau</option>
                            <option value="kuning">Kuning</option>
                            <option value="putih">Putih</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="edit_tanggal">
                    </div>
                    <div class="form-group full-width">
                        <label>Alamat</label>
                        <textarea name="alamat" id="edit_alamat" rows="2"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-batal close-edit">Batal</button>
                <button type="submit" class="btn-simpan">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

{{-- Script untuk Toast & Filter Status --}}
<script>
    window.isFiltering = {{ (request('jenis_kelamin') || request('tingkat') || request('usia')) ? 'true' : 'false' }};
</script>

@push('scripts')
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
    @vite(['resources/js/admin/pelatih-index.js'])
@endpush
@endsection