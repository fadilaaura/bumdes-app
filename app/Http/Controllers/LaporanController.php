<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KonfirmasiIuran; // Model dari konfirmasi iuran

class LaporanController extends Controller
{
    public function index()
    {
        $data = KonfirmasiIuran::all(); // Ambil data dari tabel konfirmasi iuran
        return view('laporan', compact('data'));
    }
}
