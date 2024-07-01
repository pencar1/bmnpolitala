<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pengembalian;
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
        $data = Peminjaman::where('status', 'dipinjam')->with(['user', 'barang', 'transportasi', 'ruangan'])->orderBy('idpeminjaman', 'desc')->get();

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
            'nama'              => 'required|string|max:50',
            'nim'               => 'required|string|max:16',
            'tanggalpeminjaman' => 'required|date',
            'lampiran'          => 'nullable|mimes:jpeg,png,jpg,gif,pdf,docx|max:2048',
            'jenisaset'         => 'required|in:barang,transportasi,ruangan',
            'aset'              => 'required',
            'jumlahaset'        => 'required|integer|min:1',
        ], [
            'nama.required'                 => 'Nama harus diisi!',
            'nama.string'                   => 'Nama harus berupa teks!',
            'nama.max'                      => 'Nama maksimal 50 karakter!',
            'nim.required'                  => 'NIM harus diisi!',
            'nim.string'                    => 'NIM harus berupa angka!',
            'nim.max'                       => 'NIM maksimal 16 karakter!',
            'jenisaset.required'            => 'Jenis aset harus diisi!',
            'tanggalpeminjaman.required'    => 'Isi Tanggal Peminjaman!',
            'jumlahaset.required'           => 'Isi Jumlah Aset!',
            'lampiran.required'             => 'Lampiran Tidak Boleh Kosong!',
            'lampiran.image'                => 'Lampiran harus berupa gambar!',
            'lampiran.mimes'                => 'Lampiran gambar yang diperbolehkan: jpeg, png, jpg, gif, pdf, docx!',
            'lampiran.max'                  => 'Ukuran Lampiran Terlalu Besar, max:2048!',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $peminjaman = new Peminjaman();
        $user = Auth::user();
        $peminjaman->iduser = $user->id;
        $peminjaman->nama = $request->input('nama');
        $peminjaman->nim = $request->input('nim');
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
        }

        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('lampiran'), $filename);
            $peminjaman->lampiran = $filename;
        }

        $peminjaman->jumlahaset = $jumlah;

        $peminjaman->save();

        return redirect()->route('admin.peminjaman')->with('success', 'Data berhasil ditambahkan.');
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
            'nama'              => 'required|string|max:50',
            'nim'               => 'max:16',
            'tanggalpeminjaman' => 'required|date',
            'jumlahaset'        => 'required|integer|min:1',
            'status'            => 'required|in:dipinjam,dikembalikan',
            'lampiran'          => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
        ], [
            'nama.required'                 => 'Nama harus diisi!',
            'nama.string'                   => 'Nama harus berupa teks!',
            'nama.max'                      => 'Nama maksimal 50 karakter!',
            'nim.required'                  => 'NIM harus diisi!',
            'nim.string'                    => 'NIM harus berupa angka!',
            'nim.max'                       => 'NIM maksimal 16 karakter!',
            'jenisaset.required'            => 'Jenis aset harus diisi!',
            'tanggalpeminjaman.required'    => 'Isi Tanggal Peminjaman!',
            'jumlahaset.required'           => 'Isi Jumlah Aset!',
            'lampiran.required'             => 'Lampiran Tidak Boleh Kosong!',
            'lampiran.image'                => 'Lampiran harus berupa gambar!',
            'lampiran.mimes'                => 'Lampiran gambar yang diperbolehkan: jpeg, png, jpg, gif, pdf, docx!',
            'lampiran.max'                  => 'Ukuran Lampiran Terlalu Besar, max:2048!',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $peminjaman = Peminjaman::find($id);
        if (!$peminjaman) {
            return redirect()->route('admin.peminjaman')->withErrors('Data tidak ditemukan.');
        }

        $peminjaman->nama = $request->input('nama');
        $peminjaman->nim = $request->input('nim');
        $peminjaman->tanggalpeminjaman = $request->input('tanggalpeminjaman');
        $peminjaman->jumlahaset = $request->input('jumlahaset');
        $peminjaman->status = $request->input('status');

        if ($request->hasFile('lampiran')) {
            $lampiran = $request->file('lampiran');
            $lampiranName = time() . '_' . $lampiran->getClientOriginalName();
            $lampiran->move(public_path('lampiran'), $lampiranName);
            $peminjaman->lampiran = $lampiranName;
        }

        $peminjaman->save();

        if ($request->input('status') == 'dikembalikan') {
            Pengembalian::create([
                'idpeminjaman'        => $peminjaman->idpeminjaman,
                'tanggalpengembalian' => now(),
            ]);

            $jenisaset = null;
            if ($peminjaman->idbarang) {
                $jenisaset = 'barang';
            } elseif ($peminjaman->idtransportasi) {
                $jenisaset = 'transportasi';
            } elseif ($peminjaman->idruangan) {
                $jenisaset = 'ruangan';
            }

            switch ($jenisaset) {
                case 'barang':
                    $barang = Barang::find($peminjaman->idbarang);
                    if ($barang) {
                        $barang->tambahStokb($peminjaman->jumlahaset);
                    }
                    break;
                case 'transportasi':
                    $transportasi = Transportasi::find($peminjaman->idtransportasi);
                    if ($transportasi) {
                        $transportasi->tambahStokt($peminjaman->jumlahaset);
                    }
                    break;
                case 'ruangan':
                    $ruangan = Ruangan::find($peminjaman->idruangan);
                    if ($ruangan) {
                        $ruangan->tambahStokr($peminjaman->jumlahaset);
                    }
                    break;
                default:
                    break;
            }
        }

        return redirect()->route('admin.peminjaman')->with('success', 'Data peminjaman berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::find($id);
        if ($peminjaman) {
            $jenisaset = null;
            if ($peminjaman->idbarang) {
                $jenisaset = 'barang';
            } elseif ($peminjaman->idtransportasi) {
                $jenisaset = 'transportasi';
            } elseif ($peminjaman->idruangan) {
                $jenisaset = 'ruangan';
            }

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
