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
            'RTRW' => 'required|string|max:10',
            'JumlahKK' => 'required|integer',
            'KetuaRT' => 'required|string|max:255',
            'Iuran' => 'required|numeric|min:0',
        ]);

        RT::create([
            'RTRW' => $request->RTRW,
            'JumlahKK' => $request->JumlahKK,
            'KetuaRT' => $request->KetuaRT,
            'Iuran' => $request->Iuran,
        ]);

        return redirect()->route('data_rt')->with('success', 'Data RT berhasil ditambahkan');
    }

    public function update(Request $request, $idRT)
    {
        $request->validate([
            'RTRW' => 'required|string',
            'JumlahKK' => 'required|integer',
            'KetuaRT' => 'required|string',
            'Iuran' => 'required|numeric',
        ]);
    
        $rt = RT::findOrFail($idRT);
        $rt->RTRW = $request->RTRW;
        $rt->JumlahKK = $request->JumlahKK;
        $rt->KetuaRT = $request->KetuaRT;
        $rt->Iuran = $request->Iuran;
        $rt->save();
    
        return redirect()->route('data_rt')->with('success', 'Data RT berhasil diperbarui!');
    }
    
    

public function destroy($idRT)
{
    $rt = RT::where('idRT', $idRT)->firstOrFail();
    $rt->delete();

    return redirect()->route('data_rt')->with('success', 'Data RT berhasil dihapus!');
}



}
