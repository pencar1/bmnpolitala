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
        $userId = Auth::id();
        $transportasis = Transportasi::all();

        $status = ['diproses', 'dikembalikan', 'disetujui', 'dipinjam','dibatalkan'];

        $data = Peminjaman::with(['user', 'barang', 'transportasi', 'ruangan'])
            ->where('iduser', $userId)
            ->whereIn('status', $status)
            ->where(function ($query) {
                $query->whereNotNull('idbarang')
                    ->orWhereNotNull('idtransportasi')
                    ->orWhereNotNull('idruangan');
            })
            ->get();

        return view('peminjam.peminjaman', compact('data', 'transportasis'));
    }


    public function tambahpeminjamanbarang(Request $request)
    {
        $idbarang = $request->query('idbarang');
        $barang = Barang::find($idbarang);

        if (!$barang) {
            return redirect()->route('peminjam.barang')->withErrors(['barang' => 'Barang tidak ditemukan.']);
        }

        $user = Auth::user();
        return view('peminjam.peminjamanp.pinjambarang', compact('barang', 'user'));
    }

    public function tambahPeminjamanTransportasi(Request $request)
    {
        $idTransportasi = $request->query('idTransportasi');
        $transportasi = Transportasi::find($idTransportasi);

        if (!$transportasi) {
            return redirect()->route('peminjam.transportasi')->withErrors(['transportasi' => 'Transportasi tidak ditemukan.']);
        }

        $user = Auth::user();
        return view('peminjam.peminjamanp.pinjamtransportasi', compact('transportasi', 'user'));
    }

    public function tambahPeminjamanRuangan(Request $request)
    {
        $idRuangan = $request->query('idRuangan');
        $ruangan = Ruangan::find($idRuangan);

        if (!$ruangan) {
            return redirect()->route('peminjam.ruangan')->withErrors(['ruangan' => 'Ruangan tidak ditemukan.']);
        }

        $user = Auth::user();
        return view('peminjam.peminjamanp.pinjamruangan', compact('ruangan', 'user'));
    }

    public function storebar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggalpeminjaman' => 'required|date',
            'lampiran'          => 'nullable|mimes:jpeg,png,jpg,gif,pdf,docx|max:2048',
            'aset'              => 'required',
            'jumlahaset'        => 'required|integer|min:1',
            'idbarang'          => 'required|integer', 
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
    
        $asetId = $request->input('idbarang');
        $jumlah = $request->input('jumlahaset');
    
        // Cek stok barang
        $barang = Barang::find($asetId);
        if (!$barang || $barang->stokbarang < $jumlah) { // pastikan 'stokbarang' adalah nama kolom yang benar
            return redirect()->back()->withInput()->withErrors(['jumlahaset' => 'Stok barang tidak mencukupi.']);
        }
    
        // Buat peminjaman baru
        $peminjaman = new Peminjaman();
        $user = Auth::user();
        $peminjaman->iduser = $user->id;
        $peminjaman->nama = $request->input('nama');
        $peminjaman->nim = $request->input('nim');
        $peminjaman->tanggalpeminjaman = $request->input('tanggalpeminjaman');
        $peminjaman->status = 'Diproses';
        $peminjaman->idbarang = $asetId;
        $peminjaman->jumlahaset = $jumlah;
    
        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('lampiran'), $filename);
            $peminjaman->lampiran = $filename;
        }
    
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
        'idtransportasi'    => 'required|integer', 
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withInput()->withErrors($validator);
    }

    $asetId = $request->input('idtransportasi');
    $jumlah = $request->input('jumlahaset');

    // Cek stok transportasi
    $transportasi = Transportasi::find($asetId);
    if (!$transportasi || $transportasi->stoktransportasi < $jumlah) {
        return redirect()->back()->withInput()->withErrors(['jumlahaset' => 'Stok transportasi tidak mencukupi.']);
    }

    // Buat peminjaman baru
    $peminjaman = new Peminjaman();
    $user = Auth::user();
    $peminjaman->iduser = $user->id;
    $peminjaman->nama = $request->input('nama');
    $peminjaman->nim = $request->input('nim');
    $peminjaman->tanggalpeminjaman = $request->input('tanggalpeminjaman');
    $peminjaman->status = 'Diproses';
    $peminjaman->idtransportasi = $request->input('idtransportasi');
    $peminjaman->jumlahaset = $jumlah;

    if ($request->hasFile('lampiran')) {
        $file = $request->file('lampiran');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('lampiran'), $filename);
        $peminjaman->lampiran = $filename;
    }

    $peminjaman->save();

    return redirect()->route('peminjam.peminjaman');
}


    public function storeruangan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggalpeminjaman' => 'required|date',
            'lampiran'          => 'required|mimes:jpeg,png,jpg,gif,pdf,docx|max:2048',
            'idruangan'         => 'required|integer'
        ],[
            'tanggalpeminjaman.required' => 'Isi Tanggal Peminjaman!',
            'lampiran.required' => 'Lampiran Tidak Boleh Kosong!',
            'lampiran.image' => 'Lampiran harus berupa gambar!',
            'lampiran.mimes' => 'Lampiran gambar yang diperbolehkan: jpeg, png, jpg, gif, pdf, docx!',
            'lampiran.max' => 'Ukuran Lampiran Terlalu Besar!',
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
        $peminjaman->idruangan = $request->input('idruangan');
        $peminjaman->status = 'Diproses';
        $jumlah = 1;

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


    public function updatestatus(Request $request)
{
    $peminjaman = Peminjaman::findOrFail($request->id);
<<<<<<< HEAD
    $peminjaman->status = 'Dibatalkan';
=======
    $peminjaman->status = 'dibatalkan'; // Mengubah status menjadi "Batal"
>>>>>>> 6c57e3968aeca547fbf951490827959ae281146f
    $peminjaman->save();

    return redirect()->route('peminjam.peminjaman');
}

public function update(Request $request, $id)
{
    $peminjaman = Peminjaman::findOrFail($id);

<<<<<<< HEAD
    $peminjaman->status = 'Dibatalkan';
=======
    // Perform any necessary validation here

    // Update the peminjaman status
    $peminjaman->status = 'dibatalkan';
>>>>>>> 6c57e3968aeca547fbf951490827959ae281146f
    $peminjaman->save();

    return redirect()->route('peminjam.peminjaman');
}

}
