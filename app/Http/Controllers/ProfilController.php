<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\PengelolaBumdes; // Gunakan model PengelolaBumdes

class ProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Ambil pengguna yang sedang login
        return view('profil', compact('user')); // Kirim data ke view
    }

    public function update(Request $request)
    {
        $user = Auth::user(); // Ambil user yang sedang login

        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:pengelola_bumdes,username,' . $user->idBUMDes . ',idBUMDes',
            'password' => 'nullable|string|min:6',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Update data user
        $user->nama = $request->nama;
        $user->username = $request->username;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Update foto jika ada
        if ($request->hasFile('foto')) {
            if ($user->foto) {
                Storage::delete('public/foto/' . $user->foto);
            }
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/foto', $filename);
            $user->foto = $filename;
        }

        $user->save();

        return redirect()->route('profil')->with('success', 'Profil berhasil diperbarui');
    }
}
