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
            'RW' => 'required|string',
            'JumlahKK' => 'required|integer',
            'KetuaRW' => 'required|string',
            'Iuran' => 'required|numeric',
        ]);

        RW::create([
            'RW' => $request->RW,
            'JumlahKK' => $request->JumlahKK,
            'KetuaRW' => $request->KetuaRW,
            'Iuran' => $request->Iuran,
        ]);

        return redirect()->route('data_rw')->with('success', 'Data RW berhasil ditambahkan!');
    }

    public function update(Request $request, $idRW)
    {
        $request->validate([
            'RW' => 'required|string',
            'JumlahKK' => 'required|integer',
            'KetuaRW' => 'required|string',
            'Iuran' => 'required|numeric',
        ]);
    
        $rw = RW::findOrFail($idRW);
        $rw->RW = $request->RW;
        $rw->JumlahKK = $request->JumlahKK;
        $rw->KetuaRW = $request->KetuaRW;
        $rw->Iuran = $request->Iuran;
        $rw->save();
    
        return redirect()->route('data_rw')->with('success', 'Data RW berhasil diperbarui!');
    }
    
    

public function destroy($idRW)
{
    $rw = RW::where('idRW', $idRW)->firstOrFail();
    $rw->delete();

    return redirect()->route('data_rw')->with('success', 'Data RW berhasil dihapus!');
}
}
