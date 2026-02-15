@extends('admin.layouts.admin')

@vite(['resources/css/admin/ujian-page.css', 'resources/js/admin/ujian-index.js'])

@section('content')
<div class="pg-pelatih-wrapper">
    <div class="pg-pelatih-header">
        <h2 class="pg-pelatih-title">Hasil Ujian Anggota</h2>
    </div>

    <form action="{{ route('admin.ujian.index') }}" method="GET" id="filterForm">
        <div class="pg-pelatih-action-container">
            <div class="pg-pelatih-action-bar">
                {{-- Search --}}
                <div class="pg-pelatih-search-wrapper">
                    <span class="material-symbols-rounded">search</span>
                    <input type="text" name="search" placeholder="Cari nama anggota..." class="pg-pelatih-input-search" value="{{ request('search') }}">
                </div>

                <div class="d-flex gap-2">
                    {{-- Select Tingkat (POIN REVISI 2) --}}
                    <div class="pg-pelatih-select-wrapper">
                        <select name="tingkat" class="pg-pelatih-select-belt" onchange="this.form.submit()">
                            @foreach(['putih', 'kuning', 'hijau', 'merah', 'hitam'] as $tkt)
                                <option value="{{ $tkt }}" {{ (request('tingkat') == $tkt || (!request('tingkat') && $tkt == 'putih')) ? 'selected' : '' }}>
                                    Sabuk {{ ucfirst($tkt) }}
                                </option>
                            @endforeach
                        </select>
                        <span class="material-symbols-rounded select-arrow">expand_more</span>
                    </div>

                    {{-- Toggle Filter --}}
                    <button type="button" class="pg-pelatih-btn-filter-toggle" id="toggleFilterBtn">
                        <span class="material-symbols-rounded">tune</span>
                        Filter
                        <span class="material-symbols-rounded" id="arrowIcon">expand_more</span>
                    </button>
                </div>
            </div>

            {{-- Filter Panel --}}
            <div class="pg-pelatih-filter-panel" id="filterPanel">
                <div class="pg-pelatih-filter-grid">
                    <div class="filter-group">
                        <label>Jenis Kelamin</label>
                        <select name="gender" onchange="this.form.submit()" class="form-select">
    <option value="">Semua</option>
    <option value="L" {{ request('gender') == 'L' ? 'selected' : '' }}>Laki-laki</option>
    <option value="P" {{ request('gender') == 'P' ? 'selected' : '' }}>Perempuan</option>
</select>
                    </div>
                    <div class="filter-group">
                        <label>Status Kelulusan</label>
                        <select name="status" onchange="this.form.submit()" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="lulus" {{ request('status') == 'lulus' ? 'selected' : '' }}>Lulus</option>
                            <option value="tidak" {{ request('status') == 'tidak' ? 'selected' : '' }}>Tidak Lulus</option>
                            <option value="belum" {{ request('status') == 'belum' ? 'selected' : '' }}>Belum Dinilai</option>
                        </select>
                    </div>
                    <div class="filter-actions d-flex align-items-end">
                        <a href="{{ route('admin.ujian.index') }}" class="btn-reset-filter">
                            <span class="material-symbols-rounded">restart_alt</span> Reset
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="pg-pelatih-table-scroll-container">
        <table class="pg-pelatih-table">
            <thead>
                <tr>
                    <th>Nama Lengkap</th>
                    <th>Gender</th>
                    <th>Tingkat Saat Ini</th>
                    <th>Sabuk Diuji</th>
                    <th>Tanggal Ujian</th>
                    <th>Penguji</th>
                    <th>Total Nilai</th>
                    <th>Status Ujian</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($anggota as $a)
                  @php 
    $filterTingkat = request('tingkat', 'putih');
    $levels = ['putih', 'kuning', 'hijau', 'merah', 'hitam'];
    $currentIndex = array_search($filterTingkat, $levels);
    
    // Tentukan target ujian berikutnya
    $targetUjian = ($currentIndex !== false && isset($levels[$currentIndex + 1])) 
                   ? $levels[$currentIndex + 1] 
                   : null;

    // AMBIL HASIL: Cari ujian yang 'sabuk_diuji'-nya adalah target tingkat berikutnya
    $hasil = $a->riwayatUjian->where('sabuk_diuji', $targetUjian)->first(); 
