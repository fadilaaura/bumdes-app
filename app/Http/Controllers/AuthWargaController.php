<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KepalaKeluarga;

class AuthWargaController extends Controller
{
    public function showLoginForm()
    {
        return view('login_warga');
    }

    public function login(Request $request)
    {
        // Validasi input NIK, Email, dan PIN
        $credentials = $request->validate([
            'nik' => 'required',
            'email' => 'required|email',
            'pin' => 'required',
        ]);

        // Cari user berdasarkan NIK, Email, dan PIN
        $user = KepalaKeluarga::where('nik', $credentials['nik'])
            ->where('email', $credentials['email'])
            ->where('pin', $credentials['pin']) // Cocokkan PIN manual
            ->first();

        if (!$user) {
            return back()->withErrors(['error' => 'NIK, Email, atau PIN salah!']);
        }

        // Login manual tanpa attempt() jika user ditemukan
        Auth::guard('KepalaKeluarga')->login($user);

        $request->session()->regenerate();

        // Redirect ke dashboard warga setelah login berhasil
        return redirect()->route('dashboard.warga');
    }

    public function logout(Request $request)
    {
        Auth::guard('KepalaKeluarga')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login warga setelah logout
        return redirect()->route('warga.login');
    }
}
