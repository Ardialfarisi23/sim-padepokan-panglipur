<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logistik;

class LogistikController extends Controller
{
    /**
     * Menampilkan daftar barang logistik dengan fitur Search & Filter.
     */
    public function index(Request $request)
    {
        $query = Logistik::query();

        // 1. Search Nama Barang
        if ($request->filled('search')) {
            $query->where('nama_barang', 'like', '%' . $request->search . '%');
        }

        // 2. Filter Kondisi (Baik/Rusak)
        if ($request->filled('kondisi')) {
            $query->where('kondisi', $request->kondisi);
        }

        $logistik = $query->latest()->paginate(10)->appends($request->all());

        return view('admin.logistik.index', compact('logistik'));
    }

    /**
     * Menyimpan barang baru (Fitur Tambah Data).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jumlah'      => 'required|integer|min:0',
            'satuan'      => 'required|string|max:50',
            'kondisi'     => 'required|in:baik,rusak',
        ]);

        try {
            Logistik::create($validated);
            return redirect()->route('admin.logistik.index')
                             ->with('success', 'Barang berhasil ditambahkan ke inventaris!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambah barang.');
        }
    }

    /**
     * Memperbarui data barang.
     */
    public function update(Request $request, $id)
    {
        $barang = Logistik::findOrFail($id);

        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jumlah'      => 'required|integer|min:0',
            'satuan'      => 'required|string|max:50',
            'kondisi'     => 'required|in:baik,rusak',
        ]);

        try {
            $barang->update($validated);
            return redirect()->route('admin.logistik.index')
                             ->with('success', 'Data barang berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data.');
        }
    }

    /**
     * Menghapus barang dari sistem.
     */
    public function destroy($id)
    {
        try {
            Logistik::findOrFail($id)->delete();
            return redirect()->route('admin.logistik.index')
                             ->with('success', 'Barang telah dihapus dari sistem.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus barang.');
        }
    }
}