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
        'tanggal_daftar_ulang',
        'jam_daftar_ulang',
        'lokasi_daftar_ulang',
        'persyaratan_daftar_ulang',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_buka' => 'datetime',
            'tanggal_tutup' => 'datetime',
            'tanggal_daftar_ulang' => 'date',
        ];
    }
}
