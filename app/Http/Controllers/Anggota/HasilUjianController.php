<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\HasilUjian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HasilUjianController extends Controller
{
    public function index()
    {
        // Ambil riwayat sabuk yang pernah diuji oleh anggota ini untuk isi dropdown
        $daftarSabuk = HasilUjian::where('anggota_id', Auth::user()->anggota->id)
            ->pluck('sabuk_diuji')
            ->unique();

        return view('anggota.ujian.index', compact('daftarSabuk'));
    }

    public function getDetail($sabuk)
    {
        $data = HasilUjian::with('rincianNilai')
            ->where('anggota_id', Auth::user()->anggota->id)
            ->where('sabuk_diuji', $sabuk)
            ->first();

        if (!$data) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan']);
        }

        return response()->json(['success' => true, 'data' => $data]);
    }
}