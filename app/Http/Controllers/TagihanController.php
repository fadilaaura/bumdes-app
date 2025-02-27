<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tagihan;

class TagihanController extends Controller
{
    public function index()
    {
        $tagihans = Tagihan::all();
        return view('tambah_tagihan', compact('tagihans'));
    }

    public function create()
    {
        return view('form_tambah_tagihan');
    }

    public function confirm()
    {
        return view('konfirmasi_tagihan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nik' => 'required|numeric',
            'nomor_hp' => 'required',
            'rt_rw' => 'required',
            'jumlah' => 'required|numeric',
            'statusTagihan' => 'required',
            'tanggalPembuatan' => 'required|date',
            'tanggalJatuhTempo' => 'required|date',
        ]);
    
        Tagihan::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'nomor_hp' => $request->nomor_hp,
            'rt_rw' => $request->rt_rw,
            'jumlah' => $request->jumlah,
            'statusTagihan' => $request->statusTagihan,
            'tanggalPembuatan' => $request->tanggalPembuatan,
            'tanggalJatuhTempo' => $request->tanggalJatuhTempo,
        ]);
    
        return redirect()->route('tagihan.index')->with('success', 'Tagihan berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $tagihan = Tagihan::findOrFail($id);
        $tagihan->delete();
    
        return redirect()->route('tagihan.index')->with('success', 'Tagihan berhasil dihapus!');
    }
    

    public function edit($id)
{
    $tagihan = Tagihan::findOrFail($id);
    return view('edit_tagihan', compact('tagihan'));
}
public function update(Request $request, $id)
{
    $request->validate([
        'nama' => 'required',
        'nik' => 'required|numeric',
        'nomor_hp' => 'required',
        'rt_rw' => 'required',
        'jumlah' => 'required|numeric',
        'statusTagihan' => 'required',
        'tanggalPembuatan' => 'required|date',
        'tanggalJatuhTempo' => 'required|date',
    ]);

    $tagihan = Tagihan::where('idTagihan', $id)->firstOrFail();

    $tagihan->update([
        'nama' => $request->nama,
        'nik' => $request->nik,
        'nomor_hp' => $request->nomor_hp,
        'rt_rw' => $request->rt_rw,
        'jumlah' => $request->jumlah,
        'statusTagihan' => $request->statusTagihan,
        'tanggalPembuatan' => $request->tanggalPembuatan,
        'tanggalJatuhTempo' => $request->tanggalJatuhTempo,
    ]);

    return redirect()->route('tagihan.index')->with('success', 'Tagihan berhasil diperbarui!');
}


}
