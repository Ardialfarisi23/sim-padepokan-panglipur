<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class VerifikasiController extends Controller
{
    /**
     * Menampilkan daftar calon anggota yang statusnya masih pending.
     */
    public function index()
    {
        $pendaftar = Pendaftaran::where('status', 'pending')
                    ->latest()
                    ->get();

        return view('admin.verifikasi.index', compact('pendaftar'));
    }

    /**
     * Proses verifikasi: Buat User, Buat Anggota, Hapus Data Pendaftaran.
     */
    public function konfirmasi($id)
    {
        $calon = Pendaftaran::findOrFail($id);

        try {
            DB::transaction(function () use ($calon) {
                // 1. Buat Akun User
                // Username diambil dari nama (format slug), password: nama+123
                $username = Str::slug($calon->nama_lengkap, ''); // asep-sunandar jadi asepsunandar
                $passwordPlain = strtolower($username) . '123';

                $user = User::create([
                    'username' => $username,
                    'email'    => $calon->email,
                    'password' => Hash::make($passwordPlain),
                    'role'     => 'anggota',
                ]);

                // 2. Buat Data Anggota
                Anggota::create([
                    'user_id'       => $user->id,
                    'nama_lengkap'  => $calon->nama_lengkap,
                    'tempat_lahir'  => $calon->tempat_lahir,
                    'tanggal_lahir' => $calon->tanggal_lahir,
                    'jenis_kelamin' => $calon->jenis_kelamin,
                    'alamat'        => $calon->alamat,
                    'no_telepon'    => $calon->no_telepon,
                    'email'         => $calon->email,
                    'status'        => 'aktif',
                    'tingkat'       => 'putih', // Default untuk anggota baru
                ]);

                // 3. Update status pendaftaran atau hapus
                // Di sini kita pilih hapus karena sudah sah jadi anggota
                $calon->delete();
            });

            $username = Str::slug($calon->nama_lengkap, '');
$passwordPlain = strtolower($username) . '123';

return redirect()->route('admin.verifikasi.index')
    ->with('success', "Verifikasi Berhasil! Username: <b>{$username}</b> | Password: <b>{$passwordPlain}</b>");

        } catch (\Exception $e) {
            return redirect()->back()
                             ->with('error', 'Gagal memverifikasi: ' . $e->getMessage());
        }
    }

    /**
     * Menolak pendaftaran (Hapus data pendaftaran).
     */
    public function tolak($id)
    {
        try {
            $calon = Pendaftaran::findOrFail($id);
            $calon->delete();

            return redirect()->route('admin.verifikasi.index')
                             ->with('success', 'Pendaftaran telah ditolak dan data dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()
                             ->with('error', 'Gagal menghapus data pendaftaran.');
        }
    }
}