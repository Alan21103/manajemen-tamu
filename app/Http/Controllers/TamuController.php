<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tamu;

class TamuController extends Controller
{
    public function create()
    {
        return view('tamu.public.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'tanggal' => 'required|date',
            'instansi' => 'required|string',
            'no_telepon' => 'required|string',
            'tujuan_kunjungan' => 'required|string',
            'bidang' => 'required|array',
        ]);

        $bidang = $request->input('bidang', []);
        $validated['bidang'] = implode(', ', array_filter($bidang)); 

        Tamu::create($validated);
        return redirect()->back()->with('success', 'Data tamu berhasil dikirim.');
    }
}

