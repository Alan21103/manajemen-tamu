<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'rating';

    protected $fillable = [
        'tamu_id', 'nilai', 'komentar', 'diisi_pada',
    ];

    public function tamu()
    {
        return $this->belongsTo(Tamu::class, 'tamu_id');
    }
}
