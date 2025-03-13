<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tagihan;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Symfony\Component\HttpFoundation\StreamedResponse;

class TagihanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('perPage', 10); // Default 10 data per halaman

        $tagihans = Tagihan::when($search, function ($query, $search) {
            return $query->where('nama', 'like', '%' . $search . '%')
                         ->orWhere('nik', 'like', '%' . $search . '%')
                         ->orWhere('nomor_hp', 'like', '%' . $search . '%')
                         ->orWhere('rt_rw', 'like', '%' . $search . '%');
        })->paginate($perPage);

        return view('tambah_tagihan', compact('tagihans', 'search'));
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
            'statusTagihan' => 'Belum Dibayar',
            'tanggalPembuatan' => $request->tanggalPembuatan,
            'tanggalJatuhTempo' => $request->tanggalJatuhTempo,
        ]);

        return redirect()->route('tagihan.index')->with('success', 'Tagihan berhasil ditambahkan!');
    }

    public function destroy($idTagihan)
    {
        $tagihan = Tagihan::findOrFail($idTagihan);
        $tagihan->delete();

        return redirect()->route('tagihan.index')->with('success', 'Tagihan berhasil dihapus!');
    }


    public function edit($idTagihan)
    {
        $tagihan = Tagihan::findOrFail($idTagihan);
        return view('edit_tagihan', compact('tagihan'));
    }
    public function update(Request $request, $idTagihan)
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

        $tagihan = Tagihan::where('idTagihan', $idTagihan)->firstOrFail();

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
    
    public function cekTagihan($nik)
    {
        $tagihan = Tagihan::where('nik', $nik)->where('statusTagihan', 'Belum Dibayar')->first();
    
        if ($tagihan) {
            return response()->json([
                'success' => true,
                'tagihan' => [
                    'nama' => $tagihan->nama,
                    'nik' => $tagihan->nik,
                    'nomor_hp' => $tagihan->nomor_hp, // Sesuaikan nama kolom
                    'rt_rw' => $tagihan->rt_rw, // Sesuaikan dengan tabel
                    'jumlah' => $tagihan->jumlah,
                    'tanggalJatuhTempo' => $tagihan->tanggalJatuhTempo, // Tambahkan
                ]
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Tagihan tidak ditemukan untuk NIK ini.'
            ]);
        }
    }
    

    public function export()
{
    $tagihan = Tagihan::all();

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Header kolom
    $headers = ['No.', 'Nama', 'NIK', 'Nomor HP', 'RT/RW', 'Tagihan', 'Status Tagihan', 'Tanggal Pembuatan', 'Tanggal Jatuh Tempo'];
    $columnIndex = 'A';

    foreach ($headers as $header) {
        $sheet->setCellValue($columnIndex . '1', $header);
        $columnIndex++;
    }

    $sheet->getStyle('A1:I100')->getFont()->setName('Times New Roman');

    $sheet->getStyle('A1:I1')->getFont()->setBold(true);

    // Isi data
    $row = 2;
    $totalTagihan = 0;
    foreach ($tagihan as $index => $tagihan) {
        $sheet->setCellValue('A' . $row, $index + 1);
        $sheet->setCellValue('B' . $row, $tagihan->nama);
        $sheet->setCellValueExplicit('C' . $row, $tagihan->nik, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
        $sheet->setCellValue('D' . $row, $tagihan->nomor_hp);
        $sheet->setCellValue('E' . $row, $tagihan->rt_rw);
        $formattedIuran = 'Rp ' . number_format($tagihan->jumlah, 0, ',', '.');
        $sheet->setCellValue('F' . $row, $formattedIuran);
        $sheet->setCellValue('G' . $row, $tagihan->statusTagihan);
        $sheet->setCellValue('H' . $row, $tagihan->tanggalPembuatan);
        $sheet->setCellValue('I' . $row, $tagihan->tanggalJatuhTempo);

        $totalTagihan += $tagihan->jumlah;

        $row++;
    }

    $sheet->setCellValue('A' . $row, 'Total');
    $sheet->setCellValue('F' . $row, 'Rp ' . number_format($totalTagihan, 0, ',', '.'));

    $sheet->getStyle('A' . $row . ':I' . $row)->getFont()->setBold(true);

    // Border untuk semua tabel
    $lastRow = $row;
    $styleArray = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => '000000'], // Hitam
            ],
        ],
    ];
    $sheet->getStyle('A1:I' . $lastRow)->applyFromArray($styleArray);

    // Warna biru untuk header & total
    $headerTotalStyle = [
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => ['argb' => '0D47A1'],
        ],
        'font' => [
            'color' => ['argb' => 'FFFFFF'], // **Putih**
            'bold' => true,
        ],
    ];
    $sheet->getStyle('A1:I1')->applyFromArray($headerTotalStyle);
    $sheet->getStyle('A' . $lastRow . ':I' . $lastRow)->applyFromArray($headerTotalStyle);

    foreach (range('A', 'I') as $columnID) {
        $sheet->getColumnDimension($columnID)->setAutoSize(true);
    }

    for ($r = 1; $r <= $lastRow; $r++) {
        $sheet->getRowDimension($r)->setRowHeight(-1);
    }

    // Simpan sebagai file Excel
    $writer = new Xlsx($spreadsheet);
    $response = new StreamedResponse(function () use ($writer) {
        $writer->save('php://output');
    });

    $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    $response->headers->set('Content-Disposition', 'attachment; filename="Data_Tagihan.xlsx"');

    return $response;
}   
    public function getDataWarga($nik)
    {
        $warga = \DB::table('kepala_keluarga')->where('nik', $nik)->first();

        if ($warga) {
        return response()->json([
            'nama' => $warga->nama,
            'nomor_hp' => $warga->noTelepon, // Sesuaikan dengan nama kolom di kepala_keluarga
            'rt_rw' => $warga->RTRW // Sesuaikan dengan nama kolom di kepala_keluarga
        ]);
    } else {
        return response()->json(['message' => 'Data tidak ditemukan'], 404);
    }
}

}
