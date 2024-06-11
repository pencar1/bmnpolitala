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
    public function index()
    {
        $userId = Auth::id(); // Mengambil ID user yang sedang masuk
        $data = Peminjaman::with(['user', 'barang', 'transportasi'])
                          ->where('iduser', $userId) // Hanya mengambil peminjaman milik user yang sedang masuk
                          ->where(function ($query) {
                              $query->whereNotNull('idbarang')
                                    ->orWhereNotNull('idtransportasi');
                          })
                          ->get();
        return view('peminjam.peminjaman', compact('data'));
    }
    

    public function tambahpeminjamanbarang($idbarang = null)
    {
        $barangs = Barang::all();
        return view('peminjam.peminjamanp.pinjambarang', compact('barangs', 'idbarang'));
    }
    
    public function tambahPeminjamanTransportasi($idTransportasi = null)
    {
        $transportasis = Transportasi::all();
        return view('peminjam.peminjamanp.pinjamtransportasi', compact('transportasis', 'idTransportasi'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggalpeminjaman' => 'required|date',
            'lampiran'          => 'nullable|mimes:jpeg,png,jpg,gif,pdf,docx|max:2048',
            'aset'              => 'required',
            'jumlahaset'        => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $peminjaman = new Peminjaman();
        $user = Auth::user();
        $peminjaman->iduser = $user->id;
        $peminjaman->tanggalpeminjaman = $request->input('tanggalpeminjaman');
        $peminjaman->status = 'Dipinjam';
        $asetId = $request->input('aset');
        $jumlah = $request->input('jumlahaset');

        $barang = Barang::find($asetId);
        if ($barang && $barang->kurangiStokb($jumlah)) {
            $peminjaman->idbarang = $asetId;
        } else {
            return redirect()->back()->withInput()->withErrors(['jumlahaset' => 'Stok barang tidak mencukupi.']);
        }

        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('lampiran'), $filename);
            $peminjaman->lampiran = $filename;
        }

        $peminjaman->jumlahaset = $jumlah;
        $peminjaman->save();

        return redirect()->route('peminjam.peminjaman');
    }

    public function storetrans(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggalpeminjaman' => 'required|date',
            'lampiran'          => 'nullable|mimes:jpeg,png,jpg,gif,pdf,docx|max:2048',
            'aset'              => 'required',
            'jumlahaset'        => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $peminjaman = new Peminjaman();
        $user = Auth::user();
        $peminjaman->iduser = $user->id;
        $peminjaman->tanggalpeminjaman = $request->input('tanggalpeminjaman');
        $peminjaman->status = 'Dipinjam';
        $asetId = $request->input('aset');
        $jumlah = $request->input('jumlahaset');

        // Sesuaikan dengan model dan atribut transportasi Anda
        $transportasi = Transportasi::find($asetId);
        if ($transportasi && $transportasi->kurangiStokt($jumlah)) {
            $peminjaman->idtransportasi = $asetId;
        } else {
            return redirect()->back()->withInput()->withErrors(['jumlahaset' => 'Stok transportasi tidak mencukupi.']);
        }

        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('lampiran'), $filename);
            $peminjaman->lampiran = $filename;
        }

        $peminjaman->jumlahaset = $jumlah;
        $peminjaman->save();

        return redirect()->route('peminjam.peminjaman');
    }
}
