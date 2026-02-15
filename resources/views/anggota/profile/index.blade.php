@extends('anggota.layouts.anggota')

@section('title', 'Profil Saya - Laskar Panglipur')

@push('styles')
    @vite(['resources/css/anggota/profile-page.css'])
@endpush

@section('content')
<div class="dashboard-wrapper"> {{-- Gunakan wrapper agar margin konsisten dengan dashboard --}}
    <h1 class="anggota-dashboard-main-title">Pengaturan Profil</h1>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm" style="background: #d4edda; color: #155724; padding: 15px; border-radius: 12px; margin-bottom: 20px;">
            <span class="material-symbols-rounded" style="vertical-align: middle; margin-right: 8px;">check_circle</span>
            {{ session('success') }}
        </div>
    @endif

    <div class="profile-container">
        <form action="{{ route('anggota.profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="profile-grid">
                {{-- Bagian Kiri: Kartu Statis --}}
                <div class="profile-sidebar">
    <div class="profile-card-static">
        <div class="profile-icon-header">
            <span class="material-symbols-rounded">person_pin</span>
        </div>
        
        <h3 class="profile-name-display">{{ $anggota->nama_lengkap }}</h3>
        <span class="badge-belt belt-{{ strtolower($anggota->tingkat) }}">
            Sabuk {{ ucfirst($anggota->tingkat) }}
        </span>
        
        <div class="sidebar-divider"></div>
        
        <div class="readonly-info">
            <div class="info-item">
                <label>Username</label>
                <p>{{ $user->username }}</p>
            </div>
            <div class="info-item">
                <label>Email Akun</label>
                <p>{{ $user->email }}</p>
            </div>
            <div class="info-item">
                <label>Status Anggota</label>
                <p class="status-active">Aktif</p>
            </div>
        </div>
    </div>
</div>

                {{-- Bagian Kanan: Form Edit --}}
                <div class="profile-main-form">
                    <div class="form-card">
                        <h4 class="form-title">
                            <span class="material-symbols-rounded" style="vertical-align: middle;">edit_note</span>
                            Informasi Pribadi
                        </h4>
                        <div class="input-grid">
                            <div class="input-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" value="{{ $anggota->nama_lengkap }}" required>
                            </div>
                            <div class="input-group">
                                <label>Jenis Kelamin</label>
                                <select name="jenis_kelamin">
                                    <option value="laki_laki" {{ $anggota->jenis_kelamin == 'laki_laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="perempuan" {{ $anggota->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="input-group">
                                <label>Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" value="{{ $anggota->tempat_lahir }}">
                            </div>
                            <div class="input-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" value="{{ $anggota->tanggal_lahir ? $anggota->tanggal_lahir->format('Y-m-d') : '' }}">
                            </div>
                            <div class="input-group full-width">
                                <label>Nomor Telepon</label>
                                <input type="text" name="no_telepon" value="{{ $anggota->no_telepon }}" placeholder="08xxxxxxxxxx">
                            </div>
                            <div class="input-group full-width">
                                <label>Alamat Lengkap</label>
                                <textarea name="alamat" rows="3" placeholder="Masukkan alamat lengkap sesuai KTP...">{{ $anggota->alamat }}</textarea>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn-save">
                                <span class="material-symbols-rounded" style="vertical-align: middle; font-size: 20px;">save</span>
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection