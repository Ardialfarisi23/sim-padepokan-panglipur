<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AnggotaJadwalController extends Controller
{
    public function index(Request $request)
{
    $month = $request->get('month', date('m'));
    $year = $request->get('year', date('Y'));

    $agendas = Jadwal::inMonth($month, $year)->get();

    if ($request->ajax()) {
        $date = \Carbon\Carbon::createFromDate($year, $month, 1);
        
        return response()->json([
            'html' => view('anggota.jadwal.partials.agenda-list', compact('agendas'))->render(),
            'month_name' => $date->translatedFormat('F Y'),
            'days_in_month' => $date->daysInMonth,
            'first_day' => $date->dayOfWeekIso, // Senin=1, Minggu=7
            'agenda' => $agendas
        ]);
    }

    return view('anggota.jadwal.index', compact('agendas'));
}
}