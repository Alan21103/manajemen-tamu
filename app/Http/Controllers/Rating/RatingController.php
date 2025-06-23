<?php

namespace App\Http\Controllers\Rating;

use App\Http\Controllers\Controller;
use App\Models\Tamu;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class RatingController extends Controller
{

    public function form()
    {
        $tamuHariIni = Tamu::whereDate('tanggal', Carbon::today())->get();
        return view('rating.form', compact('tamuHariIni'));
    }

    public function submit(Request $request)
    {
        $request->validate([
            'tamu_id' => 'required|exists:tamu,id',
            'nilai' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:255',
        ]);

        $tamu = Tamu::findOrFail($request->tamu_id);

        // Cegah rating ganda
        if ($tamu->rating) {
            return redirect()->back()->with('error', 'Anda sudah mengisi rating.');
        }

        // Simpan rating
        $tamu->rating()->create([
            'nilai' => $request->nilai,
            'komentar' => $request->komentar,
        ]);

        return view('rating.berhasil', compact('tamu'));
    }
}
