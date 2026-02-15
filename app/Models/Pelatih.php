<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelatih extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan oleh model ini.
     * Karena tabel Anda bernama 'pelatih' (singular), Laravel perlu ditegaskan.
     */
    protected $table = 'pelatih';

    /**
     * Atribut yang dapat diisi secara massal (Mass Assignable).
     * Pastikan semua kolom di tabel SQL Anda ada di sini agar bisa disimpan via form.
     */
    protected $fillable = [
        'email',
        'nama_lengkap',
        'jenis_kelamin',
        'tingkat',
        'usia',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'no_telepon'
    ];

    /**
     * Jika Anda ingin mengaktifkan fitur otomatis pengolahan tanggal.
     */
    protected $dates = ['tanggal_lahir'];
}