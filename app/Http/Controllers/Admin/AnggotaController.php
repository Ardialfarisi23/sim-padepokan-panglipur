<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota; 

class AnggotaController extends Controller
{
    public function index(Request $request)
{
    $query = Anggota::query();

    // 1. Search Nama Lengkap
    if ($request->filled('search')) {
        $query->where('nama_lengkap', 'like', '%' . $request->search . '%');
    }

    // 2. Filter Jenis Kelamin
    if ($request->filled('jenis_kelamin')) {
        $query->where('jenis_kelamin', $request->jenis_kelamin);
    }

    // 3. Filter Tingkat
    if ($request->filled('tingkat')) {
        $query->where('tingkat', $request->tingkat);
    }

    // 4. Filter Usia (Logika Tanggal Lahir)
    if ($request->filled('usia')) {
        $usia = $request->usia;
        if ($usia == 'anak') {
            $query->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) < 15');
        } elseif ($usia == 'remaja') {
            $query->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 15 AND 25');
        } elseif ($usia == 'dewasa') {
            $query->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) > 25');
        }
    }

    // Ambil data dengan pagination (10 data)
    $anggota = $query->with(['hasilUjian' => function($q) {
        $q->orderBy('tanggal_ujian', 'desc');
    }, 'hasilUjian.rincianNilai'])->paginate(10);

    return view('admin.anggota.index', compact('anggota'));
}

public function update(Request $request, $id)
{
    // 1. Validasi Input
    $request->validate([
        'nama_lengkap'  => 'required|string|max:255',
        'tempat_lahir'  => 'required|string',
        'tanggal_lahir' => 'required|date',
        'tingkat'       => 'required|in:putih,kuning,hijau,merah,hitam',
        'jenis_kelamin' => 'required|in:laki_laki,perempuan',
        'email'         => 'nullable|email',
        'no_telepon'    => 'nullable|string|max:20',
        'alamat'        => 'nullable|string',
    ]);

    try {
        // 2. Cari data anggota
        $anggota = Anggota::findOrFail($id);

        // 3. Update data
        $anggota->update([
            'nama_lengkap'  => $request->nama_lengkap,
            'tempat_lahir'  => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tingkat'       => $request->tingkat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'email'         => $request->email,
            'no_telepon'    => $request->no_telepon,
            'alamat'        => $request->alamat,
        ]);

        // 4. Redirect dengan pesan sukses (akan memicu Toast yang kita buat tadi)
        return redirect()->route('admin.anggota.index')->with('success', 'Data anggota berhasil diperbarui!');

    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}

public function destroy($id)
{
    try {
        $anggota = Anggota::findOrFail($id);
        $anggota->delete();

        // Mengirimkan flash message sukses
        return redirect()->route('admin.anggota.index')
                         ->with('success', 'Data anggota berhasil dihapus.');
    } catch (\Exception $e) {
        return redirect()->route('admin.anggota.index')
                         ->with('error', 'Gagal menghapus data.');
    }
}


}