<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keuangan;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class KeuanganController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->get('bulan', now()->month);
        $tahun = $request->get('tahun', now()->year);

        $rekap = Keuangan::where('periode_bulan', $bulan)
                         ->where('periode_tahun', $tahun)
                         ->first();

        if (!$rekap) {
            $rekap = new Keuangan([
                'periode_bulan' => $bulan,
                'periode_tahun' => $tahun,
                'saldo_awal' => 0,
                'total_pemasukan' => 0,
                'total_pengeluaran' => 0,
                'saldo_akhir' => 0
            ]);
        }

        // Saldo paling akhir dari bulan terakhir yang ada di sistem
        $saldoTerbaru = Keuangan::orderBy('periode_tahun', 'desc')
                                ->orderBy('periode_bulan', 'desc')
                                ->value('saldo_akhir') ?? 0;

        if ($request->ajax()) {
            return $this->handleAjaxRequest($rekap, $request->get('type', 'pemasukan'));
        }

        return view('admin.keuangan.index', compact('rekap', 'bulan', 'tahun', 'saldoTerbaru'));
    }

    private function getOrCreateRekap($bulan, $tahun)
    {
        $rekap = Keuangan::where('periode_bulan', $bulan)
                        ->where('periode_tahun', $tahun)
                        ->first();

        if (!$rekap) {
            $prevDate = Carbon::create($tahun, $bulan, 1)->subMonth();
            $prevRekap = Keuangan::where('periode_bulan', $prevDate->month)
                                ->where('periode_tahun', $prevDate->year)
                                ->first();

            $saldoAwal = $prevRekap ? $prevRekap->saldo_akhir : 0;

            $rekap = Keuangan::create([
                'periode_bulan' => $bulan,
                'periode_tahun' => $tahun,
                'saldo_awal' => $saldoAwal,
                'total_pemasukan' => 0,
                'total_pengeluaran' => 0,
                'saldo_akhir' => $saldoAwal,
            ]);
        }

        return $rekap;
    }

    private function handleAjaxRequest($rekap, $type)
    {
        if ($type === 'pemasukan') {
            $data = Pemasukan::where('keuangan_id', $rekap->id)->latest()->get();
            $view = view('admin.keuangan.partials.table-pemasukan', compact('data'))->render();
        } else {
            $data = Pengeluaran::where('keuangan_id', $rekap->id)->latest()->get();
            $view = view('admin.keuangan.partials.table-pengeluaran', compact('data'))->render();
        }

        // Ambil saldo paling update dari bulan terakhir yang tercatat di DB
        $saldoGlobal = Keuangan::orderBy('periode_tahun', 'desc')
                                ->orderBy('periode_bulan', 'desc')
                                ->value('saldo_akhir') ?? 0;

        return response()->json([
            'html' => $view,
            'saldo_global' => number_format($saldoGlobal, 0, ',', '.'),
            'rekap_bulanan' => [
                'total_pemasukan' => number_format($rekap->total_pemasukan, 0, ',', '.'),
                'total_pengeluaran' => number_format($rekap->total_pengeluaran, 0, ',', '.')
            ]
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'sumber_keperluan' => 'required|string|max:255',
            'metode' => 'required|in:Cash,Transfer,Qris',
            'nominal' => 'required|numeric|min:0',
            'type' => 'required|in:pemasukan,pengeluaran'
        ]);

        return DB::transaction(function () use ($request) {
            $date = Carbon::parse($request->tanggal);
            $rekap = $this->getOrCreateRekap($date->month, $date->year);

            if ($request->type === 'pemasukan') {
                Pemasukan::create([
                    'keuangan_id' => $rekap->id,
                    'tanggal' => $request->tanggal,
                    'sumber' => $request->sumber_keperluan,
                    'metode' => $request->metode,
                    'nominal' => $request->nominal,
                ]);
                $rekap->increment('total_pemasukan', $request->nominal);
            } else {
                Pengeluaran::create([
                    'keuangan_id' => $rekap->id,
                    'tanggal' => $request->tanggal,
                    'keperluan' => $request->sumber_keperluan,
                    'metode' => $request->metode,
                    'nominal' => $request->nominal,
                ]);
                $rekap->increment('total_pengeluaran', $request->nominal);
            }

            $rekap->saldo_akhir = $rekap->saldo_awal + $rekap->total_pemasukan - $rekap->total_pengeluaran;
            $rekap->save();

            // Efek domino ke bulan-bulan berikutnya
            $this->sinkronkanSaldoKeDepan($date->month, $date->year);

            return response()->json([
                'status' => 'success',
                'message' => 'Transaksi berhasil disimpan!'
            ]);
        });
    }

    public function edit($id)
    {
        $data = Pemasukan::find($id) ?? Pengeluaran::find($id);
        if (!$data) return response()->json(['message' => 'Data tidak ditemukan'], 404);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'sumber_keperluan' => 'required|string|max:255',
            'metode' => 'required|in:Cash,Transfer,Qris',
            'nominal' => 'required|numeric',
            'type' => 'required|in:pemasukan,pengeluaran'
        ]);

        return DB::transaction(function () use ($request, $id) {
            $data = ($request->type === 'pemasukan') ? Pemasukan::findOrFail($id) : Pengeluaran::findOrFail($id);
            $rekap = Keuangan::findOrFail($data->keuangan_id);

            // Revert nilai lama
            if ($request->type === 'pemasukan') {
                $rekap->decrement('total_pemasukan', $data->nominal);
            } else {
                $rekap->decrement('total_pengeluaran', $data->nominal);
            }

            // Update data baru
            $data->update([
                'tanggal' => $request->tanggal,
                ($request->type === 'pemasukan' ? 'sumber' : 'keperluan') => $request->sumber_keperluan,
                'metode' => $request->metode,
                'nominal' => $request->nominal,
            ]);

            // Apply nilai baru
            if ($request->type === 'pemasukan') {
                $rekap->increment('total_pemasukan', $request->nominal);
            } else {
                $rekap->increment('total_pengeluaran', $request->nominal);
            }

            $rekap->saldo_akhir = $rekap->saldo_awal + $rekap->total_pemasukan - $rekap->total_pengeluaran;
            $rekap->save();

            // Efek domino
            $date = Carbon::parse($request->tanggal);
            $this->sinkronkanSaldoKeDepan($date->month, $date->year);

            return response()->json(['status' => 'success', 'message' => 'Data berhasil diperbarui!']);
        });
    }

    public function destroy(Request $request, $id)
    {
        $type = $request->get('type');
        
        return DB::transaction(function () use ($id, $type) {
            $data = ($type === 'pemasukan') ? Pemasukan::findOrFail($id) : Pengeluaran::findOrFail($id);
            $rekap = Keuangan::findOrFail($data->keuangan_id);

            if ($type === 'pemasukan') {
                $rekap->decrement('total_pemasukan', $data->nominal);
            } else {
                $rekap->decrement('total_pengeluaran', $data->nominal);
            }

            $rekap->saldo_akhir = $rekap->saldo_awal + $rekap->total_pemasukan - $rekap->total_pengeluaran;
            $rekap->save();

            $date = Carbon::parse($data->tanggal);
            $data->delete();

            // Efek domino
            $this->sinkronkanSaldoKeDepan($date->month, $date->year);

            return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus!']);
        });
    }

    /**
     * Logika Sinkronisasi Saldo Berantai
     */
    private function sinkronkanSaldoKeDepan($bulan, $tahun)
    {
        // Ambil semua rekap dari bulan yang diedit sampai masa depan
        $rekaps = Keuangan::where(function($q) use ($tahun, $bulan) {
                    $q->where('periode_tahun', '>', $tahun)
                      ->orWhere(function($q2) use ($tahun, $bulan) {
                          $q2->where('periode_tahun', $tahun)
                             ->where('periode_bulan', '>=', $bulan);
                      });
                })
                ->orderBy('periode_tahun', 'asc')
                ->orderBy('periode_bulan', 'asc')
                ->get();

        foreach ($rekaps as $r) {
            // Cari saldo akhir bulan sebelumnya untuk menjadi saldo awal bulan ini
            $currentDate = Carbon::create($r->periode_tahun, $r->periode_bulan, 1);
            $prevDate = $currentDate->subMonth();
            
            $prevRekap = Keuangan::where('periode_bulan', $prevDate->month)
                                ->where('periode_tahun', $prevDate->year)
                                ->first();
            
            $r->saldo_awal = $prevRekap ? $prevRekap->saldo_akhir : 0;
            $r->saldo_akhir = $r->saldo_awal + $r->total_pemasukan - $r->total_pengeluaran;
            $r->save();
        }
    }

    // Tambahkan ini di dalam class KeuanganController sebelum penutup "}"

