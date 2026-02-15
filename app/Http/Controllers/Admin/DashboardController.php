<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keuangan;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Pendaftaran;
use App\Models\SeragamOrder;
use App\Models\Anggota;
use App\Models\Jadwal;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // 1. Tentukan Bulan & Tahun (Dinamis dari AJAX atau default sekarang)
        $month = $request->get('month', now()->month);
        $year = $request->get('year', now()->year);

        // 2. Buat objek Carbon untuk mendapatkan info kalender
        // Kita gunakan hari pertama di bulan tersebut
        $date = Carbon::createFromDate($year, $month, 1);

        // 3. Ambil data Agenda sesuai bulan & tahun pilihan
        $agenda = Jadwal::whereMonth('tanggal', $month)
                        ->whereYear('tanggal', $year)
                        ->orderBy('tanggal', 'asc')
                        ->get();

        // 4. Logika Jika Request Datang dari AJAX (JavaScript Kalender)
        if ($request->ajax()) {
            return response()->json([
                'success'       => true,
                'agenda'        => $agenda, // Data JSON untuk titik warna di kalender
                // Render view partial menjadi string HTML untuk list di kiri
                'html'          => view('admin.dashboard.partials.agenda-list', compact('agenda'))->render(),
                'month_name'    => $date->translatedFormat('F Y'),
                'days_in_month' => $date->daysInMonth,
                'first_day'     => $date->dayOfWeek, // 0 (Minggu) - 6 (Sabtu)
            ]);
        }

        // 5. Data untuk Load Halaman Pertama Kali (Bukan AJAX)
$bulanSekarang = now()->month;
$tahunSekarang = now()->year;

// 1. Ambil data rekap BULAN INI dari tabel keuangan
$rekapBulanIni = Keuangan::where('periode_bulan', $bulanSekarang)
                    ->where('periode_tahun', $tahunSekarang)
                    ->first();

// Jika data bulan ini belum ada (awal bulan), kita set 0 agar tidak error
$pemasukan   = $rekapBulanIni ? $rekapBulanIni->total_pemasukan : 0;
$pengeluaran = $rekapBulanIni ? $rekapBulanIni->total_pengeluaran : 0;

// 2. HITUNG TOTAL KAS (Seluruh Waktu)
// Cara paling akurat & cepat: Ambil saldo_akhir dari periode terbaru yang ada di database
$rekapTerbaru = Keuangan::orderBy('periode_tahun', 'desc')
                    ->orderBy('periode_bulan', 'desc')
                    ->first();

$kas = $rekapTerbaru ? $rekapTerbaru->saldo_akhir : 0;

        $pengajuanSeragam = SeragamOrder::with('anggota')
                    ->where('status', 'menunggu')
                    ->latest()
                    ->limit(4) 
                    ->get();


$totalSeragamBaru = SeragamOrder::where('status', 'menunggu')->count();

       $pendaftarBaru = Pendaftaran::where('status', 'pending')
                    ->latest()
                    ->limit(4)
                    ->get();

// Hitung total pendaftar yang butuh verifikasi untuk badge
$totalPendaftaranBaru = Pendaftaran::where('status', 'pending')->count();
        $totalAnggota = Anggota::where('status', 'aktif')->count();
        $anggota = Anggota::latest()->get(); 

        return view('admin.dashboard.index', compact(
            'agenda',
            'pemasukan',
            'pengeluaran',
            'kas',
            'pendaftarBaru',
            'totalPendaftaranBaru',
            'pengajuanSeragam',
            'totalSeragamBaru',
            'totalAnggota',
            'anggota'
        ));
    }
}