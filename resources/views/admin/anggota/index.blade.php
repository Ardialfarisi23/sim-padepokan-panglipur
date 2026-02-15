@extends('admin.layouts.admin')

@section('content')
<div class="pg-anggota-wrapper">
    <div class="pg-anggota-header">
        <h2 class="pg-anggota-title">Anggota</h2>
    </div>

    {{-- Form Filter & Search --}}
    <form action="{{ route('admin.anggota.index') }}" method="GET" id="filterForm">
        <div class="pg-anggota-filter-container">
            <div class="pg-anggota-action-bar">
                <div class="pg-anggota-search-wrapper">
                    <span class="material-symbols-rounded">search</span>
                    <input type="text" name="search" placeholder="Cari nama..." class="pg-anggota-input-search" value="{{ request('search') }}">
                </div>

                <button type="button" class="pg-anggota-btn-filter-toggle" id="toggleFilterBtn">
                    <span class="material-symbols-rounded">tune</span>
                    Filter
                    <span class="material-symbols-rounded" id="arrowIcon">expand_more</span>
                </button>
            </div>

            <div class="pg-anggota-filter-panel" id="filterPanel">
                <div class="pg-anggota-filter-grid">
                    <div class="filter-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" onchange="this.form.submit()">
                            <option value="">Semua</option>
                            <option value="laki_laki" {{ request('jenis_kelamin') == 'laki_laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="perempuan" {{ request('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label>Tingkat</label>
                        <select name="tingkat" onchange="this.form.submit()">
                            <option value="">Semua Tingkat</option>
                            @foreach(['putih', 'kuning', 'hijau', 'merah', 'hitam'] as $tkt)
                                <option value="{{ $tkt }}" {{ request('tingkat') == $tkt ? 'selected' : '' }}>{{ ucfirst($tkt) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-group">
                        <label>Rentang Usia</label>
                        <select name="usia" onchange="this.form.submit()">
                            <option value="">Semua Usia</option>
                            <option value="anak" {{ request('usia') == 'anak' ? 'selected' : '' }}>Anak (< 15 thn)</option>
                            <option value="remaja" {{ request('usia') == 'remaja' ? 'selected' : '' }}>Remaja (15-25 thn)</option>
                            <option value="dewasa" {{ request('usia') == 'dewasa' ? 'selected' : '' }}>Dewasa (> 25 thn)</option>
                        </select>
                    </div>

                    <div class="filter-actions">
                        <a href="{{ route('admin.anggota.index') }}" class="btn-reset-filter">
                            <span class="material-symbols-rounded">restart_alt</span> Reset
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{-- Tabel Data --}}
    <div class="pg-anggota-table-scroll-container">
        <table class="pg-anggota-table">
            <thead>
                <tr>
                    <th>Nama Lengkap</th>
                    <th>Jenis Kelamin</th>
                    <th>Tingkat</th>
                    <th>Usia</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Email</th>
                    <th>No. Telepon</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($anggota as $item)
                <tr>
                    <td><strong>{{ $item->nama_lengkap }}</strong></td>
                    <td class="text-center">{{ $item->jenis_kelamin == 'laki_laki' ? 'Laki-laki' : 'Perempuan' }}</td>
                    <td class="text-center">
                        <span class="badge-tingkat {{ $item->tingkat }}">{{ ucfirst($item->tingkat) }}</span>
                    </td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal_lahir)->age }}</td>
                    <td>{{ $item->tempat_lahir }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('d-m-Y') }}</td>
                    <td class="cell-truncate" title="{{ $item->alamat }}">{{ $item->alamat }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->no_telepon }}</td>
                    <td>
                        <div class="pg-anggota-actions">
                            <button class="btn-action-circle btn-edit btn-edit-trigger" 
        data-id="{{ $item->id }}"
        data-nama="{{ $item->nama_lengkap }}"
        data-tempat="{{ $item->tempat_lahir }}"
        data-tanggal="{{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('Y-m-d') }}"
        data-tingkat="{{ $item->tingkat }}"
        data-gender="{{ $item->jenis_kelamin }}"
        data-alamat="{{ $item->alamat }}"
        data-email="{{ $item->email }}"
        data-telepon="{{ $item->no_telepon }}"
        title="Edit">
    <span class="material-symbols-rounded">edit</span>
</button>
                            <button class="btn-action-circle btn-delete btn-delete-trigger" 
                                    data-id="{{ $item->id }}" 
                                    title="Hapus">
                                <span class="material-symbols-rounded">delete</span>
                            </button>
                            <form id="delete-form-{{ $item->id }}" action="{{ route('admin.anggota.destroy', $item->id) }}" method="POST" style="display: none;">
                                @csrf @method('DELETE')
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="10" class="text-center py-5">Data anggota tidak ditemukan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="pg-anggota-pagination-area">
        <div class="pg-info">
            Menampilkan {{ $anggota->firstItem() ?? 0 }} - {{ $anggota->lastItem() ?? 0 }} dari {{ $anggota->total() }} Anggota
        </div>
        <div class="pg-links">
            {{ $anggota->links() }}
        </div>
    </div>
</div>

<div id="modalEditAnggota" class="modal-overlay">
    <div class="modal-container">
        <div class="modal-header">
            <h3 class="modal-title">Biodata Anggota</h3>
            <button type="button" class="btn-close-modal" id="btnCloseModal">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>

        <form id="formEditAnggota" method="POST">
            @csrf
            @method('PUT')
            
            <div class="modal-body">
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" id="edit_nama" placeholder="Masukkan nama lengkap">
                    </div>

                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" id="edit_tempat" placeholder="Contoh: Bandung">
                    </div>
                    <div class="form-group">
                        <label>Tingkat</label>
                        <select name="tingkat" id="edit_tingkat">
                            <option value="putih">Putih</option>
                            <option value="kuning">Kuning</option>
                            <option value="hijau">Hijau</option>
                            <option value="merah">Merah</option>
                            <option value="hitam">Hitam</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="edit_tanggal">
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="edit_gender">
                            <option value="laki_laki">Laki-laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" id="edit_email" placeholder="contoh@mail.com">
                    </div>
                    <div class="form-group">
                        <label>No. Telepon</label>
                        <input type="text" name="no_telepon" id="edit_telepon" placeholder="08xxxxxx">
                    </div>

                    <div class="form-group full-width">
                        <label>Alamat</label>
                        <textarea name="alamat" id="edit_alamat" rows="3" placeholder="Masukkan alamat lengkap"></textarea>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-batal" id="btnCancelModal">Batal</button>
                <button type="submit" class="btn-simpan">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

{{-- Oper status filter ke JavaScript --}}
<script>
    window.isFiltering = {{ (request('jenis_kelamin') || request('tingkat') || request('usia')) ? 'true' : 'false' }};
</script>

{{-- Global Variable untuk JS External --}}
<script>
    window.isFiltering = {{ (request('jenis_kelamin') || request('tingkat') || request('usia')) ? 'true' : 'false' }};
</script>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            @if(session('success'))
                Toast.fire({ icon: 'success', title: "{{ session('success') }}" });
            @endif

            @if(session('error'))
                Toast.fire({ icon: 'error', title: "{{ session('error') }}" });
            @endif
        });
    </script>
    @vite(['resources/js/admin/anggota-index.js'])
@endpush
@endsection