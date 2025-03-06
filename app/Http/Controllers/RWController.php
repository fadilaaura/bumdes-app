<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RW;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RWController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('perPage', 10); // Default 10 data per halaman

        $data_rw = RW::when($search, function ($query, $search) {
            return $query->where('RW', 'like', '%' . $search . '%')
                         ->orWhere('KetuaRW', 'like', '%' . $search . '%');
        })->paginate($perPage);
        return view('data_rw', compact('data_rw', 'search'));
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

    public function export()
    {
        $rw = RW::all();
    
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
     
        // Header kolom
        $headers = ['No.', 'ID RW', 'RW', 'Jumlah KK', 'Ketua RW', 'Iuran'];
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
        foreach ($rw as $index => $rw) {
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $rw->idRW);
            $sheet->setCellValue('C' . $row, $rw->RW);
            $sheet->setCellValue('D' . $row, $rw->JumlahKK);
            $sheet->setCellValue('E' . $row, $rw->KetuaRW);
            $formattedIuran = 'Rp ' . number_format($rw->Iuran, 0, ',', '.');
            $sheet->setCellValue('F' . $row, $formattedIuran);
    
            $totalKK += $rw->JumlahKK;
            $totalIuran += $rw->Iuran;

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
        $response->headers->set('Content-Disposition', 'attachment; filename="Data_RW.xlsx"');
    
        return $response;
    }
}
