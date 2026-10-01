<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pendaftaran;

class Berkas extends Model
{
    protected $table = 'berkas';

    protected $primaryKey = 'id_berkas';

    protected $fillable = [
    'id_pendaftaran',
    'jenis_berkas',
    'nama_file',
    'status',
  ];

    public function pendaftaran()
    {
        return $this->belongsTo(
            Pendaftaran::class,
            'id_pendaftaran',
            'id'
        );
    }
}