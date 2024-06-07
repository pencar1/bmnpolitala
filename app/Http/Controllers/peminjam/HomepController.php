<?php

namespace App\Http\Controllers\peminjam;

use App\Http\Controllers\Controller; // Tambahkan ini
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class HomepController extends Controller
{
    public function dashboard(){
        return view('dashboardp');
    }
}
