<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tamu;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class TamuExportController extends Controller
{
    public function export()
    {
        // Mengambil data tamu dengan relasi rating
        $tamu = Tamu::with('rating')->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $headers = [
            'No',
            'Nama',
            'Instansi',
            'Tanggal',
            'Jam',
            'Tujuan',
            'No Telepon',
            'Bidang',
            'Rating'
        ];

        // Tulis header dengan style
        $col = 'A';
        foreach ($headers as $header) {
            $cell = $col . '1';
            $sheet->setCellValue($cell, $header);

            // Bold & warna latar header
            $sheet->getStyle($cell)->getFont()->setBold(true);
            $sheet->getStyle($cell)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('D9E1F2');

            // Center align
            $sheet->getStyle($cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

            $col++;
        }

        // Tulis data
        $row = 2;
        foreach ($tamu as $index => $item) {
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $item->nama);
            $sheet->setCellValue('C' . $row, $item->instansi);
            $sheet->setCellValue('D' . $row, \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y'));
            $sheet->setCellValue('E' . $row, \Carbon\Carbon::parse($item->jam)->format('H:i'));
            $sheet->setCellValue('F' . $row, $item->tujuan_kunjungan);
            $sheet->setCellValue('G' . $row, $item->no_telepon);
            $sheet->setCellValue('H' . $row, $item->bidang);

            // Mengambil rating dari relasi
            $sheet->setCellValue('I' . $row, optional($item->rating)->nilai); // Mengambil nilai rating dari relasi

            $row++;
        }

        // Border untuk semua data (header + isi)
        $lastColumn = chr(ord('A') + count($headers) - 1);
        $dataRange = "A1:{$lastColumn}" . ($row - 1);

        $sheet->getStyle($dataRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        // Auto width kolom
        for ($col = 'A'; $col !== chr(ord($lastColumn) + 1); $col++) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Set filename
        $fileName = 'data_tamu_' . date('Ymd_His') . '.xlsx';

        // Header HTTP
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }


    public function exportPage(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $query = Tamu::with('rating'); // Memuat data rating bersama tamu

        // Filter berdasarkan bulan dan tahun
        if ($bulan && $tahun) {
            $query->whereMonth('tanggal', $bulan)
                ->whereYear('tanggal', $tahun);
        } elseif ($bulan) {
            $query->whereMonth('tanggal', $bulan);
        } elseif ($tahun) {
            $query->whereYear('tanggal', $tahun);
        }

        // Ambil data tamu dengan rating
        $tamu = $query->with('rating')->orderBy('tanggal', 'desc')->paginate(10);

        // Ambil daftar tahun untuk filter
        $tahunList = Tamu::select(DB::raw('YEAR(tanggal) as tahun'))
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        // Mengirim data ke view
        return view('admin.export-page', compact('tamu', 'tahunList'));
    }

}
