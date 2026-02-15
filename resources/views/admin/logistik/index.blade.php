@extends('admin.layouts.admin')

  @vite(['resources/css/admin/logistik-page.css'])
  @vite(['resources/js/admin/logistik-index.js'])

@section('content')
<div class="pg-logistik-wrapper">
    <div class="pg-logistik-header">
        <h2 class="pg-logistik-title">Logistik</h2>
    </div>

    {{-- Action Bar: Search, Tambah & Filter --}}
    <form action="{{ route('admin.logistik.index') }}" method="GET" id="filterForm">
        <div class="pg-logistik-action-container">
            <div class="pg-logistik-action-bar">
                <div class="pg-logistik-search-wrapper">
                    <span class="material-symbols-rounded">search</span>
                    <input type="text" name="search" placeholder="Cari nama barang..." class="pg-logistik-input-search" value="{{ request('search') }}">
                </div>

                <div class="action-btns-right">
                    <button type="button" class="btn-tambah-logistik" id="btnOpenModalTambah">
                        <span class="material-symbols-rounded">add_box</span>
                        Tambah Barang
                    </button>
                    <button type="button" class="pg-logistik-btn-filter-toggle" id="toggleFilterBtn">
                        <span class="material-symbols-rounded">tune</span>
                        Filter
                        <span class="material-symbols-rounded" id="arrowIcon">expand_more</span>
                    </button>
                </div>
            </div>

            {{-- Panel Filter --}}
            <div class="pg-logistik-filter-panel" id="filterPanel">
                <div class="pg-logistik-filter-grid">
                    <div class="filter-group">
                        <label>Kondisi Barang</label>
                        <select name="kondisi" onchange="this.form.submit()">
                            <option value="">Semua Kondisi</option>
                            <option value="baik" {{ request('kondisi') == 'baik' ? 'selected' : '' }}>Baik</option>
                            <option value="rusak" {{ request('kondisi') == 'rusak' ? 'selected' : '' }}>Rusak</option>
                        </select>
                    </div>
                    <div class="filter-actions">
                        <a href="{{ route('admin.logistik.index') }}" class="btn-reset-filter">
                            <span class="material-symbols-rounded">restart_alt</span> Reset
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{-- Tabel Logistik --}}
    <div class="pg-logistik-table-scroll-container">
        <table class="pg-logistik-table">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th class="text-center">Jumlah</th>
                    <th class="text-center">Satuan</th>
                    <th class="text-center">Kondisi</th>
                    <th class="text-center">Terakhir Update</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logistik as $item)
                <tr>
                    <td><strong>{{ $item->nama_barang }}</strong></td>
                    <td class="text-center">{{ $item->jumlah }}</td>
                    <td class="text-center">{{ $item->satuan }}</td>
                    <td class="text-center">
                        <span class="badge-kondisi {{ $item->kondisi }}">
                            {{ ucfirst($item->kondisi) }}
                        </span>
                    </td>
                    <td class="text-center text-muted">{{ $item->updated_at->format('d/m/Y') }}</td>
                    <td>
                        <div class="pg-logistik-actions">
                            <button class="btn-action-circle btn-edit btn-edit-trigger" 
                                data-id="{{ $item->id }}"
                                data-nama="{{ $item->nama_barang }}"
                                data-jumlah="{{ $item->jumlah }}"
                                data-satuan="{{ $item->satuan }}"
                                data-kondisi="{{ $item->kondisi }}">
                                <span class="material-symbols-rounded">edit</span>
                            </button>
                            
                            <button class="btn-action-circle btn-delete btn-delete-trigger" data-id="{{ $item->id }}">
                                <span class="material-symbols-rounded">delete</span>
                            </button>

                            <form id="delete-form-{{ $item->id }}" action="{{ route('admin.logistik.destroy', $item->id) }}" method="POST" style="display: none;">
                                @csrf @method('DELETE')
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-5">Belum ada data barang.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="pg-logistik-pagination-area">
        <div class="pg-info">
            Menampilkan {{ $logistik->firstItem() ?? 0 }} - {{ $logistik->lastItem() ?? 0 }} dari {{ $logistik->total() }} Barang
        </div>
        <div class="pg-links">
            {{ $logistik->links() }}
        </div>
    </div>
</div>

{{-- MODAL TAMBAH BARANG --}}
<div id="modalTambahLogistik" class="modal-overlay">
    <div class="modal-container">
        <div class="modal-header">
            <h3 class="modal-title">Tambah Barang Baru</h3>
            <button type="button" class="btn-close-modal close-tambah">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>
        <form action="{{ route('admin.logistik.store') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label>Nama Barang</label>
                        <input type="text" name="nama_barang" required placeholder="Contoh: Body Protector">
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" name="jumlah" required min="0" placeholder="0">
                    </div>
                    <div class="form-group">
                        <label>Satuan</label>
                        <input type="text" name="satuan" required placeholder="Contoh: Pcs, Buah, Set">
                    </div>
                    <div class="form-group full-width">
                        <label>Kondisi</label>
                        <select name="kondisi">
                            <option value="baik">Baik</option>
                            <option value="rusak">Rusak</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-batal close-tambah">Batal</button>
                <button type="submit" class="btn-simpan">Simpan Barang</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT BARANG --}}
<div id="modalEditLogistik" class="modal-overlay">
    <div class="modal-container">
        <div class="modal-header">
            <h3 class="modal-title">Edit Data Barang</h3>
            <button type="button" class="btn-close-modal close-edit">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>
        <form id="formEditLogistik" method="POST">
            @csrf @method('PUT')
            <div class="modal-body">
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label>Nama Barang</label>
                        <input type="text" name="nama_barang" id="edit_nama" required>
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" name="jumlah" id="edit_jumlah" required min="0">
                    </div>
                    <div class="form-group">
                        <label>Satuan</label>
                        <input type="text" name="satuan" id="edit_satuan" required>
                    </div>
                    <div class="form-group full-width">
                        <label>Kondisi</label>
                        <select name="kondisi" id="edit_kondisi">
                            <option value="baik">Baik</option>
                            <option value="rusak">Rusak</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-batal close-edit">Batal</button>
                <button type="submit" class="btn-simpan">Update Barang</button>
            </div>
        </form>
    </div>
</div>

<script>
    window.isFiltering = {{ (request('kondisi')) ? 'true' : 'false' }};
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
    @vite(['resources/js/admin/logistik-index.js'])
@endpush

@endsection