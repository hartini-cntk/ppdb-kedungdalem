<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Berkas;

class Pendaftaran extends Model
{
    protected $fillable = [
        'user_id',

        // Data calon siswa
        'nama_lengkap',
        'nisn',
        'nik',
        'alamat',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'anak_ke',
        'jumlah_saudara',
        'asal_sekolah',

        // Detail alamat
        'rt',
        'rw',
        'desa',
        'kecamatan',
        'kabupaten',
        'provinsi',

        // Data ayah
        'nama_ayah',
        'nik_ayah',
        'pendidikan_ayah',
        'pekerjaan_ayah',
        'penghasilan_ayah',

        // Data ibu
        'nama_ibu',
        'nik_ibu',
        'pendidikan_ibu',
        'pekerjaan_ibu',
        'penghasilan_ibu',

        // Kontak
        'no_hp',

        // Status
        'status',
    ];

    public function berkas()
    {
        return $this->hasMany(Berkas::class, 'id_pendaftaran', 'id');
    }
}