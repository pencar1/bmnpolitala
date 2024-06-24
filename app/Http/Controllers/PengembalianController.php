<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\User;

class PengembalianController extends Controller
{
    public function index()
    {
        $data = Pengembalian::with('peminjaman', 'peminjaman.user')->get();
        return view('admin.pengembalian', compact('data'));
    }

    public function detail($id)
    {
        // Mengambil data pengembalian berdasarkan ID dengan relasi peminjaman, barang, transportasi, dan ruangan
        $pengembalian = Pengembalian::with(['peminjaman', 'barang', 'transportasi', 'ruangan'])->find($id);
        
        // Memastikan data pengembalian ditemukan
        if (!$pengembalian) {
            return redirect()->route('admin.pengembalian.index')->withErrors('Data tidak ditemukan.');
        }

        // Menampilkan view detail pengembalian dengan data yang diperlukan
        return view('admin.pengembalian.detailkembali', compact('pengembalian'));
    }

}
