<?php

namespace App\Http\Controllers;

use App\Models\KepalaKeluarga; // Pastikan model KepalaKeluarga digunakan
use App\Http\Controllers\Controller; // Tambahkan ini

class WargaController extends Controller
{
    public function kelolaPeran()
    {
        $warga = KepalaKeluarga::all(); // Mengambil semua data warga dari tabel kepala_keluarga
        return view('kelola_peran', compact('warga'));
    }
}
