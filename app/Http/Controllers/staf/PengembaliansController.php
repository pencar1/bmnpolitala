<?php

namespace App\Http\Controllers\staf;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;

class PengembaliansController extends Controller
{
    public function index()
    {
        $data = Peminjaman::where('status', 'dikembalikan')->with(['user', 'barang', 'transportasi', 'ruangan'])->orderBy('idpeminjaman', 'desc')->get();

        return view('staf.pengembalian', compact('data'));
    }

    public function detail($id)
    {
        // Mengambil data peminjaman berdasarkan ID dengan relasi peminjaman, barang, transportasi, ruangan, dan pengembalian
        $peminjaman = Peminjaman::with(['user', 'barang', 'transportasi', 'ruangan', 'pengembalian'])->find($id);

        // Jika tidak menemukan data peminjaman
        if (!$peminjaman) {
            return redirect()->route('staf.peminjaman')->withErrors('Data tidak ditemukan.');
        }

        // Menampilkan view detail peminjaman dengan data yang diperlukan
        return view('staf.pengembalian.detailkembalis', compact('peminjaman'));
    }
}
