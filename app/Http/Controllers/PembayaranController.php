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
        // Ubah status tagihan menjadi "Menunggu Konfirmasi"
        $tagihan = Tagihan::where('nik', $request->nik)
            ->whereIn('statusTagihan', ['Belum Dibayar', 'Menunggu Konfirmasi'])
            ->first();

        if ($tagihan) {
            $tagihan->update(['statusTagihan' => 'Menunggu Konfirmasi']);
        }

        return redirect()->route('retribusi.sampah')->with('success', 'Pembayaran berhasil disimpan!');
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