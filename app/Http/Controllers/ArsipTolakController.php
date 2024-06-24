<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\User;

class ArsipTolakController extends Controller
{
    public function index()
    {
        $data = Peminjaman::where('status', 'ditolak')->with(['user', 'barang', 'transportasi', 'ruangan'])->orderBy('idpeminjaman', 'desc')->get();

        return view('admin.arsiptolak', compact('data'));
    }
    public function detail($id)
    {
        // Mengambil data peminjaman berdasarkan ID dengan relasi peminjaman, barang, transportasi, dan ruangan
        $peminjaman = Peminjaman::where('idpeminjaman', $id)->with(['user', 'barang', 'transportasi', 'ruangan'])->first();

        // Memastikan data peminjaman ditemukan
        if (!$peminjaman) {
            return redirect()->route('admin.arsiptolak.index')->withErrors('Data tidak ditemukan.');
        }

        // Menampilkan view detail peminjaman dengan data yang diperlukan
        return view('admin.arsiptolak.detailarsip', compact('peminjaman'));
    }
}
