<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RuanganController extends Controller
{
    public function index()
    {
        $data = Ruangan::get();
        return view('admin.ruangan', compact('data'));
    }

    public function tambahruangan()
    {
        return view('admin.ruangan.tambahr');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'namaruangan' => 'required|string|max:255',
            'deskripsiruangan' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'namaruangan.required' => 'Nama ruangan harus diisi.',
            'namaruangan.string' => 'Nama ruangan harus berupa teks.',
            'namaruangan.max' => 'Nama ruangan maksimal 255 karakter.',
            'deskripsiruangan.required' => 'Deskripsi ruangan harus diisi.',
            'deskripsiruangan.string' => 'Deskripsi ruangan harus berupa teks.',
            'foto.required' => 'Foto ruangan harus diunggah.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format gambar yang diperbolehkan: jpeg, png, jpg, gif.',
            'foto.max' => 'Ukuran maksimal gambar adalah 2048 KB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $ruangan = new Ruangan();
        $ruangan->namaruangan = $request->input('namaruangan');
        $ruangan->deskripsiruangan = $request->input('deskripsiruangan');

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/ruangan'), $filename);
            $ruangan->foto = $filename;
        }

        $ruangan->save();

        return redirect()->route('admin.ruangan')->with('success', 'Data berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $data = Ruangan::find($id);
        if (!$data) {
            return redirect()->route('admin.ruangan')->withErrors('Data tidak ditemukan.');
        }
        return view('admin.ruangan.editr', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'namaruangan' => 'required|string|max:255',
            'deskripsiruangan' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],[
            'namaruangan.required' => 'Nama ruangan harus diisi.',
            'namaruangan.string' => 'Nama ruangan harus berupa teks.',
            'namaruangan.max' => 'Nama ruangan maksimal 255 karakter.',
            'deskripsiruangan.required' => 'Deskripsi ruangan harus diisi.',
            'deskripsiruangan.string' => 'Deskripsi ruangan harus berupa teks.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format gambar yang diperbolehkan: jpeg, png, jpg, gif.',
            'foto.max' => 'Ukuran maksimal gambar adalah 2048 KB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $ruangan = Ruangan::find($id);
        if (!$ruangan) {
            return redirect()->route('admin.ruangan')->withErrors('Data tidak ditemukan.');
        }

        $ruangan->namaruangan = $request->input('namaruangan');
        $ruangan->deskripsiruangan = $request->input('deskripsiruangan');

        if ($request->hasFile('foto')) {
            // Delete the old photo if it exists
            if ($ruangan->foto) {
                $old_file_path = public_path('images/ruangan/' . $ruangan->foto);
                if (file_exists($old_file_path)) {
                    unlink($old_file_path);
                }
            }

            // Save the new photo
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/ruangan'), $filename);
            $ruangan->foto = $filename;
        }

        $ruangan->save();

        return redirect()->route('admin.ruangan')->with('success', 'Data berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $ruangan = Ruangan::find($id);
        if ($ruangan) {
            if ($ruangan->foto) {
                // Delete the associated photo file
                $file_path = public_path('images/ruangan/' . $ruangan->foto);
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            $ruangan->delete();
        }

        return redirect()->route('admin.ruangan')->with('success', 'Data berhasil dihapus.');
    }
}
