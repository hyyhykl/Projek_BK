<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $fillable = [
        'nama_pelapor',
        'lokasi_id',
        'deskripsi',
        'foto',
        'status',
    ];

    public function lokasi() {
        return $this->belongsTo(Lokasi::class);
    }
}
