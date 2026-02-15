<?php
 
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AnggotaController;
use App\Http\Controllers\Admin\PelatihController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\KeuanganController;
use App\Http\Controllers\Admin\LogistikController;
use App\Http\Controllers\Admin\UjianController;
use App\Http\Controllers\Admin\SeragamController;
use App\Http\Controllers\Admin\VerifikasiController;



Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/agenda', [DashboardController::class, 'agendaByMonth'])->name('dashboard.agenda');

        // Resources (Otomatis mencakup GET index, POST store, PUT update, DELETE destroy)
        Route::resource('/anggota', AnggotaController::class);
        Route::resource('/pelatih', PelatihController::class);
        Route::resource('/jadwal', JadwalController::class);
        Route::resource('/logistik', LogistikController::class);
        Route::resource('/seragam', SeragamController::class);
        
        // UJIAN (Menggunakan resource agar standar)
        // Jika di view ingin tetap memanggil 'admin.hasil-ujian.update', kita bisa pakai 'names'
        Route::resource('/ujian', UjianController::class)->names([
            'index'  => 'ujian.index',
            'update' => 'ujian.update'
        ]);

        // KEUANGAN (Wajib Rekap di atas Resource)
        Route::get('/keuangan/rekap', [KeuanganController::class, 'rekap'])->name('keuangan.rekap');
        Route::post('/keuangan/store-transaksi', [KeuanganController::class, 'store'])->name('keuangan.store_ajax');
        Route::put('/keuangan/{id}/update', [KeuanganController::class, 'update'])->name('keuangan.update_ajax');
        Route::resource('/keuangan', KeuanganController::class);

        // Verifikasi
        Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi.index');
        Route::post('/verifikasi/{id}/terima', [VerifikasiController::class, 'terima'])->name('verifikasi.terima');
        Route::post('/verifikasi/{id}/tolak', [VerifikasiController::class, 'tolak'])->name('verifikasi.tolak');

        // Jadwal API & Extras
        Route::get('api/jadwal-events', [JadwalController::class, 'getEvents'])->name('jadwal.events');

        Route::prefix('seragam')->group(function () {
            // Halaman Utama
            Route::get('/', [SeragamController::class, 'index'])->name('seragam.index');
            
            // Proses Transaksi
            Route::post('/konfirmasi/{id}', [SeragamController::class, 'confirm'])->name('seragam.confirm');
            Route::post('/tolak/{id}', [SeragamController::class, 'reject'])->name('seragam.reject');
            Route::post('/update-status/{id}', [SeragamController::class, 'updateStatus'])->name('seragam.updateStatus');
            
            // Update Stok Manual
            Route::post('/update-stok', [SeragamController::class, 'updateStock'])->name('seragam.updateStock');
        });

        Route::controller(VerifikasiController::class)->group(function () {
        Route::get('/verifikasi', 'index')->name('verifikasi.index');
        Route::post('/verifikasi/{id}/konfirmasi', 'konfirmasi')->name('verifikasi.konfirmasi');
        Route::delete('/verifikasi/{id}/tolak', 'tolak')->name('verifikasi.tolak');
    });
    });