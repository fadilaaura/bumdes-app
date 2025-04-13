<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KonfirmasiIuran;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan');
    }

    public function exportToExcel(Request $request)
    {
        // Validasi input dari request
        $request->validate([
            'rentang_waktu_awal' => 'nullable|date',
            'rentang_waktu_akhir' => 'nullable|date',
            'pilihan_data' => 'nullable|in:kk,rw,rt',
            'rw' => 'nullable|string|max:5',
            'rt' => 'nullable|string|max:5',
        ]);

        $rentang_waktu_awal = $request->rentang_waktu_awal;
        $rentang_waktu_akhir = $request->rentang_waktu_akhir;
        $pilihan_data = $request->pilihan_data;
        $rw = $request->rw;
        $rt = $request->rt;

        $query = DB::table('tagihan')
            ->leftJoin('kepala_keluarga', 'tagihan.nik', '=', 'kepala_keluarga.nik')
            ->select(
                'tagihan.nama',
                'tagihan.nik',
                'tagihan.nomor_hp',
                'tagihan.rt_rw',
                'tagihan.jumlah',
                'tagihan.statusTagihan',
                'tagihan.tanggalPembuatan',
                'tagihan.tanggalJatuhTempo',
            );

        if ($rentang_waktu_awal && $rentang_waktu_akhir) {
            $query->whereBetween('tagihan.tanggalPembuatan', [$rentang_waktu_awal, $rentang_waktu_akhir]);
        }

        if ($pilihan_data === 'kk') {
        } elseif ($pilihan_data === 'rw' && $rw) {
            $query->whereRaw("SUBSTRING_INDEX(tagihan.rt_rw, '/', -1) = ?", [$rw]);
        } elseif ($pilihan_data === 'rt' && $rt && $rw) {
            $query->whereRaw("SUBSTRING_INDEX(tagihan.rt_rw, '/', 1) = ?", [$rt])
                  ->whereRaw("SUBSTRING_INDEX(tagihan.rt_rw, '/', -1) = ?", [$rw]);
        }        

        $data = $query->orderBy('tagihan.tanggalPembuatan', 'asc')->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->mergeCells('A1:H1');
        $sheet->setCellValue('A1', 'LAPORAN IURAN SAMPAH BUMDes Spirit Mejabar');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $headers = [
            'Nama', 'NIK', 'Nomor HP', 'RT/RW', 'Jumlah Tagihan', 'Status Tagihan',
            'Tanggal Pembuatan', 'Tanggal Jatuh Tempo'
        ];
        $col = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($col . '3', $header);
            $sheet->getStyle($col . '3')->getFont()->setBold(true);
            $sheet->getColumnDimension($col)->setAutoSize(true);
            $col++;
        }

        // Isi data
        $row = 4;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item->nama);
            $sheet->setCellValue('B' . $row, $item->nik);
            $sheet->setCellValue('C' . $row, $item->nomor_hp);
            $sheet->setCellValue('D' . $row, $item->rt_rw);
            $sheet->setCellValue('E' . $row, $item->jumlah);
            $sheet->setCellValue('F' . $row, $item->statusTagihan);
            $sheet->setCellValue('G' . $row, $item->tanggalPembuatan);
            $sheet->setCellValue('H' . $row, $item->tanggalJatuhTempo);
            $row++;
        }

        $sheet->getStyle('E2:E' . ($row - 1))
            ->getNumberFormat()
            ->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

            // Hitung total tagihan per RT/RW
    $grouped = $data->groupBy('rt_rw')->map(fn($items) => $items->sum('jumlah'));

    $chartStartRow = $row + 2;
    $sheet->setCellValue("A{$chartStartRow}", 'RT/RW');
    $sheet->setCellValue("B{$chartStartRow}", 'Total Tagihan');
    $chartRow = $chartStartRow + 1;
    foreach ($grouped as $rt_rw => $total) {
        $sheet->setCellValue("A{$chartRow}", $rt_rw);
        $sheet->setCellValue("B{$chartRow}", $total);
        $chartRow++;
    }

    // ==== CHART SETUP ====
    $labelRange = "Worksheet!\$B\${$chartStartRow}";
    $categoryRange = "Worksheet!\$A\$" . ($chartStartRow + 1) . ":\$A\$" . ($chartRow - 1);
    $valueRange = "Worksheet!\$B\$" . ($chartStartRow + 1) . ":\$B\$" . ($chartRow - 1);

    $labels = [new \PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues('String', $labelRange, null, 1)];
    $categories = [new \PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues('String', $categoryRange, null, count($grouped))];
    $values = [new \PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues('Number', $valueRange, null, count($grouped))];

    // === Bar Chart ===
    $barSeries = new \PhpOffice\PhpSpreadsheet\Chart\DataSeries(
        \PhpOffice\PhpSpreadsheet\Chart\DataSeries::TYPE_BARCHART,
        \PhpOffice\PhpSpreadsheet\Chart\DataSeries::GROUPING_CLUSTERED,
        range(0, count($values) - 1),
        $labels, $categories, $values
    );
    $barPlotArea = new \PhpOffice\PhpSpreadsheet\Chart\PlotArea(null, [$barSeries]);
    $barLegend = new \PhpOffice\PhpSpreadsheet\Chart\Legend(\PhpOffice\PhpSpreadsheet\Chart\Legend::POSITION_RIGHT, null, false);
    $barChart = new \PhpOffice\PhpSpreadsheet\Chart\Chart(
        'bar_chart',
        new \PhpOffice\PhpSpreadsheet\Chart\Title('Total Iuran per RT/RW'),
        $barLegend,
        $barPlotArea
    );
    $barChart->setTopLeftPosition("D{$chartStartRow}");
    $barChart->setBottomRightPosition("L" . ($chartStartRow + 15));
    $sheet->addChart($barChart);

    // === Pie Chart ===
    $pieSeries = new \PhpOffice\PhpSpreadsheet\Chart\DataSeries(
        \PhpOffice\PhpSpreadsheet\Chart\DataSeries::TYPE_PIECHART,
        null,
        range(0, count($values) - 1),
        $labels, $categories, $values
    );
    $piePlotArea = new \PhpOffice\PhpSpreadsheet\Chart\PlotArea(null, [$pieSeries]);
    $pieLegend = new \PhpOffice\PhpSpreadsheet\Chart\Legend(\PhpOffice\PhpSpreadsheet\Chart\Legend::POSITION_RIGHT, null, false);
    $pieChart = new \PhpOffice\PhpSpreadsheet\Chart\Chart(
        'pie_chart',
        new \PhpOffice\PhpSpreadsheet\Chart\Title('Persentase Iuran per RT/RW'),
        $pieLegend,
        $piePlotArea
    );
    $pieChart->setTopLeftPosition("D" . ($chartStartRow + 17));
    $pieChart->setBottomRightPosition("L" . ($chartStartRow + 32));
    $sheet->addChart($pieChart);

// Output file ke browser
$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
$writer->setIncludeCharts(true);
$filename = 'laporan_iuran_sampah.xlsx';


        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }
}
