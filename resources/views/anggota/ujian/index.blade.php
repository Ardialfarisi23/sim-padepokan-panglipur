@extends('anggota.layouts.anggota')

@push('styles')
    @vite(['resources/css/anggota/pages/ujian-page.css'])
@endpush

@section('content')
<div class="pg-ujian-wrapper">
    <div class="pg-header">
        <h2 class="pg-title">Hasil Ujian</h2>
        
        <div class="filter-section">
            <select id="selectSabuk" class="form-select-custom">
                <option value="" selected disabled>Pilih Sabuk</option>
                @foreach($daftarSabuk as $sabuk)
                    <option value="{{ $sabuk }}">Sabuk {{ ucfirst($sabuk) }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div id="resultContent" style="display: none;">
        <div class="ujian-summary-card">
            <div class="summary-item">
                <span class="label">Tanggal Ujian</span>
                <p id="tglUjian" class="value"></p>
            </div>
            <div class="divider"></div>
            <div class="summary-item">
                <span class="label">Penguji Utama</span>
                <p id="namaPenguji" class="value"></p>
            </div>
        </div>

        <div class="nilai-table-container">
            <table class="nilai-table">
                <thead>
                    <tr>
                        <th>Aspek Penilaian</th>
                        <th class="text-center">Nilai</th>
                    </tr>
                </thead>
                <tbody id="tableBodyNilai">
                    </tbody>
            </table>
        </div>

        <div class="result-footer">
            <div class="score-summary">
                <div class="score-box min-box">
                    <label>Nilai Minimum</label>
                    <span id="minNilai"></span>
                </div>
                <div class="score-box total-box">
                    <label>Total Nilai</label>
                    <span id="totalNilai"></span>
                </div>
            </div>
            
            <div id="statusBadge" class="status-lulus-badge"></div>
        </div>
    </div>

    <div id="emptyStateUjian" class="empty-state">
        <span class="material-symbols-rounded">analytics</span>
        <p>Silakan pilih sabuk untuk melihat hasil ujian.</p>
    </div>
</div>
@endsection
@push('scripts')
@vite(['resources/js/anggota/ujian-index.js'])
@endpush