<?php

namespace App\Http\Controllers\staf;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class ArsipditolaksController extends Controller
{
    public function index()
    {
        $data = Peminjaman::where('status', 'ditolak')->with(['user', 'barang', 'transportasi', 'ruangan'])->orderBy('idpeminjaman', 'desc')->get();

        return view('staf.arsiptolak', compact('data'));
    }
    public function detail($id)
    {
        // Mengambil data peminjaman berdasarkan ID dengan relasi peminjaman, barang, transportasi, dan ruangan
        $peminjaman = Peminjaman::where('idpeminjaman', $id)->with(['user', 'barang', 'transportasi', 'ruangan'])->first();

        // Memastikan data peminjaman ditemukan
        if (!$peminjaman) {
            return redirect()->route('staf.arsiptolak.index')->withErrors('Data tidak ditemukan.');
        }

        // Menampilkan view detail peminjaman dengan data yang diperlukan
        return view('staf.arsiptolak.detailarsips', compact('peminjaman'));
    }
}
