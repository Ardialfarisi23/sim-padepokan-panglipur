@extends('admin.layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="dashboard-wrapper">
    <h1 class="dashboard-main-title">Dashboard</h1>

    {{-- Baris 1: Agenda & Kalender --}}
    <div class="dashboard-row row-agenda">
        @include('admin.dashboard.partials.agenda')
    </div>

    {{-- Baris 2: Keuangan --}}
    <div class="dashboard-row row-keuangan">
        @include('admin.dashboard.partials.keuangan')
    </div>

    <div class="dashboard-container">
    <div class="dash-row">
        <div class="dash-col">
            @include('admin.dashboard.partials.seragam')
        </div>
        <div class="dash-col">
            @include('admin.dashboard.partials.verifikasi')
        </div>
    </div>

    <div class="dash-row">
        <div class="dash-col">
            @include('admin.dashboard.partials.anggota')
        </div>
        <div class="dash-col-empty">
            </div>
    </div>
</div>
</div>
@endsection