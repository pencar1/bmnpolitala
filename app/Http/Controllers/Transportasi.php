<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Transportasi extends Controller
{
    public function transportasi(){
        return view('admin/transportasi');
    }
}
