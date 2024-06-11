<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Barang;
use App\Models\Transportasi;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PeminjamanController extends Controller
{
    public function index()
    {
        $data = Peminjaman::with(['user', 'barang', 'transportasi', 'ruangan'])->get();
        return view('admin.peminjaman', compact('data'));
    }
    public function tambahpeminjaman(Request $request)
    {
        $barangs = Barang::all();
        $transportasis = Transportasi::all();
        $ruangans = Ruangan::all();

        // Kirim semua aset ke view
        return view('admin.peminjaman.tambahp', compact('barangs', 'transportasis', 'ruangans'));
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


    public function edit($id)
    {
        $data = Peminjaman::find($id);
        if (!$data) {
            return redirect()->route('admin.peminjaman')->withErrors('Data tidak ditemukan.');
        }
        return view('admin.peminjaman.editp', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tanggalpeminjaman' => 'required|date',
            'lampiran'          => 'nullable|mimes:jpeg,png,jpg,gif,pdf,docx|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $peminjaman = Peminjaman::find($id);
        if (!$peminjaman) {
            return redirect()->route('admin.peminjaman')->withErrors('Data tidak ditemukan.');
        }

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
            if ($peminjaman->lampiran) {
                $old_file_path = public_path('lampiran/' . $peminjaman->lampiran);
                if (file_exists($old_file_path)) {
                    unlink($old_file_path);
                }
            }

            $file = $request->file('lampiran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('lampiran'), $filename);
            $peminjaman->lampiran = $filename;
        }

        $peminjaman->save();

        return redirect()->route('admin.peminjaman')->with('success', 'Data berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $peminjaman = Peminjaman::find($id);
        if ($peminjaman) {
            if ($peminjaman->lampiran) {
                $file_path = public_path('lampiran/' . $peminjaman->lampiran);
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            $peminjaman->delete();
        }

        return redirect()->route('admin.peminjaman')->with('success', 'Data berhasil dihapus.');
    }
}
