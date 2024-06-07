<?php

namespace App\Http\Controllers\peminjam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transportasi;
use Illuminate\Support\Facades\Validator;

class TransportasiController extends Controller
{
    // public function transportasi(){
    //     return view('peminjam/transportasi');
    // }

    public function index()
    {
        $data = Transportasi::get();
        return view('peminjam.transportasi', compact('data'));
    }
}
