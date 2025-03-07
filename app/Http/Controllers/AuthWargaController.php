<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KepalaKeluarga;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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
            ->first();

        if (!$user) {
            return back()->withErrors(['error' => 'NIK atau Email salah!']);
        }

            // Verifikasi PIN menggunakan Hash::check()
    if (!Hash::check($credentials['pin'], $user->pin)) {
        return back()->withErrors(['error' => 'PIN salah!']);
    }

        // Login manual tanpa attempt() jika user ditemukan
        Auth::guard('KepalaKeluarga')->login($user);
        $request->session()->regenerate();

        // Redirect ke dashboard warga setelah login berhasil
        return redirect()->route('dashboard.warga');
    }

    public function showDashboard()
{
    // Contoh data yang akan diteruskan
    $data = [
        'total_iuran' => DB::table('rw')->sum('Iuran') ?? 0,
        'sudah_bayar' => DB::table('rt')->where('Iuran', '>', 0)->count() ?? 0,
        'belum_bayar' => DB::table('rt')->where('Iuran', '=', 0)->count() ?? 0,
        'jumlah_kk' => DB::table('rw')->sum('JumlahKK') ?? 0,
        'jumlah_rt' => DB::table('rt')->count() ?? 0,
        'jumlah_rw' => DB::table('rw')->count() ?? 0,
    ];

    return view('dashboard_warga', compact('data'));
    // Atau
    // return view('dashboard_warga')->with('data', $data);
}

public function logout(Request $request)
{
    Auth::guard('KepalaKeluarga')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('warga.login')->with('success', 'Anda telah berhasil logout.');
}
}
