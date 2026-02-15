<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelatih;
use Carbon\Carbon;

class PelatihController extends Controller
{
    /**
     * Menampilkan daftar pelatih dengan fitur Search & Filter.
     */
    public function index(Request $request)
    {
        $query = Pelatih::query();

        // 1. Search Nama Lengkap
        if ($request->filled('search')) {
            $query->where('nama_lengkap', 'like', '%' . $request->search . '%');
        }

        // 2. Filter Jenis Kelamin
        if ($request->filled('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        // 3. Filter Tingkat (Sesuai dropdown Merah, Hitam, dll)
        if ($request->filled('tingkat')) {
            $query->where('tingkat', $request->tingkat);
        }

        // 4. Filter Rentang Usia
        if ($request->filled('usia')) {
            $now = Carbon::now();
            if ($request->usia == 'muda') {
                // Usia di bawah 30 tahun
                $query->where('tanggal_lahir', '>', $now->copy()->subYears(30));
            } elseif ($request->usia == 'senior') {
                // Usia 30 sampai 50 tahun
                $query->whereBetween('tanggal_lahir', [
                    $now->copy()->subYears(50),
                    $now->copy()->subYears(30)
                ]);
            } elseif ($request->usia == 'master') {
                // Usia di atas 50 tahun
                $query->where('tanggal_lahir', '<', $now->copy()->subYears(50));
            }
        }

        // Ambil data dengan pagination dan pastikan parameter filter tetap ada di URL saat pindah halaman
        $pelatih = $query->latest()->paginate(10)->withQueryString();

        return view('admin.pelatih.index', compact('pelatih'));
    }

    /**
     * Menyimpan data pelatih baru (Fitur Tambah).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap'  => 'required|string|max:100',
            'email'         => 'required|email|unique:pelatih,email',
            'jenis_kelamin' => 'required|in:laki_laki,perempuan',
            'tingkat'       => 'required',
            'tempat_lahir'  => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'no_telepon'    => 'nullable|string|max:20',
            'alamat'        => 'nullable|string',
        ]);

        try {
            // Hitung usia otomatis sebelum simpan jika ada tanggal lahir
            if ($request->filled('tanggal_lahir')) {
                $validated['usia'] = Carbon::parse($request->tanggal_lahir)->age;
            }

            Pelatih::create($validated);

            return redirect()->route('admin.pelatih.index')
                             ->with('success', 'Pelatih baru berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()
                             ->with('error', 'Gagal menambah pelatih: ' . $e->getMessage());
        }
    }

    /**
     * Memperbarui data pelatih yang sudah ada.
     */
    public function update(Request $request, $id)
    {
        $pelatih = Pelatih::findOrFail($id);

        $validated = $request->validate([
            'nama_lengkap'  => 'required|string|max:100',
            'email'         => 'required|email|unique:pelatih,email,' . $id,
            'jenis_kelamin' => 'required|in:laki_laki,perempuan',
            'tingkat'       => 'required',
            'tempat_lahir'  => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'no_telepon'    => 'nullable|string|max:20',
            'alamat'        => 'nullable|string',
        ]);

        try {
            if ($request->filled('tanggal_lahir')) {
                $validated['usia'] = Carbon::parse($request->tanggal_lahir)->age;
            }

            $pelatih->update($validated);

            return redirect()->route('admin.pelatih.index')
                             ->with('success', 'Data pelatih berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()
                             ->with('error', 'Gagal memperbarui data.');
        }
    }

    /**
     * Menghapus data pelatih.
     */
    public function destroy($id)
    {
        try {
            Pelatih::findOrFail($id)->delete();
            return redirect()->route('admin.pelatih.index')
                             ->with('success', 'Data pelatih berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data.');
        }
    }
}