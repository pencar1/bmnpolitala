<?php

namespace App\Http\Controllers\staf;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Barang;
use App\Models\Ruangan;
use App\Models\Transportasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class HomesController extends Controller
{

    public function dashboard(){
        $dataPeminjaman = Peminjaman::whereIn('status', ['diproses', 'disetujui'])->with(['user', 'barang', 'transportasi', 'ruangan'])->orderBy('idpeminjaman', 'desc')->get();

        $userCount = User::count();
        $barangCount = Barang::count();
        $ruanganCount = Ruangan::count();
        $transportasiCount = Transportasi::count();
        return view('dashboards', compact('userCount','barangCount','ruanganCount','transportasiCount','dataPeminjaman'));
    }

        public function editstp($id)
    {
        $data = Peminjaman::with(['barang', 'transportasi', 'ruangan'])->find($id);
        if (!$data) {
            return redirect()->route('staf.peminjaman')->withErrors('Data tidak ditemukan.');
        }

        $jenisAset = $data->getJenisAset();
        $namaAset = $data->getAsetName();

        return view('editstps', compact('data', 'jenisAset', 'namaAset'));
    }


    public function updatestp(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tanggalpeminjaman' => 'required|date',
            'lampiran'          => 'nullable|mimes:jpeg,png,jpg,gif,pdf,docx|max:2048',
            'jumlahaset'        => 'required|integer|min:1',
            'status'            => 'required|in:diproses,ditolak,disetujui,dipinjam',
            'alasanpenolakan'   => 'nullable|string|max:50',
            'jenisaset'         => 'required|in:barang,transportasi,ruangan',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $peminjaman = Peminjaman::find($id);
        if (!$peminjaman) {
            return redirect()->route('staf.peminjaman')->withErrors('Data tidak ditemukan.');
        }

        $peminjaman->tanggalpeminjaman = $request->input('tanggalpeminjaman');
        $peminjaman->status = $request->input('status');

        // Update alasanpenolakan only if the status is 'ditolak'
        if ($request->input('status') == 'ditolak') {
            $peminjaman->alasanpenolakan = $request->input('alasanpenolakan');
        } else {
            $peminjaman->alasanpenolakan = null;
        }

        // Jika status berubah menjadi 'dipinjam', kurangi jumlah aset dari stok
        if ($request->input('status') == 'dipinjam') {
            // Mendapatkan jenis aset yang terkait dengan peminjaman
            $jenisaset = null;
            if ($peminjaman->idbarang) {
                $jenisaset = 'barang';
            } elseif ($peminjaman->idtransportasi) {
                $jenisaset = 'transportasi';
            } elseif ($peminjaman->idruangan) {
                $jenisaset = 'ruangan';
            }

            // Mengurangi stok aset yang terkait dengan peminjaman yang dipinjam
            switch ($jenisaset) {
                case 'barang':
                    $barang = Barang::find($peminjaman->idbarang);
                    if ($barang) {
                        $barang->kurangiStokb($peminjaman->jumlahaset);
                    }
                    break;
                case 'transportasi':
                    $transportasi = Transportasi::find($peminjaman->idtransportasi);
                    if ($transportasi) {
                        $transportasi->kurangiStokt($peminjaman->jumlahaset);
                    }
                    break;
                case 'ruangan':
                    $ruangan = Ruangan::find($peminjaman->idruangan);
                    if ($ruangan) {
                        $ruangan->kurangiStokr($peminjaman->jumlahaset);
                    }
                    break;
                default:
                    break;
            }
        }

        // Handle lampiran file if exists
        if ($request->hasFile('lampiran')) {
            if ($peminjaman->lampiran) {
                $oldFilePath = public_path('lampiran/' . $peminjaman->lampiran);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            $lampiran = $request->file('lampiran');
            $lampiranName = time() . '_' . $lampiran->getClientOriginalName();
            $lampiran->move(public_path('lampiran'), $lampiranName);
            $peminjaman->lampiran = $lampiranName;
        }

        $peminjaman->jumlahaset = $request->input('jumlahaset');
        $peminjaman->save();

        return redirect()->route('staf.dashboard')->with('success', 'Data berhasil diperbarui.');
    }
}

