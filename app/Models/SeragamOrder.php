<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeragamOrder extends Model
{
    protected $table = 'seragam_orders';

    protected $fillable = [
        'anggota_id', 
        'ukuran', 
        'jumlah', 
        'harga', 
        'status'
    ];

    public function anggota() {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }
}