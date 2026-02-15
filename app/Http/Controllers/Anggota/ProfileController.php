<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $anggota = $user->anggota;
        return view('anggota.profile.index', compact('user', 'anggota'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $anggota = $user->anggota;

        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'required|date',
            'no_telepon'   => 'nullable|string|max:20',
            'alamat'       => 'nullable|string',
            'jenis_kelamin'=> 'required|in:laki_laki,perempuan',
        ]);

        $anggota->update($request->all());

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}