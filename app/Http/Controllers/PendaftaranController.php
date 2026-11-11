<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\PengaturanPpdb;

class PendaftaranController extends Controller
{
    // Status yang tidak boleh mengubah formulir
    private $statusTerkunci = [
        'Terverifikasi',
        'Lulus',
        'Tidak Lulus',
        'Ditolak',
    ];

    public function create()
    {
        $pendaftaran = Pendaftaran::where(
            'user_id',
            auth()->id()
        )->first();

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

        $formulirTerkunci = $pendaftaran
            && in_array(
                trim($pendaftaran->status ?? ''),
                $this->statusTerkunci
            );

        return view(
            'pendaftaran',
            compact(
                'pendaftaran',
                'pendaftaranDitutup',
                'pengaturan',
                'formulirTerkunci'
            )
        );
    }

    public function store(Request $request)
    {
        $pendaftaranSiswa = Pendaftaran::where(
            'user_id',
            auth()->id()
        )->first();

        // Cegah perubahan jika status sudah terkunci
        if (
            $pendaftaranSiswa &&
            in_array(
                trim($pendaftaranSiswa->status ?? ''),
                $this->statusTerkunci
            )
        ) {
            return redirect('/dashboard')->with(
                'error',
                'Formulir tidak dapat diubah karena sudah masuk tahap verifikasi atau pengumuman.'
            );
        }

        // Periksa jadwal dan kuota untuk pendaftaran baru
        if (!$pendaftaranSiswa) {
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
        }

        $validated = $request->validate([
            // Data calon siswa
            'nama_lengkap' => 'required|string',
            'nik' => ['required', 'regex:/^[0-9]{16}$/'],
            'nisn' => ['required', 'regex:/^[0-9]{10}$/'],
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
            'email_orang_tua' => [
                'required',
                'email',
                'max:255'
            ],
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.regex' => 'NIK harus terdiri dari tepat 16 digit angka.',
            'nisn.required' => 'NISN wajib diisi.',
            'nisn.regex' => 'NISN harus terdiri dari tepat 10 digit angka.',
            'email_orang_tua.required' => 'Email orang tua wajib diisi.',
            'email_orang_tua.email' => 'Format email orang tua tidak valid.',
        ]);

        if ($pendaftaranSiswa) {
            $pendaftaranSiswa->update($validated);

            $pesan = 'Data formulir pendaftaran berhasil diperbarui.';
        } else {
            $validated['user_id'] = auth()->id();

            Pendaftaran::create($validated);

            $pesan = 'Data pendaftaran berhasil disimpan.';
        }

        return redirect('/dashboard')->with('success', $pesan);
    }
}
