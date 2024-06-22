<?php

namespace App\Http\Controllers\peminjam;

use App\Http\Controllers\Controller; // Tambahkan ini
use App\Models\User;
use App\Models\Barang;
use App\Models\Ruangan;
use App\Models\Transportasi;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class HomepController extends Controller
{
    public function dashboard(){
        $userCount = User::count();
        $barangCount = Barang::count();
        $ruanganCount = Ruangan::count();
        $transportasiCount = Transportasi::count();
        $userId = Auth::id(); // Mendapatkan ID user yang sedang login
        $peminjamanCount = Peminjaman::where('iduser', $userId)->count(); // Menghitung peminjaman berdasarkan ID user
        return view('dashboardp', compact('userCount','barangCount','ruanganCount','transportasiCount','peminjamanCount'));
    }



    public function profil(){
        $user = Auth::user(); // Mendapatkan pengguna yang sedang login
        return view('peminjam/profilp', compact('user'));
    }

    public function updateProfil(Request $request){
        $user = Auth::user(); // Mendapatkan pengguna yang sedang login

        // Aturan validasi dengan pengecualian email pengguna saat ini
        $validator = Validator::make($request->all(), [
            'nama'          => '|string|max:50',
            'prodi'         => '|string|max:50',
            'nim'           => '|string|max:16',
            'nohp'          => '|string|max:16',
            'organisasi'    => '|string|max:50',
            'email' => [
                '',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password' => [
            'nullable',
            'string',
            'min:8',
            'regex:/[a-z]/', // at least one lowercase letter
            'regex:/[A-Z]/', // at least one uppercase letter
        ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $user->nama = $request->input('nama');
        $user->prodi = $request->input('prodi');
        $user->nim = $request->input('nim');
        $user->nohp = $request->input('nohp');
        $user->organisasi = $request->input('organisasi');
        $user->email = $request->input('email');

        if ($request->password) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return redirect()->route('peminjam.profil')->with('success', 'Profil berhasil diperbarui.');
    }
}
