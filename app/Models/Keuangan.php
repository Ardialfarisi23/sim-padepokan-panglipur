<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    protected $table = 'keuangan';
    protected $fillable = [
        'periode_bulan', 'periode_tahun', 'saldo_awal', 
        'total_pemasukan', 'total_pengeluaran', 'saldo_akhir'
    ];

    public function pemasukan() {
        return $this->hasMany(Pemasukan::class, 'keuangan_id');
    }

    public function pengeluaran() {
        return $this->hasMany(Pengeluaran::class, 'keuangan_id');
    }
}