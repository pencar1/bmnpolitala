<?php

namespace App\Http\Controllers\peminjam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\Validator;

class BarangpController extends Controller
{
    public function index()
    {
        $data = Barang::get();
        return view('peminjam.barang', compact('data'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string|max:255',
        ]);

        $query = $request->input('query');
        $barang = Barang::where('namabarang', 'like', "%$query%")
                        ->orWhere('deskripsibarang', 'like', "%$query%")
                        ->get();

        return view('peminjam.barang', ['data' => $barang]);
    }
}
