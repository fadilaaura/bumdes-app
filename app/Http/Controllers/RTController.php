<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RT;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RTController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('perPage', 10); // Default 10 data per halaman

        $dataRT = RT::when($search, function ($query, $search) {
            return $query->where('RTRW', 'like', '%' . $search . '%')
                         ->orWhere('KetuaRT', 'like', '%' . $search . '%');
        })->paginate($perPage);

        return view('data_rt', compact('dataRT', 'search'));
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

    public function export()
{
    $rt = RT::all();

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Header kolom
    $headers = ['No.', 'ID RT', 'RT/RW', 'Jumlah KK', 'Ketua RT', 'Iuran'];
    $columnIndex = 'A';

    foreach ($headers as $header) {
        $sheet->setCellValue($columnIndex . '1', $header);
        $columnIndex++;
    }

    $sheet->getStyle('A1:F100')->getFont()->setName('Times New Roman');

    $sheet->getStyle('A1:F1')->getFont()->setBold(true);

    // Isi data
    $row = 2;
    $totalKK = 0;
    $totalIuran = 0;
    foreach ($rt as $index => $rt) {
        $sheet->setCellValue('A' . $row, $index + 1);
        $sheet->setCellValue('B' . $row, $rt->idRT);
        $sheet->setCellValue('C' . $row, $rt->RTRW);
        $sheet->setCellValue('D' . $row, $rt->JumlahKK);
        $sheet->setCellValue('E' . $row, $rt->KetuaRT);
        $formattedIuran = 'Rp ' . number_format($rt->Iuran, 0, ',', '.');
        $sheet->setCellValue('F' . $row, $formattedIuran);

        $totalKK += $rt->JumlahKK;
        $totalIuran += $rt->Iuran;

        $row++;
    }

    $sheet->setCellValue('A' . $row, 'Total');
    $sheet->setCellValue('D' . $row, $totalKK);
    $sheet->setCellValue('F' . $row, 'Rp ' . number_format($totalIuran, 0, ',', '.'));

    $sheet->getStyle('A' . $row . ':F' . $row)->getFont()->setBold(true);

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
    $sheet->getStyle('A1:F' . $lastRow)->applyFromArray($styleArray);

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
    $sheet->getStyle('A1:F1')->applyFromArray($headerTotalStyle);
    $sheet->getStyle('A' . $lastRow . ':F' . $lastRow)->applyFromArray($headerTotalStyle);

    foreach (range('A', 'F') as $columnID) {
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
    $response->headers->set('Content-Disposition', 'attachment; filename="Data_RT.xlsx"');

    return $response;
}
}
