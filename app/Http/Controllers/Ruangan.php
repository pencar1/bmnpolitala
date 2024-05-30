<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Ruangan extends Controller
{
    public function ruangan(){
        return view('admin/ruangan');
    }
}
