@extends('anggota.layouts.anggota')

@push('styles')
    @vite(['resources/css/anggota/pages/seragam-page.css'])
@endpush

@section('content')

<div id="toast-container" class="toast-container">
    @if(session('success'))
        <div class="toast-item success animate-slide-in">
            <span class="material-symbols-rounded">check_circle</span>
            <div class="toast-content">
                <p class="toast-message">{{ session('success') }}</p>
            </div>
            <button class="toast-close" onclick="this.parentElement.remove()">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>
    @endif
</div>

<div class="pg-seragam-wrapper">
    <div class="pg-header-section">
        <h2 class="pg-title">Pembelian Seragam</h2>
        <p class="pg-subtitle">Kelola pengajuan dan pantau status pemesanan seragam Anda.</p>
    </div>

    <div class="content-card">
        <div class="card-header">
            <span class="material-symbols-rounded icon-bg-blue">history</span>
            <h3>Riwayat Pesanan</h3>
        </div>
        <div class="table-responsive">
            @include('anggota.seragam.partials.table-riwayat')
        </div>
    </div>

    <div class="content-card">
        <div class="card-header">
            <span class="material-symbols-rounded icon-bg-green">shopping_cart_checkout</span>
            <div class="header-text">
                <h3>Form Pembelian</h3>
                <p>Isi detail ukuran dan jumlah untuk melakukan pemesanan baru.</p>
            </div>
        </div>
        @include('anggota.seragam.partials.form-pembelian')
    </div>
</div>
@endsection
@push('scripts')
@vite(['resources/js/anggota/seragam-index.js'])
@endpush
