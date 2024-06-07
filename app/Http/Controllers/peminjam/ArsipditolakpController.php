<?php

namespace App\Http\Controllers\peminjam;

use App\Http\Controllers\Controller;
// use App\Models\Arsipditolak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ArsipditolakpController extends Controller
{
    public function index(){
        return view('peminjam.arsipditolak');
    }
}
