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
    
        // Perbarui status pembayaran menjadi "Lunas"
        $pembayaran->update(['status' => 'lunas']);
    
        // Cek apakah ada tagihan terkait dengan pembayaran ini
        $tagihan = Tagihan::where('nik', $pembayaran->nik)
                          ->where('statusTagihan', 'Menunggu Konfirmasi')
                          ->first();
    
        if ($tagihan) {
            $tagihan->update(['statusTagihan' => 'Lunas']);
        }
    
        return redirect()->route('konfirmasi.pembayaran')->with('success', 'Pembayaran berhasil dikonfirmasi dan tagihan telah diperbarui.');
    }

    public function tolakAjax(Request $request, $idPembayaran)
    {
        $pembayaran = \App\Models\Pembayaran::findOrFail($idPembayaran);
    
        $pembayaran->status = 'ditolak';
        $pembayaran->save();
    
        // Update status tagihan juga
        $tagihan = \App\Models\Tagihan::where('nik', $pembayaran->nik)
            ->where('statusTagihan', 'Menunggu Konfirmasi')
            ->first();
    
        if ($tagihan) {
            $tagihan->statusTagihan = 'Belum Dibayar';
            $tagihan->save();
        }
    
        return response()->json(['success' => true]);
    }
    
    
    
}