<?php

namespace App\Http\Controllers;

use App\Models\KepalaKeluarga; // Pastikan model KepalaKeluarga digunakan
use App\Http\Controllers\Controller; // Tambahkan ini
use Illuminate\Http\Request;


class WargaController extends Controller
{
    public function kelolaPeran()
    {
        $warga = KepalaKeluarga::whereIn('peranUser', ['Pengurus RT', 'Pengurus RW'])
            ->orderByRaw("FIELD(peranUser, 'Pengurus RT', 'Pengurus RW')")
            ->get();

        return view('kelola_peran', compact('warga'));
    }

    public function update(Request $request, $idKK)
    {
        $request->validate([
            'nik' => 'required',
            'nama' => 'required',
            'noTelepon' => 'required',
            'peranUser' => 'required|in:Pengurus RW,Pengurus RT'
        ]);
    
        $warga = KepalaKeluarga::where('idKK', $idKK)->firstOrFail();
        $warga->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'noTelepon' => $request->noTelepon,
            'peranUser' => $request->peranUser
        ]);
    
        return response()->json(['message' => 'Peran berhasil diperbarui.']);
    }
    

    public function destroy($idKK)
    {
        $warga = KepalaKeluarga::findOrFail($idKK);
        $warga->delete();

        return redirect()->route('kelola.peran')->with('success', 'Peran berhasil dihapus.');
    }
}
