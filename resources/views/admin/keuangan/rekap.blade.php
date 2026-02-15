@extends('admin.layouts.admin')

@vite(['resources/css/admin/keuangan-rekap.css'])

@section('content')
<div class="container-rekap-main py-3 px-4">
    <div class="container">
        <div class="rekap-header-wrapper mb-3">
            <a href="{{ route('admin.keuangan.index') }}" class="btn-back-custom mb-2">
                <span class="material-symbols-rounded" style="font-size: 16px;">chevron_left</span>
                Kembali
            </a>
            <h4 class="fw-bold m-0">Rekap Kas</h4>
            <p class="text-muted small m-0">Laporan ringkas keuangan.</p>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="fw-bold m-0" style="font-size: 0.85rem;">Tren Arus Kas {{ $tahunDipilih }}</h6>
                            <div class="d-flex gap-3">
                                <small class="d-flex align-items-center gap-1" style="font-size: 0.7rem;">
                                    <span class="dot bg-success"></span> Masuk
                                </small>
                                <small class="d-flex align-items-center gap-1" style="font-size: 0.7rem;">
                                    <span class="dot bg-danger"></span> Keluar
                                </small>
                            </div>
                        </div>
                        <div style="height: 220px;"> <canvas id="rekapChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
    <div class="d-flex flex-column gap-2 h-100">
        <div class="stat-card-mini border-start-success">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted d-block mini-label">Rata - Rata Pemasukan</small>
                    <h6 class="fw-bold m-0 text-dark">Rp {{ number_format(collect($chartData['pemasukan'])->avg(), 0, ',', '.') }}</h6>
                </div>
                <span class="material-symbols-rounded text-success opacity-50 fs-5">trending_up</span>
            </div>
        </div>

        <div class="stat-card-mini border-start-danger">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted d-block mini-label">Rata - Rata Pengeluaran</small>
                    <h6 class="fw-bold m-0 text-dark">Rp {{ number_format(collect($chartData['pengeluaran'])->avg(), 0, ',', '.') }}</h6>
                </div>
                <span class="material-symbols-rounded text-danger opacity-50 fs-5">trending_down</span>
            </div>
        </div>

        <div class="stat-card-mini border-start-dark bg-dark-subtle">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted d-block mini-label">Tahun Laporan</small>
                    <h6 class="fw-bold m-0 text-dark">{{ $tahunDipilih }} <span class="fw-normal text-muted" style="font-size: 0.7rem;">({{ $allRekap->count() }} Bln)</span></h6>
                </div>
                <span class="material-symbols-rounded text-secondary opacity-50 fs-5">event_available</span>
            </div>
        </div>
    </div>
</div>

        <div class="card-rekap-container shadow-sm border-0">
            <div class="p-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold m-0" style="font-size: 0.85rem;">Detail Transaksi Bulanan</h6>
                    <div class="d-flex align-items-center gap-2">
                        <select class="form-select form-select-sm border-0 bg-light fw-bold" 
                                id="filterTahunRekap" 
                                style="font-size: 0.75rem; cursor: pointer; width: auto;">
                            @for($y = now()->year; $y >= 2024; $y--)
                                <option value="{{ $y }}" {{ $y == $tahunDipilih ? 'selected' : '' }}>Tahun {{ $y }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-custom align-middle">
                        <thead>
                            <tr>
                                <th class="ps-3">Periode</th>
                                <th>Saldo Awal</th>
                                <th>Pemasukan</th>
                                <th>Pengeluaran</th>
                                <th>Saldo Akhir</th>
                                <th class="text-center pe-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($allRekap as $r)
                                @php
                                    $isSurplus = $r->total_pemasukan >= $r->total_pengeluaran;
                                @endphp
                                <tr>
                                    <td class="ps-3">
                                        <div class="fw-bold text-dark" style="font-size: 0.85rem;">
                                            {{ Carbon\Carbon::create()->month($r->periode_bulan)->translatedFormat('F') }}
                                        </div>
                                        <small class="text-muted" style="font-size: 0.7rem;">{{ $r->periode_tahun }}</small>
                                    </td>
                                    <td class="text-secondary small">Rp {{ number_format($r->saldo_awal, 0, ',', '.') }}</td>
                                    <td class="text-success small fw-semibold">+ {{ number_format($r->total_pemasukan, 0, ',', '.') }}</td>
                                    <td class="text-danger small fw-semibold">- {{ number_format($r->total_pengeluaran, 0, ',', '.') }}</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold text-dark" style="font-size: 0.8rem;">Rp {{ number_format($r->saldo_akhir, 0, ',', '.') }}</span>
                                            <span class="badge-status {{ $isSurplus ? 'surplus' : 'defisit' }}">
                                                {{ $isSurplus ? 'Surplus' : 'Defisit' }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="text-center pe-3">
                                        <a href="{{ route('admin.keuangan.index', ['bulan' => $r->periode_bulan, 'tahun' => $r->periode_tahun]) }}" 
                                           class="btn-detail-circle" title="Lihat Detail">
                                            <span class="material-symbols-rounded" style="font-size: 16px;">manage_search</span>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted small">Data tidak tersedia untuk tahun ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="total-kas-modern d-flex justify-content-between align-items-center mt-3">
                    <div class="ps-2">
                        <span class="text-uppercase fw-bold text-muted d-block" style="font-size: 0.6rem;">Total Kas Akhir</span>
                        <h5 class="fw-bold text-primary m-0" style="font-size: 1.1rem;">Rp {{ number_format($totalKas, 0, ',', '.') }}</h5>
                    </div>
                    <div class="pe-2 text-primary opacity-25">
                        <span class="material-symbols-rounded" style="font-size: 2rem;">account_balance_wallet</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Logic Filter Tahun
        const filterTahun = document.getElementById('filterTahunRekap');
        if (filterTahun) {
            filterTahun.addEventListener('change', function() {
                this.disabled = true;
                window.location.href = `{{ route('admin.keuangan.rekap') }}?tahun=${this.value}`;
            });
        }

        // 2. Logic Chart
        const canvas = document.getElementById('rekapChart');
        if (!canvas) return;

        const ctx = canvas.getContext('2d');
        const labels = @json($chartData['labels'] ?? []);
        const dataPemasukan = @json($chartData['pemasukan'] ?? []);
        const dataPengeluaran = @json($chartData['pengeluaran'] ?? []);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Masuk',
                        data: dataPemasukan,
                        backgroundColor: '#10b981',
                        borderRadius: 6,
                        maxBarThickness: 20
                    },
                    {
                        label: 'Keluar',
                        data: dataPengeluaran,
                        backgroundColor: '#f43f5e',
                        borderRadius: 6,
                        maxBarThickness: 20
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        callbacks: {
                            label: (ctx) => ` ${ctx.dataset.label}: Rp ${ctx.raw.toLocaleString('id-ID')}`
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#f1f5f9' },
                        ticks: {
                            font: { size: 10 },
                            callback: (val) => 'Rp ' + val.toLocaleString('id-ID')
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { size: 10, weight: '600' } }
                    }
                }
            }
        });
    });
</script>
@endpush