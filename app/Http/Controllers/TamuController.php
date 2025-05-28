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
        $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'instansi' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:20',
            'tujuan_kunjungan' => 'required|string',
            'bidang' => 'required|string|max:255',
        ]);

        Tamu::create($request->all());

        return redirect()->back()->with('success', 'Terima kasih, data tamu berhasil dikirim.');
    }
}

