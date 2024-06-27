<?php

namespace App\Http\Controllers\peminjam;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Barang;
use App\Models\Transportasi;
use App\Models\Ruangan;
use App\Models\Peminjaman;

class ArsipditolakpController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $data = Peminjaman::with(['user', 'barang', 'transportasi', 'ruangan'])
            ->where('status', 'ditolak')
            ->where('iduser', $userId)
            ->where(function ($query) {
                $query->whereNotNull('idbarang')
                    ->orWhereNotNull('idtransportasi')
                    ->orWhereNotNull('idruangan');
            })
            ->get();

        return view('peminjam.arsipditolak', compact('data'));
    }

    public function detail($id)
    {
        // Mengambil data peminjaman berdasarkan ID dengan relasi peminjaman, barang, transportasi, dan ruangan
        $peminjaman = Peminjaman::where('idpeminjaman', $id)->with(['user', 'barang', 'transportasi', 'ruangan'])->first();

        // Memastikan data peminjaman ditemukan
        if (!$peminjaman) {
            return redirect()->route('peminjam.arsipditolak.index')->withErrors('Data tidak ditemukan.');
        }

        // Menampilkan view detail peminjaman dengan data yang diperlukan
        return view('peminjam.arsipditolak.detailarsip', compact('peminjaman'));
    }
}
