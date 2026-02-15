<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jadwal;
use Carbon\Carbon;

class JadwalController extends Controller
{
    /**
     * Menampilkan halaman utama jadwal.
     */
    public function index(Request $request)
{
    $month = $request->get('month', now()->month);
    $year = $request->get('year', now()->year);
    $date = Carbon::createFromDate($year, $month, 1);

    $agendas = Jadwal::whereMonth('tanggal', $month)
                    ->whereYear('tanggal', $year)
                    ->orderBy('tanggal', 'asc')
                    ->get();

    if ($request->ajax()) {
        return response()->json([
            'success'       => true,
            'agenda'        => $agendas,
            // Nanti kita buat partial khusus untuk list agenda di halaman Jadwal
            'html'          => view('admin.jadwal.partials.agenda-list', ['agendas' => $agendas])->render(),
            'month_name'    => $date->translatedFormat('F Y'),
            'days_in_month' => $date->daysInMonth,
            'first_day'     => $date->dayOfWeek, 
        ]);
    }

    return view('admin.jadwal.index', compact('agendas'));
}

    /**
     * Fungsi API untuk mengambil data jadwal (JSON).
     * Digunakan oleh JavaScript saat kalender berpindah bulan.
     */
    public function getEvents(Request $request)
    {
        $month = $request->query('month');
        $year = $request->query('year');

        $events = Jadwal::whereMonth('tanggal', $month)
                        ->whereYear('tanggal', $year)
                        ->get();

        return response()->json($events);
    }

    /**
     * Menyimpan jadwal baru.
     */
    public function store(Request $request)
{
    $request->validate([
        'tanggal'    => 'required|date',
        'agenda'     => 'required|string|max:255',
        'lokasi'     => 'required|string|max:255',
        'status'     => 'required|in:latihan,nasional,internasional,lainnya',
        'keterangan' => 'nullable|string',
    ], [
        'tanggal.required' => 'Pilih tanggal pada kalender terlebih dahulu!',
    ]);

    try {
        Jadwal::create($request->all());
        return redirect()->route('admin.jadwal.index')
                         ->with('success', 'Jadwal berhasil ditambahkan!');
    } catch (\Exception $e) {
        return redirect()->back()
                         ->with('error', 'Gagal menyimpan jadwal. Silakan coba lagi.');
    }
}

    /**
     * Memperbarui jadwal yang ada.
     */
    public function update(Request $request, $id)
{
    $jadwal = Jadwal::findOrFail($id);
    
    $validated = $request->validate([
        'tanggal'    => 'required|date',
        'agenda'     => 'required|string|max:255',
        'lokasi'     => 'required|string|max:255',
        'status'     => 'required|in:latihan,nasional,internasional,lainnya',
        'keterangan' => 'nullable|string',
    ]);

    try {
        $jadwal->update($validated);
        return redirect()->route('admin.jadwal.index')
                         ->with('success', 'Jadwal berhasil diperbarui!');
    } catch (\Exception $e) {
        return redirect()->back()
                         ->with('error', 'Gagal memperbarui jadwal.');
    }
}

    /**
     * Menghapus jadwal.
     */
    public function destroy($id)
{
    try {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        // Karena kita akan memanggil ini via form submit atau AJAX, 
        // kita kembalikan redirect dengan session success
        return redirect()->back()->with('success', 'Jadwal berhasil dihapus!');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Gagal menghapus jadwal.');
    }
}

public function edit($id)
{
    $jadwal = Jadwal::findOrFail($id);
    
    // Kita kembalikan sebagai JSON agar bisa ditangkap oleh fetch() di JS
    return response()->json($jadwal);
}

    }