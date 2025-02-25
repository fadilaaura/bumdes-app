<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tagihan;

class TagihanController extends Controller
{
    public function index()
    {
        $tagihan = Tagihan::all();
        return view('kelola_tagihan', compact('tagihan'));
    }

    public function create()
    {
        return view('tambah_tagihan');
    }

    public function confirm()
    {
        return view('konfirmasi_tagihan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nomor_hp' => 'required',
            'rt_rw' => 'required',
            'tagihan' => 'required|numeric'
        ]);

        Tagihan::create($request->all());

        return redirect()->route('tagihan.index')->with('success', 'Tagihan berhasil ditambahkan');
    }

    public function destroy($id)
    {
        Tagihan::findOrFail($id)->delete();
        return redirect()->route('tagihan.index')->with('success', 'Tagihan berhasil dihapus');
    }
}
