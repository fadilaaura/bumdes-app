<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran; // Tambahkan ini
use App\Models\Tagihan;
use Illuminate\Support\Facades\Storage; // Tambahkan ini

class PembayaranController extends Controller
{
    public function index()
    {
        return view('retribusi_sampah');
    }

    public function cekTagihan($nik)
    {
        $tagihan = Tagihan::where('nik', $nik)
                          ->whereIn('statusTagihan', ['Belum Dibayar', 'Menunggu Konfirmasi'])
                          ->first();

        if ($tagihan) {
            return response()->json(['tagihan' => $tagihan]);
        } else {
            return response()->json(['message' => 'Tagihan tidak ditemukan'], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nik' => 'required',
            'nomor_hp' => 'required',
            'rt_rw' => 'required',
            'jumlah' => 'required|numeric',
            'buktiPembayaran' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $imagePath = $request->file('buktiPembayaran')->store('bukti_pembayaran', 'public');
    
        // Cari tagihan yang cocok dengan NIK (Boleh ada lebih dari 1 pembayaran yang masuk sebelum dikonfirmasi)
        // Cari tagihan
        $tagihan = Tagihan::where('nik', $request->nik)
        ->where('statusTagihan', 'Belum Dibayar')
        ->first();

        if (!$tagihan) {
            return redirect()->route('retribusi.sampah')->with('error', 'Tagihan tidak ditemukan.');
        }

        // Simpan pembayaran
        Pembayaran::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'nomor_hp' => $request->nomor_hp,
            'rt_rw' => $request->rt_rw,
            'jumlah' => $request->jumlah,
            'buktiPembayaran' => $imagePath,
            'status' => 'pending',
            'tanggalJatuhTempo' => $tagihan->tanggalJatuhTempo,
        ]);
    
        // Ubah status tagihan menjadi "Menunggu Konfirmasi" (Hanya jika ini pembayaran pertama yang masuk)
        if ($tagihan->statusTagihan == 'Belum Dibayar') {
            $tagihan->update(['statusTagihan' => 'Menunggu Konfirmasi']);
        }
    
        return redirect()->route('retribusi.sampah')->with('success', 'Bukti pembayaran berhasil diunggah! Tunggu konfirmasi dari pengelola.');
    }
    

        public function riwayatPembayaran()
{
    $nik = auth()->user()->nik; // Ambil NIK user yang sedang login

    $tagihan = Tagihan::where('nik', $nik)
                      ->with('pembayaran') // Ambil data pembayaran yang terkait
                      ->orderBy('tanggalJatuhTempo', 'desc') // Urutkan dari yang terbaru
                      ->get();

    return view('riwayat_pembayaran', compact('tagihan'));
}

}