<?php

namespace App\Http\Controllers\peminjam;

use App\Http\Controllers\Controller;
// use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PeminjamanpController extends Controller
{
    public function index(){
        return view('peminjam.peminjaman');
    }
}
