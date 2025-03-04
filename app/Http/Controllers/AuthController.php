<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function showLoginForm()
    {
        return view('login_admin'); // Pastikan view ini ada
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Cek apakah email termasuk admin (PengelolaBumdes)
        if (Auth::guard('PengelolaBumdes')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard'); // Redirect ke dashboard admin
        }

        // Jika bukan admin, cek apakah email termasuk warga (KepalaKeluarga)
        if (Auth::guard('KepalaKeluarga')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('warga.dashboard'); // Redirect ke dashboard warga
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }


    // Logout untuk semua user
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.admin'); // Redirect ke halaman login utama
    }
}
