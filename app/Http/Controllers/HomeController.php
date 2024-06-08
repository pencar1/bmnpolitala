<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class HomeController extends Controller
{
    public function dashboard(){
        return view('dashboard');
    }

    public function index(){

        $data = User::get();

        return view('index', compact('data'));
    }

    public function create(){
        return view('create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'nama'          => 'required|string|max:50',
            'prodi'         => 'required|string|max:50',
            'nim'           => 'required|string|max:16',
            'nohp'          => 'required|string|max:16',
            'organisasi'    => 'required|string|max:50',
            'email'         => 'required|email|max:255|unique:users,email',
            'password'      => 'required|string|min:8',
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

        return redirect()->route('admin.index');
    }

    public function edit(Request $request,$id){
        $data = User::find($id);

        return view('edit', compact('data'));
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
            'password' => 'nullable|min:8',
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

        if ($request->password) {
            $data['password'] = Hash::make($request->input('password'));
        }

        User::whereId($id)->update($data);

        return redirect()->route('admin.index');
    }

    public function delete(Request $request,$id){
        $data = User::find($id);

        if($data){
            $data->delete();
        }

        return redirect()->route('admin.index');
    }


}
