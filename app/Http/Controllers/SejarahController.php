<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use App\Models\Prestasi;

class SejarahController extends Controller
{
 public function index()
    {
        $informasi = Informasi::latest()->take(5)->get();

        return view('landing.index', compact('informasi'));
    }

  public function show()
{
    $informasi = Informasi::latest()->take(6)->get();
    $prestasi  = Prestasi::latest()->take(9)->get();

    return view('pages.sejarah.show', compact('informasi', 'prestasi'));



}

}