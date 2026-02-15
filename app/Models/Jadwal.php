<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Jadwal extends Model
{
    use HasFactory;

    /**
     * Nama tabel sesuai skema database.
     */
    protected $table = 'jadwal';

    /**
     * Kolom yang dapat diisi (Mass Assignable).
     */
    protected $fillable = [
        'tanggal',
        'lokasi',
        'agenda',
        'status',
        'keterangan'
    ];

    /**
     * Casting tipe data.
     * Mengonversi 'tanggal' menjadi objek Carbon agar mudah dimanipulasi (format tgl, nama bulan, dsb).
     */
    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Accessor untuk mendapatkan nama hari atau bulan dalam Bahasa Indonesia (Opsional namun berguna).
     */
    public function getFormattedTanggalAttribute()
    {
        return Carbon::parse($this->tanggal)->translatedFormat('d F Y');
    }

    /**
     * Scope untuk memfilter agenda berdasarkan bulan dan tahun tertentu.
     * Ini akan sangat berguna untuk fitur kalender dinamis kita nanti.
     */
    public function scopeInMonth($query, $month, $year)
    {
        return $query->whereMonth('tanggal', $month)
                     ->whereYear('tanggal', $year)
                     ->orderBy('tanggal', 'asc');
    }
}