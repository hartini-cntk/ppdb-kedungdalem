<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengaturanPpdb;

class PengaturanPpdbController extends Controller
{
    private function getPengaturan()
    {
        return PengaturanPpdb::firstOrCreate(
            [],
            ['kuota' => 100]
        );
    }

    // Mengatur kuota PPDB
    public function update(Request $request)
    {
        $request->validate([
            'kuota' => 'required|integer|min:1',
        ]);

        $pengaturan = $this->getPengaturan();

        $pengaturan->update([
            'kuota' => $request->kuota,
        ]);

        return redirect('/admin/dashboard')->with(
            'success',
            'Kuota PPDB berhasil diperbarui.'
        );
    }

    // Mengatur jadwal PPDB
    public function updateJadwal(Request $request)
    {
        $request->validate([
            'tanggal_buka' => 'nullable|date',
            'tanggal_tutup' => 'nullable|date|after_or_equal:tanggal_buka',
        ]);

        $pengaturan = $this->getPengaturan();

        $pengaturan->update([
            'tanggal_buka' => $request->tanggal_buka,
            'tanggal_tutup' => $request->tanggal_tutup,
        ]);

        return redirect('/admin/dashboard')->with(
            'success_jadwal',
            'Jadwal PPDB berhasil diperbarui.'
        );
    }

    // Mengatur informasi daftar ulang
    public function updateDaftarUlang(Request $request)
    {
        $request->validate([
            'tanggal_daftar_ulang' => 'nullable|date',
            'jam_daftar_ulang' => 'nullable|string|max:100',
            'lokasi_daftar_ulang' => 'nullable|string|max:255',
            'persyaratan_daftar_ulang' => 'nullable|string|max:5000',
        ]);

        $pengaturan = $this->getPengaturan();

        $pengaturan->update([
            'tanggal_daftar_ulang' => $request->tanggal_daftar_ulang,
            'jam_daftar_ulang' => $request->jam_daftar_ulang,
            'lokasi_daftar_ulang' => $request->lokasi_daftar_ulang,
            'persyaratan_daftar_ulang' => $request->persyaratan_daftar_ulang,
        ]);

        return redirect('/admin/dashboard')->with(
            'success_daftar_ulang',
            'Informasi daftar ulang berhasil diperbarui.'
        );
    }
}
