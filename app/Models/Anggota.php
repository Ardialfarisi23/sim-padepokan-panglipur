<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Anggota extends Model
{
    protected $table = 'anggota';


    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'no_telepon',
        'jenis_kelamin',
        'status',
        'email',
        'tingkat',
        'usia',
    ];


    protected $casts = [
        'tanggal_lahir' => 'date',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function seragamOrders()
{
    return $this->hasMany(SeragamOrder::class, 'anggota_id');
}

public function hasilUjian()
{
    // Gunakan hasMany karena satu anggota punya banyak riwayat ujian
    return $this->hasMany(HasilUjian::class, 'anggota_id', 'id')->orderBy('tanggal_ujian', 'desc');
}

/**
 * Helper untuk mendapatkan status ujian terakhir saja (untuk tabel utama)
 */
public function ujianTerakhir()
    {
        return $this->hasOne(HasilUjian::class, 'anggota_id', 'id')->latestOfMany();
    }

public function riwayatUjian()
{
    // Urutkan berdasarkan tanggal terbaru
    return $this->hasMany(HasilUjian::class, 'anggota_id')->orderBy('tanggal_ujian', 'desc');
}



}
