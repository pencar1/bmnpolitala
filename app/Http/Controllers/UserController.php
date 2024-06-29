<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){

        $data = User::get();

        return view('admin.user', compact('data'));
    }

    public function profil(){
        $user = Auth::user(); // Mendapatkan pengguna yang sedang login
        return view('admin.profil', compact('user'));
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

        return redirect()->route('admin.profil')->with('success', 'Profil berhasil diperbarui.');
    }


    public function create(){
        return view('admin.user.tambahu');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:50',
            'prodi' => 'required|string|max:50',
            'nim' => 'required|string|max:16',
            'nohp' => 'required|string|max:16',
            'organisasi' => 'required|string|max:50',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/', // minimal satu huruf kecil
                'regex:/[A-Z]/', // minimal satu huruf besar
            ],
        ], [
            'nama.required' => 'Nama harus diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama maksimal 50 karakter.',
            'prodi.required' => 'Prodi harus diisi.',
            'prodi.string' => 'Prodi harus berupa teks.',
            'prodi.max' => 'Prodi maksimal 50 karakter.',
            'nim.required' => 'NIM harus diisi.',
            'nim.string' => 'NIM harus berupa teks.',
            'nim.max' => 'NIM maksimal 16 karakter.',
            'nohp.required' => 'Nomor HP harus diisi.',
            'nohp.string' => 'Nomor HP harus berupa teks.',
            'nohp.max' => 'Nomor HP maksimal 16 karakter.',
            'organisasi.required' => 'Organisasi harus diisi.',
            'organisasi.string' => 'Organisasi harus berupa teks.',
            'organisasi.max' => 'Organisasi maksimal 50 karakter.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 255 karakter.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password harus diisi.',
            'password.string' => 'Password harus berupa teks.',
            'password.min' => 'Password minimal 8 karakter dengan minimal satu huruf besar dan satu huruf kecil.',
            'password.regex' => 'Password minimal 8 karakter dengan minimal satu huruf besar dan satu huruf kecil.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $data['nama']           = $request->input('nama');
        $data['prodi']          = $request->input('prodi');
        $data['nim']            = $request->input('nim');
        $data['nohp']           = $request->input('nohp');
        $data['organisasi']     = $request->input('organisasi');
        $data['email']          = $request->input('email');
        $data['password']       = Hash::make($request->input('password'));

        User::create($data);

        return redirect()->route('admin.user')->with('success', 'Data berhasil ditambahkan.');
    }


    public function edit(Request $request,$id){
        $data = User::find($id);

        return view('admin.user.editu', compact('data'));
    }

    public function update(Request $request, $id)
    {
        // Ambil data pengguna yang ada berdasarkan ID
        $user = User::findOrFail($id);

        // Aturan validasi dengan pengecualian email pengguna saat ini
        $validator = Validator::make($request->all(), [
            'nama'          => 'required|string|max:50',
            'prodi'         => 'required|string|max:50',
            'nim'           => 'required|string|max:16',
            'nohp'          => 'required|string|max:16',
            'organisasi'    => 'required|string|max:50',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password' => [
                'nullable',
                'string',
                'min:8',
                'regex:/[a-z]/', // setidaknya satu huruf kecil
                'regex:/[A-Z]/', // setidaknya satu huruf besar
            ],
            'role' => 'required|string', // Menambahkan validasi untuk role
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $data['nama']           = $request->input('nama');
        $data['prodi']          = $request->input('prodi');
        $data['nim']            = $request->input('nim');
        $data['nohp']           = $request->input('nohp');
        $data['organisasi']     = $request->input('organisasi');
        $data['email']          = $request->input('email');
        $data['role']           = $request->input('role'); // Menambahkan update role

        if ($request->password) {
            $data['password'] = Hash::make($request->input('password'));
        }

        User::whereId($id)->update($data);

        return redirect()->route('admin.user')->with('success', 'Data berhasil diperbarui.');
    }



    public function delete(Request $request,$id){
        $data = User::find($id);

        if($data){
            $data->delete();
        }

        return redirect()->route('admin.user')->with('success', 'Data berhasil dihapus.');
    }
}

