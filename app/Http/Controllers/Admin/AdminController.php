<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tamu;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\Rating;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Mulai query untuk model Tamu
        $query = Tamu::query();

        // Filter pencarian berdasarkan nama, instansi, dan tujuan kunjungan
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                    ->orWhere('instansi', 'like', '%' . $request->search . '%')
                    ->orWhere('tujuan_kunjungan', 'like', '%' . $request->search . '%');
            });
        }

        // Urutan berdasarkan tanggal (default desc)
        $sortOrder = $request->filled('sort') && in_array(strtolower($request->sort), ['asc', 'desc'])
            ? $request->sort
            : 'desc';

        $query->orderBy('tanggal', $sortOrder);

        // Memuat data tamu dengan relasi rating
        $tamu = $query->with('rating')->paginate(5); // Pagination 5 per halaman

        // Ambil filter tahun dan bulan, default tahun ini dan bulan null
        $year = $request->year ?? date('Y');
        $month = $request->month ?? null;

        // Siapkan variabel chart data untuk grafik
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
            // Jika tidak ada filter tahun, default ke tahun sekarang, summary per bulan
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

        // Ambil daftar tahun yang tersedia untuk filter
        $years = Tamu::selectRaw('YEAR(tanggal) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        // Mengembalikan view dengan data yang diperlukan
        return view('admin.index', compact('tamu', 'chartData', 'years', 'year', 'month'));
    }


    // Method untuk menampilkan dashboard, bisa disesuaikan sesuai kebutuhan
    public function dashboard(Request $request)
    {
        // Memuat relasi rating bersama data tamu
        $tamu = Tamu::with('rating')->paginate(10); // Menampilkan 10 data per halaman / Mengambil semua data tamu dengan rating

        // Mengambil jumlah tamu yang dibuat hari ini
        $today = Carbon::today();
        $jumlahTamu = Tamu::whereDate('created_at', $today)->count();

        // Menghitung jumlah instansi yang unik yang dibuat hari ini
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

        // Mengirim data ke view
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
            // 'rating' sudah dihapus dari sini
        ]);

        // Menyimpan data tamu
        $bidang = $request->input('bidang', []);
        $validated['bidang'] = implode(', ', array_filter($bidang));

        // Create Tamu
        $tamu = Tamu::create($validated);

        // Menyimpan rating jika ada
        if ($request->has('rating')) {
            $rating = new Rating();
            $rating->tamu_id = $tamu->id;
            $rating->rating = $request->input('rating');
            $rating->save();
        }

        return redirect()->back()->with('success', 'Data tamu berhasil ditambahkan.');
    }

    public function form()
    {
        return view('admin.tambahdata-page');
    }

    public function destroy($id)
    {
        $tamu = Tamu::findOrFail($id);
        $tamu->delete();

        return redirect()->route('admin.index')->with('success', 'Data berhasil dihapus.');
    }

    public function edit($id)
    {
        $tamu = Tamu::findOrFail($id);
        return view('admin.edit', compact('tamu'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'tanggal' => 'required|date',
            'instansi' => 'required|string',
            'no_telepon' => 'required|string',
            'tujuan_kunjungan' => 'required|string',
            'bidang' => 'required|array',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $tamu = Tamu::findOrFail($id);
        $data = $request->all();
        $data['bidang'] = implode(', ', array_filter($request->bidang));

        $tamu->update($data);

        return redirect()->route('admin.index')->with('success', 'Data tamu berhasil diperbarui.');
    }
}
