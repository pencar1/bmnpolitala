<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login_proses(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email'    => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Redirect based on user role
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'peminjam':
                    return redirect()->route('peminjam.dashboard');
                case 'wadir':
                    return redirect()->route('wadir.dashboard');
                case 'staf':
                    return redirect()->route('staf.dashboard');
                default:
                    Auth::logout();
                    return redirect()->route('login')->with('failed', 'Role tidak dikenal.');
            }
        } else {
            return redirect()->route('login')->with('failed', 'Email atau Password Salah');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Kamu Berhasil Logout');
    }
}
