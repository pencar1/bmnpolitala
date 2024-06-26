<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Barang;
use App\Models\Transportasi;
use App\Models\Ruangan;

class PengembalianController extends Controller
{
    public function index()
    {
        $data = Peminjaman::where('status', 'dikembalikan')->with(['user', 'barang', 'transportasi', 'ruangan'])->orderBy('idpeminjaman', 'desc')->get();

        return view('admin.pengembalian', compact('data'));
    }

    public function detail($id)
    {
        // Mengambil data peminjaman berdasarkan ID dengan relasi peminjaman, barang, transportasi, ruangan, dan pengembalian
        $peminjaman = Peminjaman::with(['user', 'barang', 'transportasi', 'ruangan', 'pengembalian'])->find($id);
        
        // Jika tidak menemukan data peminjaman
        if (!$peminjaman) {
            return redirect()->route('admin.peminjaman')->withErrors('Data tidak ditemukan.');
        }
        
        // Menampilkan view detail peminjaman dengan data yang diperlukan
        return view('admin.pengembalian.detailkembali', compact('peminjaman'));
    }


}
