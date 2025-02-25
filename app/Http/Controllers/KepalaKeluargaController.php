<?php
namespace App\Http\Controllers;

use App\Models\KepalaKeluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class KepalaKeluargaController extends Controller
{
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
            'idRW' => $request->idRW,
            'idRT' => $request->idRT,
        ]);

        return redirect()->route('kepala_keluarga.index')->with('success', 'Data Kepala Keluarga berhasil ditambahkan');
    }
}
