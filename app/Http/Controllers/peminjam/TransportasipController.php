<?php

namespace App\Http\Controllers\peminjam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transportasi;
use Illuminate\Support\Facades\Validator;

class TransportasipController extends Controller
{
    public function index(Request $request)
    {
        $data = Transportasi::where('stoktransportasi', '>', 0)->get();

        $detailtransportasi = null;

        if ($request->has('lihat')) {
            $detailtransportasi = Transportasi::find($request->input('lihat'));
        }

        return view('peminjam.transportasi', compact('data', 'detailtransportasi'));
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
