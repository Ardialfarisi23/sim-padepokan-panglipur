<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logistik extends Model
{
    use HasFactory;

    /**
     * Nama tabel sesuai dengan database Anda.
     */
    protected $table = 'logistik';

    /**
     * Atribut yang dapat diisi secara massal (Mass Assignable).
     * Berdasarkan skema SQL: nama_barang, jumlah, satuan, kondisi.
     */
    protected $fillable = [
        'nama_barang',
        'jumlah',
        'satuan',
        'kondisi'
    ];

    /**
     * Casts untuk memastikan 'jumlah' selalu dibaca sebagai integer.
     */
    protected $casts = [
        'jumlah' => 'integer',
    ];
}