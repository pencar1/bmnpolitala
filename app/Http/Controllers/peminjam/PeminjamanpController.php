<?php

namespace App\Http\Controllers\peminjam;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Barang;
use App\Models\Transportasi;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class PeminjamanpController extends Controller
{
    public function index()
    {
        $userId = Auth::id(); // Mengambil ID user yang sedang masuk
        $transportasis = Transportasi::all(); // Mengambil semua data transportasi
        $data = Peminjaman::with(['user', 'barang', 'transportasi'])
            ->where('iduser', $userId) // Hanya mengambil peminjaman milik user yang sedang masuk
            ->where(function ($query) {
            $query->whereNotNull('idbarang')
            ->orWhereNotNull('idtransportasi');
        })
        ->get();
        return view('peminjam.peminjaman', compact('data', 'transportasis')); // Mengirimkan data transportasi ke view
    }

    public function tambahpeminjamanbarang(Request $request)
    {
        $idbarang = $request->query('idbarang');
        $barang = Barang::find($idbarang);
        if (!$barang) {
            return redirect()->route('peminjam.barang')->withErrors(['barang' => 'Barang tidak ditemukan.']);
        }
        return view('peminjam.peminjamanp.pinjambarang', compact('barang'));
    }

    public function tambahPeminjamanTransportasi(Request $request)
    {
        // Mengambil ID transportasi dari query string
        $idTransportasi = $request->query('idTransportasi');
        $transportasi = Transportasi::find($idTransportasi);
        // Jika transportasi tidak ditemukan, kembalikan redirect ke route peminjam.transportasi
        if (!$transportasi) {
            return redirect()->route('peminjam.transportasi')->withErrors(['transportasi' => 'Transportasi tidak ditemukan.']);
        }
        // Jika transportasi ditemukan, kirimkan data transportasi ke view
        return view('peminjam.peminjamanp.pinjamtransportasi', compact('transportasi'));
    }

    public function tambahPeminjamanRuangan(Request $request)
    {
        $idRuangan = $request->query('idRuangan');
        $ruangan = Ruangan::find($idRuangan);
        if (!$ruangan) {
            return redirect()->route('peminjam.ruangan')->withErrors(['ruangan' => 'Ruangan tidak ditemukan.']);
        }
        return view('peminjam.peminjamanp.pinjamruangan', compact('ruangan'));
    }

    public function storebar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggalpeminjaman' => 'required|date',
            'lampiran'          => 'nullable|mimes:jpeg,png,jpg,gif,pdf,docx|max:2048',
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
        $peminjaman->status = 'Diproses';
        $asetId = $request->input('idbarang');
        $jumlah = $request->input('jumlahaset');

        $barang = Barang::find($asetId);
        if ($barang && $barang->kurangiStokb($jumlah)) {
            $peminjaman->idbarang = $asetId;
        } else {
            return redirect()->back()->withInput()->withErrors(['jumlahaset' => 'Stok barang tidak mencukupi.']);
        }

        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('lampiran'), $filename);
            $peminjaman->lampiran = $filename;
        }

        $peminjaman->jumlahaset = $jumlah;
        $peminjaman->save();

        return redirect()->route('peminjam.peminjaman');
    }

    public function storetrans(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggalpeminjaman' => 'required|date',
            'lampiran'          => 'nullable|mimes:jpeg,png,jpg,gif,pdf,docx|max:2048',
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
        $peminjaman->status = 'Diproses';
        $asetId = $request->input('idtransportasi');
        $jumlah = $request->input('jumlahaset');

        $transportasi = Transportasi::find($asetId);
        if ($transportasi && $transportasi->kurangiStokt($jumlah)) {
            $peminjaman->idtransportasi = $asetId;
        } else {
            return redirect()->back()->withInput()->withErrors(['jumlahaset' => 'Stok transportasi tidak mencukupi.']);
        }

        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('lampiran'), $filename);
            $peminjaman->lampiran = $filename;
        }

        $peminjaman->jumlahaset = $jumlah;
        $peminjaman->save();

        return redirect()->route('peminjam.peminjaman');
    }

    public function storeruangan(Request $request)
    {
        // Validasi data yang diterima
        $validator = Validator::make($request->all(), [
            'tanggalpeminjaman' => 'required|date',
            'lampiran'          => 'nullable|mimes:jpeg,png,jpg,gif,pdf,docx|max:2048',
            'idruangan'         => 'required|integer' // Menambahkan validasi untuk idruangan
        ],[
            'tanggalpeminjaman.required' => 'Nama ruangan harus diisi.',
            'lampiran.required' => 'Foto ruangan harus diunggah.',
            'lampiran.image' => 'File harus berupa gambar.',
            'lampiran.mimes' => 'Format gambar yang diperbolehkan: jpeg, png, jpg, gif.',
            'lampiran.max' => 'Ukuran maksimal gambar adalah 2048 KB.',
        ]);

        // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan error
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        // Buat instance baru dari model Peminjaman
        $peminjaman = new Peminjaman();
        $user = Auth::user();
        $peminjaman->iduser = $user->id;
        $peminjaman->tanggalpeminjaman = $request->input('tanggalpeminjaman');
        $peminjaman->idruangan = $request->input('idruangan'); // Menambahkan penyimpanan idruangan
        $peminjaman->status = 'Diproses';

        // Jika ada file yang di-upload, simpan file tersebut
        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('lampiran'), $filename);
            $peminjaman->lampiran = $filename;
        }

        // Simpan data peminjaman ke database
        $peminjaman->save();

        // Redirect ke rute 'peminjam.peminjaman'
        return redirect()->route('peminjam.peminjaman');
    }


    public function updatestatus(Request $request)
{
    $peminjaman = Peminjaman::findOrFail($request->id);
    $peminjaman->status = 'Dibatalkan'; // Mengubah status menjadi "Batal"
    $peminjaman->save();

    return redirect()->route('peminjam.peminjaman');
}

public function update(Request $request, $id)
{
    // Find the peminjaman by its ID
    $peminjaman = Peminjaman::findOrFail($id);

    // Perform any necessary validation here

    // Update the peminjaman status
    $peminjaman->status = 'Dibatalkan';
    $peminjaman->save();

    // Redirect back to the peminjaman index page
    return redirect()->route('peminjam.peminjaman');
}

}
