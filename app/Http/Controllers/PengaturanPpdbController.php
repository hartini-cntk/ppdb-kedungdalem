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
}