<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\KepalaKeluarga;

class ProfilWargaController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Ambil pengguna yang sedang login
        return view('profil_warga', compact('user')); // Kirim data ke view
    }

    public function update(Request $request)
    {
        $user = Auth::user(); // Ambil user yang sedang login

        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:255|unique:kepala_keluarga,nik,' . $user->idKK . ',idKK',
            'email' => 'required|string|max:255|unique:kepala_keluarga,email,' . $user->idKK . ',idKK',
            'alamat' => 'required|string|max:255',
            'noTelepon' => 'required|string|max:15',
            'pin' => 'nullable|string|min:6',
            'peranUser' => 'required|string|max:50',
            'RTRW' => 'required|string|regex:/^\d{3}\/\d{2}$/',
            'idRW' => 'required|integer',
            'idRT' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Update data user
        $user->nama = $request->nama;
        $user->nik = $request->nik;
        $user->email = $request->email;
        $user->alamat = $request->alamat;
        $user->noTelepon = $request->noTelepon;

        if ($request->filled('pin')) {
            $user->pin = Hash::make($request->pin);
        }
        $user->peranUser = $request->peranUser;
        $user->RTRW = $request->RTRW;
        $user->idRT = $request->idRT;
        $user->idRW = $request->idRW;

        // Update foto jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto && Storage::exists('public/foto/' . $user->foto)) {
                Storage::delete('public/foto/' . $user->foto);
            }

            // Simpan foto baru
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/foto', $filename);
            $user->foto = $filename;
        }

        $user->save();

        return redirect()->route('profil_warga')->with('success', 'Profil berhasil diperbarui');
    }
}
