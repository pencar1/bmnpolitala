<?php
namespace App\Http\Controllers;

use App\Models\Transportasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransportasiController extends Controller
{
    public function index()
    {
        $data = Transportasi::orderBy('idtransportasi', 'desc')->get();

        return view('admin.transportasi', compact('data'));
    }

    public function tambahtransportasi()
    {
        return view('admin.transportasi.tambaht');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'namatransportasi' => 'required|string|max:255',
            'merktransportasi' => 'required|string|max:255',
            'stoktransportasi' => 'required|integer',
            'deskripsitransportasi' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $transportasi = new Transportasi();
        $transportasi->namatransportasi = $request->input('namatransportasi');
        $transportasi->merktransportasi = $request->input('merktransportasi');
        $transportasi->stoktransportasi = $request->input('stoktransportasi');
        $transportasi->deskripsitransportasi = $request->input('deskripsitransportasi');

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/transportasi'), $filename);
            $transportasi->foto = $filename;
        }

        $transportasi->save();

        return redirect()->route('admin.transportasi')->with('success', 'Data berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $data = Transportasi::find($id);
        if (!$data) {
            return redirect()->route('admin.transportasi')->withErrors('Data tidak ditemukan.');
        }
        return view('admin.transportasi.editt', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'namatransportasi' => 'required|string|max:255',
            'merktransportasi' => 'required|string|max:255',
            'stoktransportasi' => 'required|integer',
            'deskripsitransportasi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $transportasi = Transportasi::find($id);
        if (!$transportasi) {
            return redirect()->route('admin.transportasi')->withErrors('Data tidak ditemukan.');
        }

        $transportasi->namatransportasi = $request->input('namatransportasi');
        $transportasi->merktransportasi = $request->input('merktransportasi');
        $transportasi->stoktransportasi = $request->input('stoktransportasi');
        $transportasi->deskripsitransportasi = $request->input('deskripsitransportasi');

        if ($request->hasFile('foto')) {
            // Delete the old photo if it exists
            if ($transportasi->foto) {
                $old_file_path = public_path('images/transportasi/' . $transportasi->foto);
                if (file_exists($old_file_path)) {
                    unlink($old_file_path);
                }
            }

            // Save the new photo
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/transportasi'), $filename);
            $transportasi->foto = $filename;
        }

        $transportasi->save();

        return redirect()->route('admin.transportasi')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $transportasi = Transportasi::find($id);
        if ($transportasi) {
            if ($transportasi->foto) {
                // Delete the associated photo file
                $file_path = public_path('images/transportasi/' . $transportasi->foto);
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            $transportasi->delete();
        }

        return redirect()->route('admin.transportasi')->with('success', 'Data berhasil dihapus.');
    }
}