@endphp
                    <tr>
                        <td class="fw-bold text-dark">{{ $a->nama_lengkap }}</td>
                        <td class="text-center">
    @if(in_array(strtolower($a->jenis_kelamin), ['l', 'laki_laki']))
        Laki-laki
    @else
        Perempuan
    @endif
</td>
                        <td class="text-center">
                            <span class="badge-tingkat {{ $a->tingkat }}">{{ ucfirst($a->tingkat) }}</span>
                        </td>
                        <td class="text-center">
    @if($hasil)
        <span class="badge-tingkat {{ $hasil->sabuk_diuji }}">
            {{ ucfirst($hasil->sabuk_diuji) }}
        </span>
        {{-- Jika ini adalah ujian untuk tingkat selanjutnya, beri penanda teks saja, jangan di dalam badge --}}
        @if($hasil->sabuk_diuji != $filterTingkat)
            <div class="text-muted mt-1" style="font-size: 10px; font-weight: 500;">(Ujian Baru)</div>
        @endif
    @elseif($targetUjian)
        {{-- Tampilan saat belum ada data ujian sama sekali untuk tingkat selanjutnya --}}
        <span class="text-muted" style="font-size: 11px;">Target: {{ ucfirst($targetUjian) }}</span>
    @else
        <span class="text-muted">-</span>
    @endif
</td>                 <td class="text-center">{{ $hasil ? \Carbon\Carbon::parse($hasil->tanggal_ujian)->format('d/m/Y') : '-' }}</td>
                        <td class="text-center">{{ $hasil->penguji ?? '-' }}</td>
                        <td class="text-center">{{ $hasil?->total_nilai ?? '-' }}</td>
                        <td class="text-center">
                            <span class="status-badge {{ $hasil ? 'status-'.$hasil->status : 'status-belum' }}">
                                {{ $hasil ? strtoupper($hasil->status) : 'BELUM DINILAI' }}
                            </span>
                        </td>
                        <td class="text-center">
    <div class="d-flex justify-content-center">
        <button type="button" 
                class="btn-action-circle {{ $hasil ? 'btn-edit-mode' : 'btn-add-mode' }}" 
                data-bs-toggle="modal" 
                data-bs-target="#modalPenilaian{{ $a->id }}">
            <span class="material-symbols-rounded">
                {{ $hasil ? 'edit_square' : 'add_chart' }}
            </span>
        </button>
    </div>
</td>
                    </tr>
                @empty
                    <tr><td colspan="9" class="text-center py-5 text-muted">Data tidak ditemukan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($anggota->hasPages())
    <div class="pg-pelatih-pagination-area">
        <div class="pg-info">
            Menampilkan {{ $anggota->firstItem() }} - {{ $anggota->lastItem() }} dari {{ $anggota->total() }} Anggota
        </div>
        <div class="pg-links">
            {{ $anggota->links() }}
        </div>
    </div>
    @endif
</div>

{{-- MODAL LOAD --}}
@foreach($anggota as $a)
    @include('admin.ujian.modal-edit', [
        'anggota' => $a, 
        'u' => $a->hasilUjian // Ini bisa bernilai null, dan itu tidak apa-apa
    ])
@endforeach

@push('scripts')
<script>
    const toggleBtn = document.getElementById('toggleFilterBtn');
    if(toggleBtn) {
        toggleBtn.addEventListener('click', function() {
            const panel = document.getElementById('filterPanel');
            const arrow = document.getElementById('arrowIcon');
            panel.classList.toggle('active');
            this.classList.toggle('active');
            arrow.textContent = panel.classList.contains('active') ? 'expand_less' : 'expand_more';
        });
    }
</script>
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
@endpush
@endsection