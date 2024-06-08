<?php

namespace App\Http\Controllers\peminjam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transportasi;
use Illuminate\Support\Facades\Validator;

class TransportasipController extends Controller
{
    public function index()
    {
        $data = Transportasi::get();
        return view('peminjam.transportasi', compact('data'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string|max:255',
        ]);

        $query = $request->input('query');
        $transportasi = Transportasi::where('namatransportasi', 'like', "%$query%")
                        ->orWhere('deskripsitransportasi', 'like', "%$query%")
                        ->get();

        return view('peminjam.transportasi', ['data' => $transportasi]);
    }
}
