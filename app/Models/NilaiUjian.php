<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiUjian extends Model
{
    protected $table = 'nilai_ujian';

    protected $fillable = [
        'ujian_id', 'teknik_dasar', 'jurus_wajib', 
        'jurus_tambahan', 'seni', 'tanding', 
        'fisik', 'mental_sikap', 'teori'
    ];

    public function ujian()
    {
        return $this->belongsTo(HasilUjian::class, 'ujian_id');
    }
}