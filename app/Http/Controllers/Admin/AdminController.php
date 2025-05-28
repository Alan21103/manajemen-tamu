<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tamu;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $tamu = Tamu::latest()->get();
        return view('admin.index', compact('tamu'));
    }

    public function Dashboard()
    {
        $tamu = Tamu::all(); // ambil semua data tamu dari DB
        return view('dashboard', compact('tamu'));
    }

    public function export()
    {
        $tamu = Tamu::all();

        $filename = 'data_tamu_' . now()->format('Ymd_His') . '.csv';
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
        ];

        $callback = function () use ($tamu) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Nama', 'Instansi', 'Tanggal', 'Jam', 'Tujuan', 'Status']);

            foreach ($tamu as $item) {
                fputcsv($file, [
                    $item->nama,
                    $item->instansi,
                    $item->tanggal,
                    $item->jam,
                    $item->tujuan,
                    $item->status
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}

