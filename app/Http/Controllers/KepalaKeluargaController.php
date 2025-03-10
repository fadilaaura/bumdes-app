<?php

namespace App\Http\Controllers;

use App\Models\KepalaKeluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class KepalaKeluargaController extends Controller
{
    public function index()
    {
        $kepala_keluarga = KepalaKeluarga::all();
        return view('data_kk', compact('kepala_keluarga'));
    }

    public function create()
    {
        return view('tambah_kk');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|size:16|unique:kepala_keluarga,nik',
            'pin' => 'required|string|min:4',
            'email' => 'nullable|email|unique:kepala_keluarga,email',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'noTelepon' => 'required|string|max:15',
            'peranUser' => 'required|string|max:50',
            'RTRW' => 'required|string|regex:/^\d{3}\/\d{2}$/',
            'idRW' => 'required|integer',
            'idRT' => 'required|integer',
        ]);

        KepalaKeluarga::create([
            'nik' => $request->nik,
            'pin' => Hash::make($request->pin),
            'email' => $request->email,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'noTelepon' => $request->noTelepon,
            'peranUser' => $request->peranUser,
            'RTRW' => $request->RTRW,
            'idRW' => $request->idRW,
            'idRT' => $request->idRT,
        ]);

        return redirect()->route('data_kk')->with('success', 'Data Kepala Keluarga berhasil ditambahkan');
    }

    // Update Data
    public function update(Request $request, $idKK)
    {
        $request->validate([
            'nik' => 'required|string|size:16|unique:kepala_keluarga,nik,' . $idKK . ',idKK',
            'pin' => 'required|string|min:4',
            'email' => 'nullable|email',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'noTelepon' => 'required|string|max:15',
            'peranUser' => 'required|string|max:50',
            'RTRW' => 'required|string|regex:/^\d{3}\/\d{2}$/',
            'idRW' => 'required|integer',
            'idRT' => 'required|integer',
        ]);

        $kepalaKeluarga = KepalaKeluarga::findOrFail($idKK);
        $kepalaKeluarga->update([
            'nik' => $request->nik,
            'pin' => Hash::make($request->pin),
            'email' => $request->email,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'noTelepon' => $request->noTelepon,
            'peranUser' => $request->peranUser,
            'RTRW' => $request->RTRW,
            'idRW' => $request->idRW,
            'idRT' => $request->idRT,
        ]);

        return response()->json(['message' => 'Data berhasil diperbarui']);
    }

    public function destroy($id)
    {
        $kk = KepalaKeluarga::findOrFail($id);
        $kk->delete();

        return redirect()->route('data_kk')->with('success', 'Data berhasil dihapus!');
    }
}
