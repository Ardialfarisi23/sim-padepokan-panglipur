<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Informasi;


class InformasiController extends Controller
{
    public function index()
    {
        return view('partials.section_informasi');
    }

    public function show($slug)
{
    $informasi = Informasi::where('slug', $slug)->firstOrFail();

    $informasi_lainnya = Informasi::latest()
        ->where('id', '!=', $informasi->id)
        ->take(5)
        ->get();

    return view('pages.informasi.show', compact(
        'informasi',
        'informasi_lainnya'
    ));
}
}
