<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanPpdb extends Model
{
    protected $table = 'pengaturan_ppdb';

    protected $fillable = [
        'kuota',
        'tanggal_buka',
        'tanggal_tutup',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_buka' => 'datetime',
            'tanggal_tutup' => 'datetime',
        ];
    }
}