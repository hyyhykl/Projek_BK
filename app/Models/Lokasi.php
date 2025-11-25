<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    protected $fillable = [
        'gedung',
        'ruangan',
    ];

    public function pengajuan() {
        return $this->hasMany(Pengajuan::class);
    }
}
