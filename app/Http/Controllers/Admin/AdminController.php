<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tamu;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Tamu::query();

        // Filter pencarian
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                ->orWhere('instansi', 'like', '%' . $request->search . '%')
                ->orWhere('tujuan_kunjungan', 'like', '%' . $request->search . '%');
            });
        }

        // Urutan tanggal
        $sortOrder = $request->filled('sort') && in_array(strtolower($request->sort), ['asc', 'desc'])
                    ? $request->sort
                    : 'desc';

        $query->orderBy('tanggal', $sortOrder);

        // Pagination data tamu
        $tamu = $query->paginate(10);

        // Ambil filter tahun dan bulan, default tahun ini dan bulan null
        $year = $request->year ?? date('Y');
        $month = $request->month ?? null;

        // Siapkan variabel chart data
        $chartData = collect();

        if ($year && !$month) {
            // Jika hanya tahun: summary per bulan
            for ($m = 1; $m <= 12; $m++) {
                $count = Tamu::whereYear('tanggal', $year)
                            ->whereMonth('tanggal', $m)
                            ->count();

                $chartData->push((object)[
                    'label' => \Carbon\Carbon::create($year, $m, 1)->format('M'),
                    'jumlah' => $count,
                ]);
            }
        } elseif ($year && $month) {
            // Jika ada bulan & tahun: summary per tanggal di bulan itu
            $daysInMonth = \Carbon\Carbon::create($year, $month, 1)->daysInMonth;

            for ($d = 1; $d <= $daysInMonth; $d++) {
                $count = Tamu::whereYear('tanggal', $year)
                            ->whereMonth('tanggal', $month)
                            ->whereDay('tanggal', $d)
                            ->count();

                $chartData->push((object)[
                    'label' => $d,
                    'jumlah' => $count,
                ]);
            }
        } else {
            // Jika tidak ada filter tahun, kamu bisa default ke tahun sekarang summary per bulan
            $yearNow = date('Y');
            for ($m = 1; $m <= 12; $m++) {
                $count = Tamu::whereYear('tanggal', $yearNow)
                            ->whereMonth('tanggal', $m)
                            ->count();

                $chartData->push((object)[
                    'label' => \Carbon\Carbon::create($yearNow, $m, 1)->format('M'),
                    'jumlah' => $count,
                ]);
            }
        }

        $years = Tamu::selectRaw('YEAR(tanggal) as year')
                    ->distinct()
                    ->orderBy('year', 'desc')
                    ->pluck('year');

        return view('admin.index', compact('tamu', 'chartData', 'years', 'year', 'month'));
    }


    // Method untuk menampilkan dashboard, bisa disesuaikan sesuai kebutuhan
    public function dashboard()
    {
        $tamu = Tamu::all(); 
        $today = Carbon::today();


        $jumlahTamu = Tamu::whereDate('created_at', $today)->count();
        $jumlahInstansi = Tamu::whereDate('created_at', $today)
            ->distinct('instansi')
            ->count('instansi');

        return view('dashboard', compact('jumlahTamu', 'jumlahInstansi', 'tamu'));

    }

    // // Export data tamu ke CSV
    // public function export()
    // {
    //     $tamu = Tamu::all();

    //     $filename = 'data_tamu_' . now()->format('Ymd_His') . '.csv';
    //     $headers = [
    //         "Content-type" => "text/csv",
    //         "Content-Disposition" => "attachment; filename=$filename",
    //     ];

    //     $callback = function () use ($tamu) {
    //         $file = fopen('php://output', 'w');
    //         fputcsv($file, ['Nama', 'Instansi', 'Tanggal', 'Jam', 'Tujuan', 'Status']);

    //         foreach ($tamu as $item) {
    //             fputcsv($file, [
    //                 $item->nama,
    //                 $item->instansi,
    //                 $item->tanggal,
    //                 $item->jam,
    //                 $item->tujuan,
    //                 $item->status
    //             ]);
    //         }

    //         fclose($file);
    //     };

    //     return response()->stream($callback, 200, $headers);
    // }

    public function Tambahdata()
    {
        return view('admin.tambahdata');
    }


}
