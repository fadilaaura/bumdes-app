<?php

namespace App\Http\Controllers;

use App\Models\KepalaKeluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Symfony\Component\HttpFoundation\StreamedResponse;

class KepalaKeluargaController extends Controller
{
    public function index()
    {
        $kepala_keluarga = KepalaKeluarga::all();
        return view('data_kk', compact('kepala_keluarga'));
    }

    public function create()
    {
        return view('tambah_kk');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|size:16|unique:kepala_keluarga,nik',
            'pin' => 'required|string|min:4',
            'email' => 'nullable|email|unique:kepala_keluarga,email',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'noTelepon' => 'required|string|max:15',
            'peranUser' => 'required|string|max:50',
            'RTRW' => 'required|string|regex:/^\d{3}\/\d{2}$/',
            'idRW' => 'required|integer',
            'idRT' => 'required|integer',
        ]);

        KepalaKeluarga::create([
            'nik' => $request->nik,
            'pin' => Hash::make($request->pin),
            'email' => $request->email,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'noTelepon' => $request->noTelepon,
            'peranUser' => $request->peranUser,
            'RTRW' => $request->RTRW,
            'idRW' => $request->idRW,
            'idRT' => $request->idRT,
        ]);

        return redirect()->route('data_kk')->with('success', 'Data Kepala Keluarga berhasil ditambahkan');
    }

    // Update Data
    public function update(Request $request, $idKK)
    {
        $request->validate([
            'nik' => 'required|string|size:16|unique:kepala_keluarga,nik,' . $idKK . ',idKK',
            'pin' => 'required|string|min:4',
            'email' => 'nullable|email',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'noTelepon' => 'required|string|max:15',
            'peranUser' => 'required|string|max:50',
            'RTRW' => 'required|string|regex:/^\d{3}\/\d{2}$/',
            'idRW' => 'required|integer',
            'idRT' => 'required|integer',
        ]);

        $kepalaKeluarga = KepalaKeluarga::findOrFail($idKK);
        $kepalaKeluarga->update([
            'nik' => $request->nik,
            'pin' => Hash::make($request->pin),
            'email' => $request->email,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'noTelepon' => $request->noTelepon,
            'peranUser' => $request->peranUser,
            'RTRW' => $request->RTRW,
            'idRW' => $request->idRW,
            'idRT' => $request->idRT,
        ]);

        return response()->json(['message' => 'Data berhasil diperbarui']);
    }

    public function destroy($id)
    {
        $kk = KepalaKeluarga::findOrFail($id);
        $kk->delete();

        return redirect()->route('data_kk')->with('success', 'Data berhasil dihapus!');
    }

    public function export()
{
    $kepalaKeluarga = KepalaKeluarga::all();

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Header kolom
    $headers = ['No.', 'Nama', 'NIK', 'PIN', 'Email', 'Alamat', 'Nomor HP', 'Peran User', 'RT/RW', 'ID RW', 'ID RT'];
    $columnIndex = 'A';

    foreach ($headers as $header) {
        $sheet->setCellValue($columnIndex . '1', $header);
        $columnIndex++;
    }

    $sheet->getStyle('A1:K100')->getFont()->setName('Times New Roman');

    $sheet->getStyle('A1:K1')->getFont()->setBold(true);

    // Isi data
    $row = 2;
    foreach ($kepalaKeluarga as $index => $kk) {
        $sheet->setCellValue('A' . $row, $index + 1);
        $sheet->setCellValue('B' . $row, $kk->nama);
        $sheet->setCellValueExplicit('C' . $row, $kk->nik, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
        $sheet->setCellValue('D' . $row, $kk->pin);
        $sheet->setCellValue('E' . $row, $kk->email);
        $sheet->setCellValue('F' . $row, $kk->alamat);
        $sheet->setCellValue('G' . $row, $kk->noTelepon);
        $sheet->setCellValue('H' . $row, $kk->peranUser);
        $sheet->setCellValue('I' . $row, $kk->RTRW);
        $sheet->setCellValue('J' . $row, $kk->idRW);
        $sheet->setCellValue('K' . $row, $kk->idRT);
        $row++;
    }

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

        $sheet->getStyle('A1:K' . ($row - 1))->applyFromArray($styleArray);

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

        $sheet->getStyle('A1:K1')->applyFromArray($headerTotalStyle);

        foreach (range('A', 'K') as $columnID) {
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
    $response->headers->set('Content-Disposition', 'attachment; filename="Data_KK.xlsx"');

    return $response;
}
}
