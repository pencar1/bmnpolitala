<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PeminjamanController extends Controller
{
    public function peminjaman(){
        return view('admin/peminjaman');
    }

    public function index()
    {
        $data = Peminjaman::get();
        return view('admin.peminjaman', compact('data'));
    }

    public function tambahpeminjaman()
    {
        return view('admin.peminjaman.tambahp');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggalpeminjaman' => 'required|date',
            'alasanpenolakan'   => 'required|string',
            'status'            => 'required|string',
            'lampiran'          => 'required|lamiran|mimes:jpeg,png,jpg,gif,pdf,docx|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $peminjaman = new Peminjaman();
        $peminjaman->tanggalpeminjaman  = $request->input('tanggalpeminjaman');
        $peminjaman->alasanpenolakan    = $request->input('alasanpenolakan');
        $peminjaman->status             = $request->input('status');

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
            'tanggalpeminjaman' => 'required|string|max:255',
            'alasanpenolakan' => 'required|string|max:255',
            'status' => 'required|integer',
            'deskripsipeminjaman' => 'required|string',
            'lampiran' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $peminjaman = Peminjaman::find($id);
        if (!$peminjaman) {
            return redirect()->route('admin.peminjaman')->withErrors('Data tidak ditemukan.');
        }

        $peminjaman->tanggalpeminjaman = $request->input('tanggalpeminjaman');
        $peminjaman->alasanpenolakan = $request->input('alasanpenolakan');
        $peminjaman->status = $request->input('status');
        $peminjaman->deskripsipeminjaman = $request->input('deskripsipeminjaman');

        if ($request->hasFile('lampiran')) {
            // Delete the old photo if it exists
            if ($peminjaman->lampiran) {
                $old_file_path = public_path('lampiran/' . $peminjaman->lampiran);
                if (file_exists($old_file_path)) {
                    unlink($old_file_path);
                }
            }

            // Save the new photo
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
                // Delete the associated photo file
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
