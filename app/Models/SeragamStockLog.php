<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeragamStockLog extends Model
{
    protected $table = 'seragam_stock_logs';
    protected $fillable = ['seragam_id', 'tipe', 'jumlah', 'keterangan'];

    public function seragam()
    {
        return $this->belongsTo(Seragam::class, 'seragam_id');
    }
}