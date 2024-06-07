<?php

namespace App\Http\Controllers\peminjam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transportasi;
use Illuminate\Support\Facades\Validator;

class TransportasipController extends Controller
{
    public function index()
    {
        $data = Transportasi::get();
        return view('peminjam.transportasi', compact('data'));
    }
}
