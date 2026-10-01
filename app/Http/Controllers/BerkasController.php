<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berkas;
use App\Models\Pendaftaran;

class BerkasController extends Controller
{
    public function create()
    {
        return view('upload-berkas');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kk' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'akta' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'dokumen_lain' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $pendaftaran = Pendaftaran::where(
            'user_id',
            auth()->id()
        )->firstOrFail();

        // Upload KK
        $namaKK = $request->file('kk')->store(
            'berkas',
            'public'
        );

        Berkas::create([
            'id_pendaftaran' => $pendaftaran->id,
            'jenis_berkas' => 'Kartu Keluarga',
            'nama_file' => $namaKK,
        ]);

        // Upload Akta
        $namaAkta = $request->file('akta')->store(
            'berkas',
            'public'
        );

        Berkas::create([
            'id_pendaftaran' => $pendaftaran->id,
            'jenis_berkas' => 'Akta Kelahiran',
            'nama_file' => $namaAkta,
        ]);

        // Upload dokumen tambahan jika ada
        if ($request->hasFile('dokumen_lain')) {
            $namaDokumen = $request->file('dokumen_lain')->store(
                'berkas',
                'public'
            );

            Berkas::create([
                'id_pendaftaran' => $pendaftaran->id,
                'jenis_berkas' => 'Dokumen Pendukung',
                'nama_file' => $namaDokumen,
            ]);
        }

        return redirect('/dashboard')->with(
            'success',
            'Berkas berhasil diupload.'
        );
    }

    // Terima berkas
    public function terima($id)
    {
        $berkas = Berkas::findOrFail($id);

        $berkas->update([
            'status' => 'Diterima',
        ]);

        return back()->with(
            'success',
            'Berkas berhasil diterima.'
        );
    }

    // Tolak berkas
    public function tolak($id)
    {
        $berkas = Berkas::findOrFail($id);

        $berkas->update([
            'status' => 'Ditolak',
        ]);

        return back()->with(
            'success',
            'Berkas berhasil ditolak.'
        );
    }
}