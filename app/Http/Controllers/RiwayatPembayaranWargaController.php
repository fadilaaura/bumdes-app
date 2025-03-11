<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatPembayaranWargaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $nik = $user->nik;

        $kk = \DB::table('kepala_keluarga')->where('nik', $nik)->first();

        $tagihan = Tagihan::where('nik', $nik)->with('pembayaran')->get();

        return view('riwayat_pembayaran', compact('tagihan', 'kk'));
    }
}