@extends('anggota.layouts.anggota')

@section('title', 'Dashboard')

@section('content')
<div class="dashboard-wrapper">
    <div class="header-section mb-4">
        <h1 class="anggota-dashboard-main-title">Selamat Datang, {{ auth()->user()->username }}! 👋</h1>
        <p class="text-muted">Pantau jadwal agenda dan hasil ujian Anda di sini.</p>
    </div>

    @include('anggota.dashboard.partials.stats-cards')

    {{-- Baris 1: Jadwal & Agenda (Full Width) --}}
    <div class="dash-card">
        @include('anggota.dashboard.partials.agenda')
    </div>

    {{-- Baris 2: Hasil Ujian & Seragam (Berdampingan) --}}
    <div class="dash-row mt-4">
    {{-- Kolom Kiri: Hasil Ujian --}}
    <div class="dash-col">
        @include('anggota.dashboard.partials.ujian-card')
    </div>

    {{-- Kolom Kanan: Seragam --}}
    <div class="dash-col">
        @include('anggota.dashboard.partials.seragam-card')
    </div>
</div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/anggota/dashboard-agenda.js'])
@endpush