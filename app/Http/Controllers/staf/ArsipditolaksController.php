<?php

namespace App\Http\Controllers\staf;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArsipditolaksController extends Controller
{
    public function index(){
        return view('staf.arsiptolak');
    }
}
