<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Berkas;
use App\Models\Pendaftaran;

class BerkasController extends Controller
{
    // Status pendaftaran yang mengunci upload berkas
    private $statusTerkunci = [
        'Terverifikasi',
        'Lulus',
        'Tidak Lulus',
        'Ditolak',
    ];

    // Menampilkan halaman upload berkas siswa
    public function create()
    {
        $pendaftaran = Pendaftaran::where(
            'user_id',
            auth()->id()
        )->first();

        if (!$pendaftaran) {
            return redirect('/pendaftaran')->with(
                'error',
                'Silakan isi formulir pendaftaran terlebih dahulu sebelum upload berkas.'
            );
        }

        $berkas = Berkas::where(
            'id_pendaftaran',
            $pendaftaran->id
        )->get();

        $berkasTerkunci = in_array(
            $pendaftaran->status,
            $this->statusTerkunci
        );

        return view(
            'upload-berkas',
            compact('berkas', 'berkasTerkunci')
        );
    }

    // Menyimpan dan mengganti berkas siswa
    public function store(Request $request)
    {
        $pendaftaran = Pendaftaran::where(
            'user_id',
            auth()->id()
        )->firstOrFail();

        // Cegah upload atau penggantian setelah status terkunci
        if (in_array(
            $pendaftaran->status,
            $this->statusTerkunci
        )) {
            return redirect('/upload-berkas')->with(
                'error',
                'Upload dan penggantian berkas tidak dapat dilakukan karena pendaftaran sudah dikunci.'
            );
        }

        $daftarBerkas = [
            'kk' => [
                'jenis' => 'Kartu Keluarga',
                'wajib' => true,
            ],
            'akta' => [
                'jenis' => 'Akta Kelahiran',
                'wajib' => true,
            ],
            'ktp_ibu' => [
                'jenis' => 'KTP Ibu',
                'wajib' => true,
            ],
            'pkh' => [
                'jenis' => 'PKH',
                'wajib' => false,
            ],
            'dokumen_lain' => [
                'jenis' => 'Dokumen Pendukung',
                'wajib' => false,
            ],
        ];

        $aturan = [];

        foreach ($daftarBerkas as $input => $detail) {
            $sudahAda = Berkas::where(
                'id_pendaftaran',
                $pendaftaran->id
            )->where(
                'jenis_berkas',
                $detail['jenis']
            )->exists();

            if ($detail['wajib'] && !$sudahAda) {
                $aturan[$input] = 'required|file|mimes:jpg,jpeg,png,pdf|max:2048';
            } else {
                $aturan[$input] = 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048';
            }
        }

        $request->validate($aturan, [
            'required' => 'Dokumen wajib harus diupload.',
            'mimes' => 'Format dokumen harus JPG, JPEG, PNG, atau PDF.',
            'max' => 'Ukuran setiap dokumen maksimal 2 MB.',
        ]);

        foreach ($daftarBerkas as $input => $detail) {
            if (!$request->hasFile($input)) {
                continue;
            }

            $file = $request->file($input);

            $namaFile = $file->store(
                'berkas',
                'public'
            );

            $berkasLama = Berkas::where(
                'id_pendaftaran',
                $pendaftaran->id
            )->where(
                'jenis_berkas',
                $detail['jenis']
            )->first();

            if ($berkasLama) {
                // Hapus file lama
                Storage::disk('public')->delete(
                    $berkasLama->nama_file
                );

                // Ganti dengan file baru
                $berkasLama->update([
                    'nama_file' => $namaFile,
                    'status' => 'Menunggu Verifikasi',
                ]);
            } else {
                // Simpan dokumen baru
                Berkas::create([
                    'id_pendaftaran' => $pendaftaran->id,
                    'jenis_berkas' => $detail['jenis'],
                    'nama_file' => $namaFile,
                    'status' => 'Menunggu Verifikasi',
                ]);
            }
        }

        return redirect('/upload-berkas')->with(
            'success',
            'Berkas berhasil disimpan.'
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
