<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Pengembalian extends Controller
{
    public function pengembalian(){
        return view('admin/pengembalian');
    }
}
