<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Ruangan;
use App\Models\Transportasi;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        $dataBarang = Barang::get();
        $dataRuangan = Ruangan::get();
        $dataTransportasi = Transportasi::get();
        $barangCount = Barang::count();
        $ruanganCount = Ruangan::count();
        $transportasiCount = Transportasi::count();
        return view('beranda', compact('dataBarang', 'dataRuangan', 'dataTransportasi', 'barangCount','ruanganCount','transportasiCount'));
    }
}
