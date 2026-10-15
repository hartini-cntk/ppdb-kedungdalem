<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengaturanPpdb;

class PengaturanPpdbController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'kuota' => 'required|integer|min:1',
        ]);

        $pengaturan = PengaturanPpdb::first();

        if (!$pengaturan) {
            $pengaturan = PengaturanPpdb::create([
                'kuota' => 100,
            ]);
        }

        $pengaturan->update([
            'kuota' => $request->kuota,
        ]);

        return redirect('/admin/dashboard')->with(
            'success',
            'Kuota PPDB berhasil diperbarui.'
        );
    }
}