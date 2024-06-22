<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index()
    {
        $data = Barang::orderBy('idbarang', 'desc')->get();

        return view('admin.barang', compact('data'));
    }

    public function tambahbarang()
    {
        return view('admin.barang.tambahb');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'namabarang' => 'required|string|max:255',
            'merkbarang' => 'required|string|max:255',
            'stokbarang' => 'required|integer',
            'deskripsibarang' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'namabarang.required' => 'Nama barang harus diisi.',
            'namabarang.string' => 'Nama barang harus berupa teks.',
            'namabarang.max' => 'Nama barang maksimal 255 karakter.',
            'merkbarang.required' => 'Merk barang harus diisi.',
            'merkbarang.string' => 'Merk barang harus berupa teks.',
            'merkbarang.max' => 'Merk barang maksimal 255 karakter.',
            'stokbarang.required' => 'Stok barang harus diisi.',
            'stokbarang.string' => 'Stok barang harus berupa angka.',
            'stokbarang.max' => 'Stok barang manimal 1.',
            'deskripsibarang.required' => 'Deskripsi barang harus diisi.',
            'deskripsibarang.string' => 'Deskripsi barang harus berupa teks.',
            'foto.required' => 'Foto barang harus diunggah.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format gambar yang diperbolehkan: jpeg, png, jpg, gif.',
            'foto.max' => 'Ukuran maksimal gambar adalah 2048 KB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $barang = new Barang();
        $barang->namabarang = $request->input('namabarang');
        $barang->merkbarang = $request->input('merkbarang');
        $barang->stokbarang = $request->input('stokbarang');
        $barang->deskripsibarang = $request->input('deskripsibarang');

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/barang'), $filename);
            $barang->foto = $filename;
        }

        $barang->save();

        return redirect()->route('admin.barang')->with('success', 'Data berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $data = Barang::find($id);
        if (!$data) {
            return redirect()->route('admin.barang')->withErrors('Data tidak ditemukan.');
        }
        return view('admin.barang.editb', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'namabarang' => 'required|string|max:255',
            'merkbarang' => 'required|string|max:255',
            'stokbarang' => 'required|integer',
            'deskripsibarang' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'namabarang.required' => 'Nama barang harus diisi.',
            'namabarang.string' => 'Nama barang harus berupa teks.',
            'namabarang.max' => 'Nama barang maksimal 255 karakter.',
            'merkbarang.required' => 'Merk barang harus diisi.',
            'merkbarang.string' => 'Merk barang harus berupa teks.',
            'merkbarang.max' => 'Merk barang maksimal 255 karakter.',
            'stokbarang.required' => 'Stok barang harus diisi.',
            'stokbarang.string' => 'Stok barang harus berupa angka.',
            'stokbarang.max' => 'Stok barang manimal 1.',
            'deskripsibarang.required' => 'Deskripsi barang harus diisi.',
            'deskripsibarang.string' => 'Deskripsi barang harus berupa teks.',
            'foto.required' => 'Foto barang harus diunggah.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format gambar yang diperbolehkan: jpeg, png, jpg, gif.',
            'foto.max' => 'Ukuran maksimal gambar adalah 2048 KB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $barang = Barang::find($id);
        if (!$barang) {
            return redirect()->route('admin.barang')->withErrors('Data tidak ditemukan.');
        }

        $barang->namabarang = $request->input('namabarang');
        $barang->merkbarang = $request->input('merkbarang');
        $barang->stokbarang = $request->input('stokbarang');
        $barang->deskripsibarang = $request->input('deskripsibarang');

        if ($request->hasFile('foto')) {
            // Delete the old photo if it exists
            if ($barang->foto) {
                $old_file_path = public_path('images/barang/' . $barang->foto);
                if (file_exists($old_file_path)) {
                    unlink($old_file_path);
                }
            }

            // Save the new photo
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/barang'), $filename);
            $barang->foto = $filename;
        }

        $barang->save();

        return redirect()->route('admin.barang')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $barang = Barang::find($id);
        if ($barang) {
            if ($barang->foto) {
                // Delete the associated photo file
                $file_path = public_path('images/barang/' . $barang->foto);
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            $barang->delete();
        }

        return redirect()->route('admin.barang')->with('success', 'Data berhasil dihapus.');
    }
}
