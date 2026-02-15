<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\HasilUjian;
use App\Models\NilaiUjian;
use App\Models\Seragam;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $anggota = $user->anggota;
        

        // 1. LOGIKA AGENDA & KALENDER
        // Ambil bulan & tahun dari request (jika klik nav kalender) atau gunakan saat ini
        $month = $request->get('month', date('n'));
        $year = $request->get('year', date('Y'));

        // Ambil agenda sesuai bulan dan tahun
        $agenda = Jadwal::whereMonth('tanggal', $month)
                    ->whereYear('tanggal', $year)
                    ->orderBy('tanggal', 'asc')
                    ->get();

    if ($request->ajax()) {
        $date = Carbon::create($year, $month, 1);
        
        return response()->json([
            'month_name'    => $date->translatedFormat('F Y'),
            'days_in_month' => $date->daysInMonth,
            'first_day'     => $date->dayOfWeekIso, // Gunakan dayOfWeekIso agar Senin=1, Minggu=7
            'agenda'        => $agenda,
            'html'          => view('anggota.dashboard.partials.agenda-list', compact('agenda'))->render()
        ]);
    }

    // 2. AMBIL DATA UJIAN
    $riwayatUjian = $anggota 
        ? $anggota->hasilUjian()->take(5)->get() 
        : collect([]);

    // 3. DATA SERAGAM (Gunakan Model SeragamOrder, bukan Seragam)
    // Karena di tabel seragam_orders ada kolom anggota_id
    $seragamSaya = $anggota 
    ? \App\Models\SeragamOrder::where('anggota_id', $anggota->id)
        ->latest()
        ->get() 
    : collect([]);

    $stats = [
        'sabuk' => $anggota->tingkat ?? 'Putih',
        'total_ujian' => $anggota ? $anggota->hasilUjian()->count() : 0,
        'ujian_terakhir' => $anggota ? $anggota->hasilUjian()->first() : null
    ];

        // Warning jika profil kosong
        if (!$anggota) {
            session()->now('warning', 'Silakan lengkapi profil Anda agar bisa mengakses fitur lengkap.');
        }

        return view('anggota.dashboard.index', compact('seragamSaya', 'riwayatUjian', 'agenda', 'stats'));
    }

    
}