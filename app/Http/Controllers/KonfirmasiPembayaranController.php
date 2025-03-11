<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Tagihan;

class KonfirmasiPembayaranController extends Controller
{
    public function index()
    {
        $pembayaran = Pembayaran::where('status', 'pending')->get();
        return view('konfirmasi_pembayaran', compact('pembayaran'));
    }

    public function konfirmasi($idPembayaran)
    {
        $pembayaran = Pembayaran::findOrFail($idPembayaran);
        $pembayaran->update(['status' => 'lunas']);

        $tagihan = Tagihan::where('nik', $pembayaran->nik)
                          ->where('statusTagihan', 'Menunggu Konfirmasi')
                          ->first();
        if ($tagihan) {
            $tagihan->update(['statusTagihan' => 'Lunas']);
        }

        return redirect()->route('konfirmasi.pembayaran')->with('success', 'Pembayaran berhasil dikonfirmasi.');
    }
}