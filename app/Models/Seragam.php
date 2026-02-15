<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seragam extends Model
{
    // FIX: Harus menunjuk ke tabel stok, bukan orders
    protected $table = 'seragam';

    protected $fillable = [
        'ukuran',
        'stok',
    ];

    public function logs()
    {
        return $this->hasMany(SeragamStockLog::class, 'seragam_id');
    }
}