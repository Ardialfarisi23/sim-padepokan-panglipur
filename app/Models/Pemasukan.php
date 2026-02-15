<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    protected $table = 'pemasukan';
    protected $fillable = ['keuangan_id', 'tanggal', 'sumber', 'metode', 'nominal', 'keterangan'];

    public function keuangan() {
        return $this->belongsTo(Keuangan::class);
    }
}