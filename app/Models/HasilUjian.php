<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilUjian extends Model
{
    // Karena nama tabel di DB adalah 'ujian'
    protected $table = 'ujian';

    protected $fillable = [
        'anggota_id', 
        'sabuk_diuji', 
        'tanggal_ujian', 
        'penguji', 
        'total_nilai', 
        'nilai_minimum', 
        'status'
    ];

    // Relasi ke tabel Anggota (untuk ambil Nama Lengkap, Jenis Kelamin, Usia, No Telp)
    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    // Relasi ke rincian nilai (tabel nilai_ujian)
    public function rincianNilai()
    {
        return $this->hasOne(NilaiUjian::class, 'ujian_id', 'id');
    }
}