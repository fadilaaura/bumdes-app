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
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:16|unique:tagihans,nik',
            'rt_rw' => 'required|string|max:10',
            'nomor_hp' => 'required|string|max:15',
            'nominal' => 'required|numeric|min:0',
        ]);

        Tagihan::create($request->all());

        return redirect()->route('tagihan.index')->with('success', 'Tagihan berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        Tagihan::findOrFail($id)->delete();
        return redirect()->route('tagihan.index')->with('success', 'Tagihan berhasil dihapus');
    }
}
