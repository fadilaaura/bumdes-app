<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RT;

class RTController extends Controller
{
    public function index()
    {
        $dataRT = RT::all();
        return view('data_rt', compact('dataRT'));
    }

    public function create()
    {
        return view('tambah_rt');
    }

    public function store(Request $request)
    {
        $request->validate([
            'rt_rw' => 'required|string|max:10',
            'jumlah_kk' => 'required|integer',
            'ketua_rt' => 'required|string|max:255',
            'iuran' => 'required|numeric|min:0',
        ]);

        RT::create([
            'rt_rw' => $request->rt_rw,
            'jumlah_kk' => $request->jumlah_kk,
            'ketua_rt' => $request->ketua_rt,
            'iuran' => $request->iuran,
        ]);

        return redirect()->route('data_rt')->with('success', 'Data RT berhasil ditambahkan');
    }
}
