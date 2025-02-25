<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RW;

class RWController extends Controller
{
    public function index()
    {
        $data_rw = RW::all();
        return view('data_rw', compact('data_rw'));
    }

    public function create()
    {
        return view('tambah_rw');
    }

    public function store(Request $request)
    {
        $request->validate([
            'rw' => 'required|string',
            'jumlah_kk' => 'required|integer',
            'ketua_rw' => 'required|string',
            'iuran' => 'required|numeric',
        ]);

        RW::create([
            'rw' => $request->rw,
            'jumlah_kk' => $request->jumlah_kk,
            'ketua_rw' => $request->ketua_rt,
            'nominal' => $request->iuran,
        ]);

        return redirect()->route('data_rw')->with('success', 'Data RW berhasil ditambahkan!');
    }
}
