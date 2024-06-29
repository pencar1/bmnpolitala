<?php

namespace App\Http\Controllers\peminjam;

use App\Http\Controllers\Controller;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RuanganpController extends Controller
{
    public function index(Request $request)
    {
        $data = Ruangan::where('stokruangan', '>', 0)->get();

        $detailRuangan = null;

        if ($request->has('lihat')) {
            $detailRuangan = Ruangan::find($request->input('lihat'));
        }

        return view('peminjam.ruangan', compact('data', 'detailRuangan'));
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

