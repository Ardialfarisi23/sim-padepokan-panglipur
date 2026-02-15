<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $table = 'pengeluaran';
    protected $fillable = ['keuangan_id', 'tanggal', 'keperluan', 'metode', 'nominal', 'keterangan'];

    public function keuangan() {
        return $this->belongsTo(Keuangan::class);
    }
}