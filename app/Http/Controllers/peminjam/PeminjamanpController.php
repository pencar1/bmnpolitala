<?php

namespace App\Http\Controllers\peminjam;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Barang;
use App\Models\Transportasi;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PeminjamanpController extends Controller
{
    public function index(){
        return view('peminjam.peminjaman');
    }

    public function tambahpeminjamanbarang($idbarang = null)
    {
        $barangs = Barang::all();

        // Kirim semua barang dan idbarang yang dipilih ke view
        return view('peminjam.peminjamanp.pinjambarang', compact('barangs', 'idbarang'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggalpeminjaman' => 'required|date',
            'lampiran'          => 'nullable|mimes:jpeg,png,jpg,gif,pdf,docx|max:2048',
            'jenisaset'         => 'required|in:barang,transportasi,ruangan',
            'aset'              => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $peminjaman = new Peminjaman();
        $user = Auth::user();
        $peminjaman->iduser = $user->id;
        $peminjaman->tanggalpeminjaman = $request->input('tanggalpeminjaman');
        $peminjaman->status = 'Dipinjam';

        $jenisaset = $request->input('jenisaset');
        $asetId = $request->input('aset');

        if ($jenisaset === 'barang') {
            $peminjaman->idbarang = $asetId;
        } elseif ($jenisaset === 'transportasi') {
            $peminjaman->idtransportasi = $asetId;
        } elseif ($jenisaset === 'ruangan') {
            $peminjaman->idruangan = $asetId;
        }

        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('lampiran'), $filename);
            $peminjaman->lampiran = $filename;
        }

        $peminjaman->save();

        return redirect()->route('admin.peminjaman');
    }
}
