<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tamu extends Model
{
    use HasFactory;

    // Pastikan nama tabel yang benar
    protected $table = 'tamu';

    // Tentukan field yang boleh diisi
    protected $fillable = [
        'nama',
        'tanggal',
        'instansi',
        'no_telepon',
        'tujuan_kunjungan',
        'bidang',
    ];

     public function rating()
    {
        return $this->hasOne(Rating::class, 'tamu_id');
    }
    
}
