<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;

class PendaftaranController extends Controller
{
    /**
     * Tampilkan halaman pendaftaran
     */
    
    public function index()
    {
        return view('pages.pendaftaran.index');
    }

    /**
     * Simpan data pendaftaran
     */
    public function store(Request $request)
{
    $request->validate([
        'nama'           => 'required|string|max:100',
        'tempat_lahir'   => 'required|string|max:100',
        'tanggal_lahir'  => 'required|date',
        'jenis_kelamin'  => 'required|in:Laki-laki,Perempuan', // Validasi enum
        'alamat'         => 'nullable|string',
        'email'          => 'nullable|email|max:255',
        'no_hp'          => 'nullable|string|max:20',
    ]);

    // Mapping input form ke kolom database
    Pendaftaran::create([
        'nama_lengkap'   => $request->nama,
        'tempat_lahir'   => $request->tempat_lahir,
        'tanggal_lahir'  => $request->tanggal_lahir,
        // Konversi input ke format ENUM database jika perlu
        'jenis_kelamin'  => $request->jenis_kelamin == 'Laki-laki' ? 'laki_laki' : 'perempuan',
        'alamat'         => $request->alamat,
        'email'          => $request->email,
        'no_telepon'     => $request->no_hp,
        'status'         => 'pending', // Default value
    ]);

    return redirect()
        ->route('pendaftaran.index')
        ->with('success', 'Pendaftaran berhasil dikirim! Data Anda sedang dalam proses verifikasi.');
}

    
}
