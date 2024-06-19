<?php

namespace App\Http\Controllers\staf;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengembaliansController extends Controller
{
    public function index(){
        return view('staf/pengembalian');
    }
}
