@extends('admin.layouts.admin')

@vite(['resources/css/admin/keuangan-page.css', 'resources/js/admin/keuangan-index.js'])

@section('content')
<div class="keuangan-page-wrapper">
    <h1 class="page-title">Keuangan</h1>

    <div class="keuangan-layout">
        <aside class="side-rekap">
            <div class="card-uang-kas">
                <div class="kas-header">
                    <span class="material-symbols-rounded">account_balance_wallet</span>
                    <span class="kas-label">Saldo Uang Kas</span>
                </div>
                <div class="kas-amount-box">
                    <h2 class="kas-value">Rp. {{ number_format($saldoTerbaru, 0, ',', '.') }},</h2>
                </div>
                <a href="{{ route('admin.keuangan.rekap') }}" class="btn-lihat-detail">
                    Lihat Rekap 
                    <span class="material-symbols-rounded">chevron_right</span>
                </a>
            </div>
        </aside>

        <main class="main-table-section">
            <div class="tab-switcher">
                <button class="tab-btn active" data-type="pemasukan" id="btnTabPemasukan">
                    <span class="material-symbols-rounded">money_bag</span> Pemasukan
                </button>
                <button class="tab-btn" data-type="pengeluaran" id="btnTabPengeluaran">
                    <span class="material-symbols-rounded">payments</span> Pengeluaran
                </button>
            </div>

            <div class="table-container-card">
                <div class="table-header-row">
                    <h3 class="table-content-title" id="display-title">Pemasukan</h3>
                    
                    <div class="table-filters">
                        <div class="d-flex gap-2 align-items-center">
    <select id="filterBulanTabel" class="form-select form-select-sm custom-filter-compact" style="width: 130px;">
        @foreach(range(1, 12) as $m)
            <option value="{{ $m }}" {{ $m == $bulan ? 'selected' : '' }}>
                {{ Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
            </option>
        @endforeach
    </select>

    <select id="filterTahunTabel" class="form-select form-select-sm custom-filter-compact" style="width: 100px;">
        @php $currentYear = date('Y'); @endphp
        @foreach(range(2024, 2028) as $y)
            <option value="{{ $y }}" {{ $y == $tahun ? 'selected' : '' }}>
                {{ $y }}
            </option>
        @endforeach
    </select>
</div>
                        <div class="search-box">
                            <span class="material-symbols-rounded">search</span>
                            <input type="text" id="searchTransaksi" placeholder="Cari data...">
                        </div>
                    </div>
                </div>
                
                <div id="transaction_container">
                    <div class="loading-state text-center py-5">
                        <div class="spinner-border text-success" role="status"></div>
                        <p class="mt-2">Memuat data...</p>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <button class="btn-tambah-finance" id="btnOpenModalTambah">
        <span class="material-symbols-rounded">add</span> Tambah
    </button>
</div>

<div class="modal fade" id="modalTransaksi" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content finance-modal">
            <div class="modal-header">
                <div class="header-content-wrapper">
                    <div class="title-row">
                        <h4 class="modal-title" id="modalLabel">Tambah Pemasukan</h4>
                    </div>
                    <p class="modal-subtitle">Isi formulir transaksi dengan benar</p>
                </div>
            </div>

            <form id="formTransaksi">
                @csrf
                <div class="modal-body">
                    <div class="form-group-custom">
                        <label class="input-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control modal-input-custom" value="{{ date('Y-m-d') }}" required>
                    </div>

                    <div class="form-group-custom">
                        <label id="labelSumberKeperluan" class="input-label">Sumber</label>
                        <input type="text" name="sumber_keperluan" class="form-control modal-input-custom" placeholder="Contoh: Iuran Bulanan atau Pembelian Perlengkapan" required>
                    </div>

                    <div class="row">
                        <div class="col-6 form-group-custom">
                            <label class="input-label">Metode</label>
                            <select name="metode" class="form-select modal-input-custom" required>
                                <option value="Cash">Cash</option>
                                <option value="Transfer">Transfer</option>
                                <option value="Qris">Qris</option>
                            </select>
                        </div>
                        <div class="col-6 form-group-custom">
                            <label class="input-label">Nominal (Rp.)</label>
                            <input type="number" name="nominal" class="form-control modal-input-custom" placeholder="0" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0 p-4 pt-0 d-flex justify-content-end gap-3">
    <button type="button" class="btn btn-outline-cancel" data-bs-dismiss="modal">Batal</button>
    <button type="submit" class="btn btn-save shadow-sm">Simpan Transaksi</button>
</div>
            </form>
        </div>
    </div>
</div>

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