<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Anggota\DashboardController as AnggotaDashboard;
use App\Http\Controllers\{
    LandingController,
    PendaftaranController,
    SejarahController,
    InformasiController
};




/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', [LandingController::class, 'index'])->name('landing');


Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');


Route::get('/sejarah', [SejarahController::class, 'show'])->name('sejarah.show');


Route::get('/informasi', [InformasiController::class, 'index'])->name('informasi.index');
Route::get('/informasi/{slug}', [InformasiController::class, 'show'])->name('informasi.show');




Route::middleware(['auth', 'role:anggota'])
    ->prefix('anggota')
    ->name('anggota.')
    ->group(function () {


        Route::get('/dashboard', [AnggotaDashboard::class, 'index'])
            ->name('dashboard');


    });


/*
|--------------------------------------------------------------------------
| AUTH ROUTES (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
