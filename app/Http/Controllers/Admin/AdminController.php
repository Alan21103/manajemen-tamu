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
        $tamu = $query->paginate(5);

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

                $chartData->push((object) [
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

                $chartData->push((object) [
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

                $chartData->push((object) [
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
    public function dashboard(Request $request)
    {
        $tamu = Tamu::all();
        $today = Carbon::today();

        $jumlahTamu = Tamu::whereDate('created_at', $today)->count();

        $jumlahInstansi = Tamu::whereDate('created_at', $today)
            ->distinct('instansi')
            ->count('instansi');

        // Chart Jumlah Tamu per Bulan
        $tahun = $request->get('tahun', date('Y'));
        $jumlahTamuPerBulan = [];

        for ($bulan = 1; $bulan <= 12; $bulan++) {
            $jumlah = Tamu::whereYear('tanggal', $tahun)
                ->whereMonth('tanggal', $bulan)
                ->count();
            $jumlahTamuPerBulan[] = $jumlah;
        }

        return view('dashboard', compact('jumlahTamu', 'jumlahInstansi', 'tamu', 'jumlahTamuPerBulan', 'tahun'));
    }

    public function tambahdata(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'tanggal' => 'required|date',
            'instansi' => 'required|string',
            'no_telepon' => 'required|string',
            'tujuan_kunjungan' => 'required|string',
            'bidang' => 'required|array',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        $bidang = $request->input('bidang', []);
        $validated['bidang'] = implode(', ', array_filter($bidang));

        Tamu::create($validated);

        return redirect()->back()->with('success', 'Data tamu berhasil ditambahkan.');
    }

    public function form()
    {
        return view('admin.tambahdata-page');
    }

    // public function tambahBerita(Request $request)
    // {
    //     $request->validate([
    //         'judul' => 'required|string|max:255',
    //         'gambar' => 'required|image|max:2048'
    //     ]);

    //     // Simpan gambar
    //     $gambarPath = $request->file('gambar')->store('berita', 'public');

    //     // Ambil berita lama
    //     $path = resource_path('content/berita.json');
    //     $berita = file_exists($path) ? json_decode(file_get_contents($path), true) : [];

    //     // Tambahkan berita baru
    //     $berita[] = [
    //         'judul' => $request->judul,
    //         'gambar' => basename($gambarPath)
    //     ];

    //     // Simpan kembali ke JSON
    //     file_put_contents($path, json_encode($berita, JSON_PRETTY_PRINT));

    //     return redirect()->back()->with('success', 'Berita berhasil ditambahkan!');
    // }
}
