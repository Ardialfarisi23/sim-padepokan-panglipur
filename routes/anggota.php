<?php

use App\Http\Controllers\Anggota\DashboardController;
use App\Http\Controllers\Anggota\AnggotaJadwalController;
use App\Http\Controllers\Anggota\HasilUjianController; // Pastikan ini diimport!
use App\Http\Controllers\Anggota\PembelianSeragamController;
use App\Http\Controllers\Anggota\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:anggota'])
    ->prefix('anggota')
    ->name('anggota.') // Otomatis menambah prefix 'anggota.' pada semua name()
    ->group(function () {

        // 1. Dashboard Utama
        // Pastikan route dashboard ini ada karena dipanggil di sidebar
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // 2. Jadwal & Agenda
        Route::get('/jadwal', [AnggotaJadwalController::class, 'index'])->name('jadwal.index');

        // 3. Hasil Ujian
        // Route ini akan menjadi 'anggota.hasil-ujian.index'
        Route::get('/hasil-ujian', [HasilUjianController::class, 'index'])->name('hasil-ujian.index');
        
        // Route untuk AJAX detail (anggota.hasil-ujian.detail)
        Route::get('/hasil-ujian/detail/{sabuk}', [HasilUjianController::class, 'getDetail'])->name('hasil-ujian.detail');

        // 4. Pembelian Seragam
        Route::get('/seragam', [PembelianSeragamController::class, 'index'])->name('seragam.index');
        
        // Memproses pengajuan pembelian
        Route::post('/seragam/store', [PembelianSeragamController::class, 'store'])->name('seragam.store');
        // 5. Profile Anggota
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    });