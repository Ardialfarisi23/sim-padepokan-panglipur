<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seragam; // Ini untuk Stok
use App\Models\SeragamOrder; // Ini untuk Pengajuan/Pesanan
use App\Models\SeragamStockLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeragamController extends Controller
{
    public function index()
    {
        // 1. Ambil stok
        $stok = Seragam::all()->keyBy('ukuran'); 
        
        // 2. Ambil pengajuan baru
        $pengajuan = SeragamOrder::with('anggota')
            ->where('status', 'menunggu')
            ->get();

        // 3. Ambil yang sedang diproses (Hapus variabel $queryProses yang bikin error)
        $proses = SeragamOrder::with('anggota')
            ->whereIn('status', ['diproses', 'siap diambil'])
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $riwayat = SeragamOrder::with('anggota')
            ->where('status', 'selesai')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.seragam.index', compact('stok', 'pengajuan', 'proses', 'riwayat'));
    }

    public function confirm($id)
    {
        // Pastikan nama model sesuai (SeragamOrder)
        $order = SeragamOrder::findOrFail($id);
        
        // Ambil stok berdasarkan ukuran di order tersebut
        $stokItem = Seragam::where('ukuran', $order->ukuran)->first();

        // Validasi: Apakah data stok ada dan cukup?
        if (!$stokItem || $stokItem->stok < $order->jumlah) {
            return redirect()->back()->with('error', 'Gagal! Stok ukuran ' . $order->ukuran . ' tidak mencukupi atau belum diinput.');
        }

        DB::transaction(function () use ($order, $stokItem) {
            // 1. Potong Stok
            $stokItem->decrement('stok', $order->jumlah);

            // 2. Ubah Status
            $order->update(['status' => 'diproses']);

            // 3. Catat Log (Opsional tapi bagus untuk QC)
            SeragamStockLog::create([
                'seragam_id' => $stokItem->id,
                'tipe' => 'keluar',
                'jumlah' => $order->jumlah,
                'keterangan' => 'Pesanan anggota: ' . $order->id
            ]);
        });

        return redirect()->route('admin.seragam.index')->with('success', 'Pesanan berhasil dikonfirmasi.');
    }

    public function reject($id)
    {
        $order = SeragamOrder::findOrFail($id);
        $order->delete(); 
        return back()->with('success', 'Pesanan telah ditolak dan dihapus.');
    }

    public function updateStatus(Request $request, $id)
    {
        $order = SeragamOrder::findOrFail($id);
        $order->update(['status' => $request->status]);

        return back()->with('success', 'Status diperbarui menjadi ' . $request->status);
    }

    public function updateStock(Request $request)
{
    $request->validate([
        'ukuran' => 'required',
        'jumlah' => 'required|integer|min:1'
    ]);

    return DB::transaction(function () use ($request) {
        // 1. Ambil data stok, jika tidak ada maka buat baru dengan stok awal 0
        $seragam = Seragam::firstOrCreate(
            ['ukuran' => $request->ukuran],
            ['stok' => 0]
        );

        // 2. Tambahkan jumlahnya (Ini jauh lebih aman dari error operand)
        $seragam->increment('stok', $request->jumlah);

        // 3. Catat Log
        SeragamStockLog::create([
            'seragam_id' => $seragam->id,
            'tipe' => 'masuk',
            'jumlah' => $request->jumlah,
            'keterangan' => 'Restock manual oleh Admin'
        ]);

        return back()->with('success', 'Stok ukuran ' . $request->ukuran . ' berhasil ditambah.');
    });
}
}