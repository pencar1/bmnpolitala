<?php

namespace App\Http\Controllers\staf;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class HomesController extends Controller
{
    
        public function dashboard(){
            return view('dashboards');
        }
    
        public function index(){
    
            $data = User::get();
    
            return view('index', compact('data'));
        }
    
        public function profil(){
            $user = Auth::user(); // Mendapatkan pengguna yang sedang login
            return view('staf.profil', compact('user'));
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
                'password' => 'nullable|min:8',
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
    
            return redirect()->route('staf.profil')->with('success', 'Profil berhasil diperbarui.');
        }
    
    }

