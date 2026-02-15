@extends('admin.layouts.admin')

@vite(['resources/css/admin/seragam-page.css', 'resources/js/admin/seragam-index.js'])

@section('content')

@if(session('success'))
    <meta name="success-message" content="{{ session('success') }}">
@endif
@if(session('error'))
    <meta name="error-message" content="{{ session('error') }}">
@endif

<div class="pg-seragam-wrapper">
    <div class="pg-seragam-header">
        <h2 class="pg-seragam-title">Pengelolaan Seragam</h2>
        <button class="btn-restock" data-bs-toggle="modal" data-bs-target="#modalRestock">
            <span class="material-symbols-rounded">add_box</span> Restock Gudang
        </button>
    </div>

    {{-- 1. INFORMASI STOK (STOCK CARDS) --}}
    <div class="stok-container">
        @foreach(['S', 'M', 'L', 'XL', 'XXL'] as $uk)
        @php $item = $stok[$uk] ?? null; @endphp
        <div class="stok-card {{ ($item && $item->stok < 5) ? 'stok-low' : '' }}">
            <div class="stok-label">Ukuran {{ $uk }}</div>
            <div class="stok-value">{{ $item ? $item->stok : 0 }}</div>
            <div class="stok-unit">Pcs</div>
            @if($item && $item->stok < 5)
                <div class="stok-warning">Stok Hampir Habis!</div>
            @endif
        </div>
        @endforeach
    </div>

    {{-- 2. TABEL PENGAJUAN BARU --}}
    <div class="section-container mt-4">
        <div class="section-header">
            <span class="material-symbols-rounded">pending_actions</span>
            <h3>Pengajuan Pembelian Baru</h3>
        </div>
        <div class="table-responsive custom-table">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Anggota</th>
                        <th>Gender</th>
                        <th class="text-center">Ukuran</th>
                        <th class="text-center">Jumlah</th>
                        <th>Total Harga</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengajuan as $p)
                    <tr>
                        <td class="fw-bold">{{ $p->anggota->nama_lengkap }}</td>
                        {{-- Cari baris ini di tabel Pengajuan Baru --}}
<td>
    {{ ($p->anggota->jenis_kelamin == 'L' || $p->anggota->jenis_kelamin == 'laki_laki' || $p->anggota->jenis_kelamin == 'Laki-laki') ? 'Laki-laki' : 'Perempuan' }}
</td>
                        <td class="text-center"><span class="badge-ukuran">{{ $p->ukuran }}</span></td>
                        <td class="text-center">{{ $p->jumlah }}</td>
                        <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <form action="{{ route('admin.seragam.confirm', $p->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-action-success" title="Konfirmasi">
                                        <span class="material-symbols-rounded">check_circle</span>
                                    </button>
                                </form>
                                <form action="{{ route('admin.seragam.reject', $p->id) }}" method="POST" onsubmit="return confirm('Tolak pesanan ini?')">
                                    @csrf
                                    <button type="submit" class="btn-action-danger" title="Tolak">
                                        <span class="material-symbols-rounded">cancel</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center py-4 text-muted">Tidak ada pengajuan baru.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- 3. TABEL SEDANG DIPROSES / SIAP DIAMBIL --}}
    <div class="section-container mt-4">
        <div class="section-header color-proses">
            <span class="material-symbols-rounded">inventory_2</span>
            <h3>Sedang Diproses & Menunggu Pembayaran</h3>
        </div>
        <div class="table-responsive custom-table">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Anggota</th>
                        <th class="text-center">Ukuran</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($proses as $pr)
                    <tr>
                        <td>{{ $pr->anggota->nama_lengkap }}</td>
                        <td class="text-center">{{ $pr->ukuran }}</td>
                        <td class="text-center">
                            <span class="badge-status {{ str_replace(' ', '-', $pr->status) }}">
                                {{ strtoupper($pr->status) }}
                            </span>
                        </td>
                        <td class="text-center">
                            @if($pr->status == 'diproses')
                                <form action="{{ route('admin.seragam.updateStatus', $pr->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="siap diambil">
                                    <button type="submit" class="btn-status-next">Siap Diambil <span class="material-symbols-rounded">arrow_forward</span></button>
                                </form>
                            @else
                                <form action="{{ route('admin.seragam.updateStatus', $pr->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="selesai">
                                    <button type="submit" class="btn-status-finish">Selesaikan <span class="material-symbols-rounded">task_alt</span></button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center py-4 text-muted">Belum ada pesanan yang diproses.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL RESTOCK --}}
@include('admin.seragam.modal-restock')

@endsection