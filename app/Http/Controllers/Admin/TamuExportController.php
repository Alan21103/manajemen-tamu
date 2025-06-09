<?php

namespace App\Http\Controllers\Admin;

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
        $tamu = Tamu::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $headers = [
            'No', 'Nama', 'Instansi', 'Tanggal', 'Jam', 'Tujuan', 'No Telepon', 'Bidang', 'Rating'
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
            $sheet->setCellValue('I' . $row, $item->rating);
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
}
