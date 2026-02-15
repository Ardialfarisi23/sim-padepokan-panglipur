<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\HasilUjian;
use App\Models\NilaiUjian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UjianController extends Controller
{
public function index(Request $request)
{
    // Ambil input
    $tingkat = $request->get('tingkat', 'putih'); // Default putih
    $gender = $request->get('gender');
    $status = $request->get('status');
    $search = $request->get('search');

    $query = Anggota::query()->with(['riwayatUjian']);

    // Filter 1: Tingkat (WAJIB ADA)
    $query->where('tingkat', $tingkat);

    if ($request->filled('gender')) {
    $gender = $request->get('gender');
    
    // Logika agar fleksibel: jika input L cari juga yang laki_laki
    if ($gender === 'L') {
        $query->where(function($q) {
            $q->where('jenis_kelamin', 'L')->orWhere('jenis_kelamin', 'laki_laki');
        });
    } elseif ($gender === 'P') {
        $query->where(function($q) {
            $q->where('jenis_kelamin', 'P')->orWhere('jenis_kelamin', 'perempuan');
        });
    }
}

    // Filter 3: Search Nama
    if ($request->filled('search')) {
        $query->where('nama_lengkap', 'like', '%' . $search . '%');
    }

    // Filter 4: Status Kelulusan (Cek riwayat terakhir)
    if ($request->filled('status')) {
        if ($status === 'belum') {
            $query->whereDoesntHave('riwayatUjian');
        } else {
            $query->whereHas('riwayatUjian', function($q) use ($status) {
                // Ambil status dari riwayat terbaru
                $q->where('status', $status);
            });
        }
    }

    // Penting: withQueryString() agar filter nempel di link pagination
    $anggota = $query->paginate(10)->withQueryString();
    
    $daftarPelatih = \App\Models\Pelatih::orderBy('nama_lengkap', 'asc')->get();

    return view('admin.ujian.index', compact('anggota', 'daftarPelatih'));
}

    public function update(Request $request, $anggota_id)
{
    $fields = ['teknik_dasar', 'jurus_wajib', 'jurus_tambahan', 'seni', 'tanding', 'fisik', 'mental_sikap', 'teori'];
    
    $request->validate(array_merge(
        array_fill_keys($fields, 'required|numeric|min:0|max:100'),
        ['penguji' => 'required', 'sabuk_diuji' => 'required']
    ));

    DB::beginTransaction();
    try {
        $anggota = Anggota::findOrFail($anggota_id);
        
        $totalNilai = 0;
        foreach ($fields as $field) { $totalNilai += $request->$field; }
        
        $nilaiMin = $request->nilai_minimum ?? 600;
        $status = ($totalNilai >= $nilaiMin) ? 'lulus' : 'tidak';

        $periode = "Periode " . now()->format('M Y');

        // 1. Simpan Riwayat Ujian
        $ujian = HasilUjian::updateOrCreate(
    [
        'anggota_id'  => $anggota_id,
        'sabuk_diuji' => $request->sabuk_diuji, // Ini harus 'hijau' jika dia sedang ujian hijau
    ],
            [
                'tanggal_ujian' => $request->tanggal_ujian ?? now(),
                'penguji'       => $request->penguji,
                'total_nilai'   => $totalNilai,
                'nilai_minimum' => $nilaiMin,
                'status'        => $status,
                'periode'       => $periode
            ]
        );

        NilaiUjian::updateOrCreate(['ujian_id' => $ujian->id], $request->only($fields));

        // 2. LOGIKA KRUSIAL: Update Tingkat Anggota HANYA JIKA LULUS
        // Di dalam UjianController@update
if ($status === 'lulus') {
    $anggota->update(['tingkat' => $request->sabuk_diuji]);
}
// Jika 'tidak', biarkan saja, anggota tidak naik tingkat.
        // Jika 'tidak lulus', tingkat anggota TIDAK berubah (tetap di tingkat lama)

        DB::commit();
        return redirect()->back()->with('success', 'Data berhasil diproses!');
        
    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->with('error', 'Gagal: ' . $e->getMessage());
    }
}
}