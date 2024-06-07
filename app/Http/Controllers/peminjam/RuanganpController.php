<?php

namespace App\Http\Controllers\peminjam;

use App\Http\Controllers\Controller;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RuanganpController extends Controller
{
    public function index()
    {
        $data = Ruangan::get();
        return view('peminjam.ruangan', compact('data'));
    }   
}

