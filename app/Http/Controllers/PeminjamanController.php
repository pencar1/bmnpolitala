<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\User;
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

        $jenisaset = $request->input('jenisaset');
        $asetId = $request->input('aset');
        $jumlah = $request->input('jumlahaset');

        if ($jenisaset === 'barang') {
            $barang = Barang::find($asetId);
            if ($barang && $barang->kurangiStokb($jumlah)) {
                $peminjaman->idbarang = $asetId;
            } else {
                return redirect()->back()->withInput()->withErrors(['jumlahaset' => 'Stok barang tidak mencukupi.']);
            }
        } elseif ($jenisaset === 'transportasi') {
            $transportasi = Transportasi::find($asetId);
            if ($transportasi && $transportasi->kurangiStokt($jumlah)) {
                $peminjaman->idtransportasi = $asetId;
            } else {
                return redirect()->back()->withInput()->withErrors(['jumlahaset' => 'Stok transportasi tidak mencukupi.']);
            }
        } elseif ($jenisaset === 'ruangan') {
            $ruangan = Ruangan::find($asetId);
            if ($ruangan && $ruangan->stok >= $jumlah) {
                $ruangan->stokruangan -= $jumlah;
                $ruangan->save();
                $peminjaman->idruangan = $asetId;
            } else {
                return redirect()->back()->withInput()->withErrors(['jumlahaset' => 'Stok ruangan tidak mencukupi.']);
            }
        }

        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('lampiran'), $filename);
            $peminjaman->lampiran = $filename;
        }

        $peminjaman->jumlahaset = $jumlah;

        $peminjaman->save();

        return redirect()->route('admin.peminjaman');
    }


    public function edit($id)
    {
        $data = Peminjaman::with(['barang', 'transportasi', 'ruangan'])->find($id);
        if (!$data) {
            return redirect()->route('admin.peminjaman')->withErrors('Data tidak ditemukan.');
        }

        $jenisAset = $data->getJenisAset();
        $namaAset = $data->getAsetName();

        return view('admin.peminjaman.editp', compact('data', 'jenisAset', 'namaAset'));
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tanggalpeminjaman' => 'required|date',
            'lampiran'          => 'nullable|mimes:jpeg,png,jpg,gif,pdf,docx|max:2048',
            'jumlahaset'        => 'required|integer|min:1',
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
        $jumlahBaru = $request->input('jumlahaset');
        $jumlahLama = $peminjaman->jumlahaset;

        if ($jenisaset === 'barang') {
            $barang = Barang::find($asetId);
            if ($barang) {
                $stokTersedia = $barang->stokbarang + $jumlahLama;
                if ($stokTersedia >= $jumlahBaru) {
                    $barang->tambahStokb($jumlahLama);
                    $barang->kurangiStokb($jumlahBaru);
                    $peminjaman->idbarang = $asetId;
                } else {
                    return redirect()->back()->withInput()->withErrors(['jumlahaset' => 'Stok barang tidak mencukupi.']);
                }
            } else {
                return redirect()->back()->withInput()->withErrors(['jumlahaset' => 'Barang tidak ditemukan.']);
            }
        } elseif ($jenisaset === 'transportasi') {
            $transportasi = Transportasi::find($asetId);
            $stokTersedia = $transportasi->stoktransportasi + $jumlahLama;
            if ($transportasi && $stokTersedia >= $jumlahBaru) {
                $transportasi->tambahStokt($jumlahLama);
                $transportasi->kurangiStokt($jumlahBaru);
                $peminjaman->idtransportasi = $asetId;
            } else {
                return redirect()->back()->withInput()->withErrors(['jumlahaset' => 'Stok barang tidak mencukupi.']);
            }
        } elseif ($jenisaset === 'ruangan') {
            $ruangan = Ruangan::find($asetId);
            $stokTersedia = $ruangan->stokruangan + $jumlahLama;
            if ($ruangan && $stokTersedia >= $jumlahBaru) {
                $ruangan->tambahStokt($jumlahLama);
                $ruangan->kurangiStokt($jumlahBaru);
                $peminjaman->idruangan = $asetId;
            } else {
                return redirect()->back()->withInput()->withErrors(['jumlahaset' => 'Stok barang tidak mencukupi.']);
            }
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

        $peminjaman->jumlahaset = $jumlahBaru;
        $peminjaman->save();

        return redirect()->route('admin.peminjaman')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::find($id);
        if ($peminjaman) {
            // Mendapatkan jenis aset yang terkait dengan peminjaman
            $jenisaset = null;
            if ($peminjaman->idbarang) {
                $jenisaset = 'barang';
            } elseif ($peminjaman->idtransportasi) {
                $jenisaset = 'transportasi';
            } elseif ($peminjaman->idruangan) {
                $jenisaset = 'ruangan';
            }

            // Mengembalikan stok aset yang terkait dengan peminjaman yang akan dihapus
            if ($jenisaset === 'barang') {
                $barang = Barang::find($peminjaman->idbarang);
                if ($barang) {
                    $barang->tambahStokb($peminjaman->jumlahaset);
                    $barang->save();
                }
            } elseif ($jenisaset === 'transportasi') {
                $transportasi = Transportasi::find($peminjaman->idtransportasi);
                if ($transportasi) {
                    $transportasi->tambahStokt($peminjaman->jumlahaset);
                    $transportasi->save();
                }
            } elseif ($jenisaset === 'ruangan') {
                $ruangan = Ruangan::find($peminjaman->idruangan);
                if ($ruangan) {
                    $ruangan->stokruangan += $peminjaman->jumlahaset;
                    $ruangan->save();
                }
            }

            // Hapus peminjaman
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
