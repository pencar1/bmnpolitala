<?php

namespace App\Http\Controllers\peminjam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\Validator;

class BarangpController extends Controller
{
    public function index()
    {
        $data = Barang::get();
        return view('peminjam.barang', compact('data'));
    }
}
