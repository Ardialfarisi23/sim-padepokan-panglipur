<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    // Pastikan mengarah ke nama tabel yang benar
    protected $table = 'verifikasi_pendaftaran';
    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    // Sesuaikan dengan nama kolom di database Anda
    protected $fillable = [
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'email',
        'no_telepon',
        'status',
    ];
}