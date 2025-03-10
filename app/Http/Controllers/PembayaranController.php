<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran; // Tambahkan ini
use Illuminate\Support\Facades\Storage; // Tambahkan ini

class PembayaranController extends Controller
{
    public function index()
    {
        return view('retribusi_sampah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nik' => 'required',
            'nomor_hp' => 'required',
            'rt_rw' => 'required',
            'jumlah' => 'required|numeric',
            'buktiPembayaran' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi file
        ]);

        $imagePath = $request->file('buktiPembayaran')->store('bukti_pembayaran', 'public');

        Pembayaran::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'nomor_hp' => $request->nomor_hp,
            'rt_rw' => $request->rt_rw,
            'jumlah' => $request->jumlah,
            'buktiPembayaran' => $imagePath,
            'status' => 'pending', // Atur status default
        ]);

        return redirect()->route('retribusi.sampah')->with('success', 'Pembayaran berhasil disimpan!');
    }
}