<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Barang extends Controller
{
    public function barang(){
        return view('admin/barang');
    }
}
