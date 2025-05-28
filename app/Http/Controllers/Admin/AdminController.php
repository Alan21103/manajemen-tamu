<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tamu;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Menampilkan data tamu dengan pencarian dan sorting
    public function index(Request $request)
    {
        // Ambil input pencarian dan sorting dari query string
        $search = $request->input('search');
        $sort = $request->input('sort', 'desc'); // default urut terbaru

        // Mulai query tamu
        $query = Tamu::query();

        // Filter pencarian berdasarkan nama, instansi, atau tujuan kunjungan
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('instansi', 'like', "%{$search}%")
                  ->orWhere('tujuan_kunjungan', 'like', "%{$search}%");
            });
        }

        // Sorting berdasarkan tanggal kunjungan
        if ($sort === 'asc') {
            $query->orderBy('tanggal', 'asc');
        } else {
            $query->orderBy('tanggal', 'desc');
        }

        // Pagination 10 data per halaman dan sertakan query string agar tetap di pagination
        $tamu = $query->paginate(10)->withQueryString();

        return view('admin.index', compact('tamu'));
    }

    // Method untuk menampilkan dashboard, bisa disesuaikan sesuai kebutuhan
    public function dashboard()
    {
        $tamu = Tamu::all(); // ambil semua data tamu
        return view('dashboard', compact('tamu'));
    }

    // Export data tamu ke CSV
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
