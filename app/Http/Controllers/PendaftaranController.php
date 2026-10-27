<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\PengaturanPpdb;

class PendaftaranController extends Controller
{
   
public function create()
{
    $pendaftaranSiswa = Pendaftaran::where(
        'user_id',
        auth()->id()
    )->first();

    if ($pendaftaranSiswa) {
        return redirect('/dashboard')->with(
            'error',
            'Kamu sudah mengisi formulir pendaftaran.'
        );
    }

    $pengaturan = PengaturanPpdb::first();

    if (!$pengaturan) {
        $pengaturan = PengaturanPpdb::create([
            'kuota' => 100,
        ]);
    }

$totalPendaftar = Pendaftaran::count();

$waktuSekarang = now();

$belumDibuka = $pengaturan->tanggal_buka
    && $waktuSekarang->lt($pengaturan->tanggal_buka);

$sudahDitutup = $pengaturan->tanggal_tutup
    && $waktuSekarang->gt($pengaturan->tanggal_tutup);

$kuotaPenuh = $totalPendaftar >= $pengaturan->kuota;

$pendaftaranDitutup =
    $belumDibuka || $sudahDitutup || $kuotaPenuh;

    
    return view(
    'pendaftaran',
    compact('pendaftaranDitutup', 'pengaturan')
    );
}


    public function store(Request $request)
    {

    $pendaftaranSiswa = Pendaftaran::where(
    'user_id',
    auth()->id()
)->first();

if ($pendaftaranSiswa) {
    return redirect('/dashboard')->with(
        'error',
        'Kamu sudah mengisi formulir pendaftaran.'
    );
}

$pengaturan = PengaturanPpdb::first();

if (!$pengaturan) {
    $pengaturan = PengaturanPpdb::create([
        'kuota' => 100,
    ]);
}


$totalPendaftar = Pendaftaran::count();
$waktuSekarang = now();

$belumDibuka = $pengaturan->tanggal_buka
    && $waktuSekarang->lt($pengaturan->tanggal_buka);

$sudahDitutup = $pengaturan->tanggal_tutup
    && $waktuSekarang->gt($pengaturan->tanggal_tutup);

$kuotaPenuh = $totalPendaftar >= $pengaturan->kuota;

if ($belumDibuka) {
    return redirect('/pendaftaran')->with(
        'error',
        'Pendaftaran PPDB belum dibuka.'
    );
}

if ($sudahDitutup) {
    return redirect('/pendaftaran')->with(
        'error',
        'Mohon maaf, pendaftaran PPDB sudah ditutup.'
    );
}

if ($kuotaPenuh) {
    return redirect('/pendaftaran')->with(
        'error',
        'Mohon maaf, kuota pendaftaran PPDB sudah terpenuhi.'
    );
}

        $request->validate([
            // Data calon siswa
            'nama_lengkap' => 'required',
            'nik' => 'required',
            'nisn' => 'nullable',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
            'anak_ke' => 'nullable',
            'jumlah_saudara' => 'nullable',

            // Alamat
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'desa' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'provinsi' => 'required',
            'asal_sekolah' => 'required',

            // Data ayah
            'nama_ayah' => 'required',
            'nik_ayah' => 'required',
            'pendidikan_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'penghasilan_ayah' => 'required',

            // Data ibu
            'nama_ibu' => 'required',
            'nik_ibu' => 'required',
            'pendidikan_ibu' => 'required',
            'pekerjaan_ibu' => 'required',
            'penghasilan_ibu' => 'required',

            // Kontak
            'no_hp' => 'required',
        ]);

        Pendaftaran::create([
            'user_id' => auth()->id(),

            // Data calon siswa
            'nama_lengkap' => $request->nama_lengkap,
            'nik' => $request->nik,
            'nisn' => $request->nisn,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama' => $request->agama,
            'anak_ke' => $request->anak_ke,
            'jumlah_saudara' => $request->jumlah_saudara,

            // Alamat
            'alamat' => $request->alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'desa' => $request->desa,
            'kecamatan' => $request->kecamatan,
            'kabupaten' => $request->kabupaten,
            'provinsi' => $request->provinsi,
            'asal_sekolah' => $request->asal_sekolah,

            // Data ayah
            'nama_ayah' => $request->nama_ayah,
            'nik_ayah' => $request->nik_ayah,
            'pendidikan_ayah' => $request->pendidikan_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'penghasilan_ayah' => $request->penghasilan_ayah,

            // Data ibu
            'nama_ibu' => $request->nama_ibu,
            'nik_ibu' => $request->nik_ibu,
            'pendidikan_ibu' => $request->pendidikan_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'penghasilan_ibu' => $request->penghasilan_ibu,

            // Kontak
            'no_hp' => $request->no_hp,
        ]);

        return redirect('/dashboard')->with(
            'success',
            'Data pendaftaran berhasil disimpan.'
        );
    }
}