<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Seragam;
use App\Models\SeragamOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembelianSeragamController extends Controller
{
    /**
     * Menampilkan halaman utama seragam
     * Berisi riwayat pesanan dan form pengajuan
     */
    public function index()
    {
        // 1. Ambil data anggota yang sedang login
        $anggota = Auth::user()->anggota;

        // 2. Ambil riwayat pesanan seragam milik anggota ini
        // Menggunakan latest() agar pesanan terbaru muncul di paling atas
        $riwayatOrders = SeragamOrder::where('anggota_id', $anggota->id)
                                     ->latest()
                                     ->get();

        // 3. Ambil daftar ukuran dari tabel stok (untuk pilihan di dropdown)
        $stokSeragam = Seragam::all();

        return view('anggota.seragam.index', compact('riwayatOrders', 'stokSeragam', 'anggota'));
    }

    /**
     * Menyimpan pengajuan pembelian seragam baru
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'ukuran' => 'required|string',
            'jumlah' => 'required|integer|min:1',
            'harga'  => 'required|integer', // Harga satuan yang dikirim dari JS
        ], [
            'ukuran.required' => 'Silakan pilih ukuran seragam.',
            'jumlah.min'      => 'Jumlah minimal pembelian adalah 1.',
        ]);

        // Simpan ke database
        SeragamOrder::create([
            'anggota_id' => Auth::user()->anggota->id,
            'ukuran'     => $request->ukuran,
            'jumlah'     => $request->jumlah,
            'harga'      => $request->harga * $request->jumlah, // Total harga (Satuan x Jumlah)
            'status'     => 'menunggu', // Status awal default
        ]);

        // Redirect dengan flash message sukses
        return redirect()->route('anggota.seragam.index')
                         ->with('success', 'Pengajuan pembelian seragam berhasil dikirim! Silakan tunggu konfirmasi admin.');
    }
}