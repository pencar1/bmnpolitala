<?php

namespace App\Http\Controllers\peminjam;

use App\Http\Controllers\Controller;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RuanganpController extends Controller
{
    public function index()
    {
        $data = Ruangan::get();
        return view('peminjam.ruangan', compact('data'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string|max:255',
        ]);

        $query = $request->input('query');
        $ruangan = Ruangan::where('namaruangan', 'like', "%$query%")
                        ->orWhere('deskripsiruangan', 'like', "%$query%")
                        ->get();

        return view('peminjam.ruangan', ['data' => $ruangan]);
    }
}

