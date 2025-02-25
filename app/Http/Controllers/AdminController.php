<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $data = [
            'total_iuran' => DB::table('rw')->sum('Iuran') ?? 0,
            'sudah_bayar' => DB::table('rt')->where('Iuran', '>', 0)->count() ?? 0,
            'belum_bayar' => DB::table('rt')->where('Iuran', '=', 0)->count() ?? 0,
            'jumlah_kk' => DB::table('rw')->sum('JumlahKK') ?? 0,
            'jumlah_rt' => DB::table('rt')->count() ?? 0,
            'jumlah_rw' => DB::table('rw')->count() ?? 0,
        ];
    
        return view('dashboard', compact('data'));
    }
    

}