public function rekap(Request $request)
{
    $tahunDipilih = $request->get('tahun', now()->year);

    $allRekap = Keuangan::where('periode_tahun', $tahunDipilih)
                        ->orderBy('periode_bulan', 'asc') // Urutkan dari Januari
                        ->get();

    // Persiapkan data untuk Chart
    $chartData = [
        'labels' => [],
        'pemasukan' => [],
        'pengeluaran' => []
    ];

    foreach ($allRekap as $r) {
        $chartData['labels'][] = Carbon::create()->month($r->periode_bulan)->translatedFormat('F');
        $chartData['pemasukan'][] = $r->total_pemasukan;
        $chartData['pengeluaran'][] = $r->total_pengeluaran;
    }

    $totalKas = Keuangan::orderBy('periode_tahun', 'desc')
                        ->orderBy('periode_bulan', 'desc')
                        ->value('saldo_akhir') ?? 0;

    return view('admin.keuangan.rekap', compact('allRekap', 'totalKas', 'tahunDipilih', 'chartData'));
}

// Cari bagian ini di KeuanganController.php
public function show(Request $request, $id) // Tambahkan Request $request di sini
{
    if ($id === 'rekap') {
        return $this->rekap($request); // Kirimkan $request ke fungsi rekap
    }
    abort(404);
}
}