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

    public function tolak(Request $request, $idPembayaran)
    {
        $request->validate([
            'alasan_penolakan' => 'required|string|max:255',
        ]);
    
        $pembayaran = Pembayaran::findOrFail($idPembayaran);
    
        // Simpan alasan penolakan
        $pembayaran->status = 'ditolak';
        $pembayaran->alasan_penolakan = $request->alasan_penolakan;
        $pembayaran->save(); // <-- Pastikan update dilakukan dengan save()
    
        // Kembalikan status tagihan ke "Belum Dibayar"
        $tagihan = Tagihan::where('nik', $pembayaran->nik)
                          ->where('statusTagihan', 'Menunggu Konfirmasi')
                          ->first();
    
        if ($tagihan) {
            $tagihan->statusTagihan = 'Belum Dibayar';
            $tagihan->save(); // <-- Pastikan perubahan disimpan
        }
    
        return redirect()->route('konfirmasi.pembayaran')->with('error', 'Pembayaran ditolak dengan alasan: ' . $request->input('alasan_penolakan'));
    }
    
}