<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\BerkasController;
use App\Http\Controllers\PengaturanPpdbController;
use App\Models\Pendaftaran;
use App\Models\Berkas;
use App\Models\PengaturanPpdb;


// ==========================
// BERANDA
// ==========================

Route::get('/', function () {

    $pengaturan = PengaturanPpdb::firstOrCreate(
        [],
        ['kuota' => 100]
    );

    $totalPendaftar = Pendaftaran::count();

    $waktuSekarang = now();

    $belumDibuka = $pengaturan->tanggal_buka
        && $waktuSekarang->lt($pengaturan->tanggal_buka);

    $sudahDitutup = $pengaturan->tanggal_tutup
        && $waktuSekarang->gt($pengaturan->tanggal_tutup);

    $kuotaPenuh = $totalPendaftar >= $pengaturan->kuota;

    $pendaftaranDitutup =
        $belumDibuka || $sudahDitutup || $kuotaPenuh;

    return view('home', compact(
        'pengaturan',
        'pendaftaranDitutup',
        'belumDibuka',
        'sudahDitutup',
        'kuotaPenuh'
    ));
});


// ==========================
// REGISTRASI DAN LOGIN
// ==========================

Route::get('/register', [RegisterController::class, 'showRegister']);
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login']);

Route::get('/admin/login', [LoginController::class, 'showAdminLogin']);
Route::post('/admin/login', [LoginController::class, 'adminLogin']);

Route::post('/logout', function () {

    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/login');
});


// ==========================
// DASHBOARD SISWA
// ==========================

Route::get('/dashboard', function () {

    $pendaftaran = Pendaftaran::where(
        'user_id',
        Auth::id()
    )->first();

    $sudahIsiFormulir = $pendaftaran !== null;

    $berkas = collect();

    if ($pendaftaran) {
        $berkas = Berkas::where(
            'id_pendaftaran',
            $pendaftaran->id
        )->get();
    }

    $jenisBerkasWajib = [
        'Kartu Keluarga',
        'Akta Kelahiran',
        'KTP Ibu',
    ];

    $sudahUploadBerkas = collect($jenisBerkasWajib)->every(
        function ($jenis) use ($berkas) {
            return $berkas->contains(
                'jenis_berkas',
                $jenis
            );
        }
    );

    $berkasSudahDiverifikasi =
        $sudahUploadBerkas &&
        $berkas->whereIn(
            'jenis_berkas',
            $jenisBerkasWajib
        )->every(function ($item) {
            return $item->status === 'Diterima';
        });

    $sudahTerverifikasi =
        $pendaftaran &&
        $pendaftaran->status === 'Terverifikasi';

    $hasilSeleksiDiumumkan =
        $pendaftaran &&
        in_array($pendaftaran->status, [
            'Lulus',
            'Tidak Lulus',
        ]);

    $pengaturan = PengaturanPpdb::first();

    $tampilkanDaftarUlang =
        $pendaftaran &&
        $pendaftaran->status === 'Lulus' &&
        $pengaturan &&
        (
            $pengaturan->tanggal_daftar_ulang ||
            $pengaturan->jam_daftar_ulang ||
            $pengaturan->lokasi_daftar_ulang ||
            $pengaturan->persyaratan_daftar_ulang
        );

    return view('dashboard', compact(
        'pendaftaran',
        'sudahIsiFormulir',
        'sudahUploadBerkas',
        'berkasSudahDiverifikasi',
        'sudahTerverifikasi',
        'hasilSeleksiDiumumkan',
        'pengaturan',
        'tampilkanDaftarUlang'
    ));

})->middleware('auth');


// ==========================
// DASHBOARD ADMIN
// ==========================

Route::get('/admin/dashboard', function () {

    $totalPendaftar = Pendaftaran::count();

    $pengaturan = PengaturanPpdb::first();

    if (!$pengaturan) {
        $pengaturan = PengaturanPpdb::create([
            'kuota' => 100,
        ]);
    }

    $kuota = $pengaturan->kuota;

    $sisaKuota = max(
        0,
        $kuota - $totalPendaftar
    );

    $persentaseKuota = $kuota > 0
        ? min(
            100,
            round(($totalPendaftar / $kuota) * 100)
        )
        : 0;

    $menungguVerifikasi = Pendaftaran::where(
        'status',
        'Menunggu Verifikasi'
    )->count();

    $terverifikasi = Pendaftaran::where(
        'status',
        'Terverifikasi'
    )->count();

    $ditolak = Pendaftaran::where(
        'status',
        'Ditolak'
    )->count();

    $lulus = Pendaftaran::where(
        'status',
        'Lulus'
    )->count();

    $pendaftarTerbaru = Pendaftaran::latest()
        ->take(5)
        ->get();

    return view('admin-dashboard', compact(
        'totalPendaftar',
        'menungguVerifikasi',
        'terverifikasi',
        'ditolak',
        'lulus',
        'kuota',
        'pengaturan',
        'sisaKuota',
        'persentaseKuota',
        'pendaftarTerbaru'
    ));

})->middleware('auth');


// ==========================
// DATA PENDAFTAR ADMIN
// ==========================

Route::get('/admin/pendaftar', function () {

    $pendaftarans = Pendaftaran::latest()->get();

    return view(
        'admin-pendaftar',
        compact('pendaftarans')
    );

})->middleware('auth');

Route::get('/admin/pendaftar/{id}', function ($id) {

    $pendaftaran = Pendaftaran::findOrFail($id);

    return view(
        'admin-detail-pendaftar',
        compact('pendaftaran')
    );

})->middleware('auth');


// ==========================
// CATATAN PERBAIKAN ADMIN
// ==========================

Route::post('/admin/pendaftar/{id}/catatan', function (Request $request, $id) {

    $request->validate([
        'catatan_admin' => ['nullable', 'string', 'max:5000'],
    ]);

    $pendaftaran = Pendaftaran::findOrFail($id);

    $pendaftaran->catatan_admin = $request->catatan_admin;
    $pendaftaran->save();

    return back()->with(
        'success',
        'Catatan perbaikan berhasil disimpan.'
    );

})->middleware('auth');


Route::delete('/admin/pendaftar/{id}/catatan', function ($id) {

    $pendaftaran = Pendaftaran::findOrFail($id);

    $pendaftaran->update([
        'catatan_admin' => null,
    ]);

    return back()->with(
        'success',
        'Catatan perbaikan berhasil dihapus.'
    );

})->middleware('auth');


// ==========================
// TERIMA SEMUA BERKAS SATU PENDAFTAR
// ==========================

Route::post('/admin/pendaftar/{id}/terima-semua-berkas', function ($id) {

    $pendaftaran = Pendaftaran::findOrFail($id);

    // Jangan mengubah berkas jika hasil seleksi sudah ditetapkan
    if (in_array($pendaftaran->status, ['Lulus', 'Tidak Lulus'])) {
        return back()->with(
            'error',
            'Hasil seleksi sudah ditetapkan. Berkas tidak dapat diubah.'
        );
    }

    // Hanya menerima berkas yang masih menunggu verifikasi
    $jumlahDiubah = Berkas::where(
        'id_pendaftaran',
        $pendaftaran->id
    )->where(
        'status',
        'Menunggu Verifikasi'
    )->update([
        'status' => 'Diterima',
    ]);

    if ($jumlahDiubah === 0) {
        return back()->with(
            'error',
            'Tidak ada berkas yang menunggu verifikasi.'
        );
    }

    return back()->with(
        'success',
        $jumlahDiubah . ' berkas berhasil diterima.'
    );

})->middleware('auth');


// ==========================
// VERIFIKASI PENDAFTARAN
// ==========================

Route::post('/admin/pendaftar/{id}/verifikasi', function ($id) {

    $pendaftaran = Pendaftaran::findOrFail($id);

    if (in_array($pendaftaran->status, ['Lulus', 'Tidak Lulus'])) {
        return back()->with(
            'error',
            'Hasil seleksi sudah ditetapkan dan tidak dapat diverifikasi ulang.'
        );
    }

    $pendaftaran->update([
        'status' => 'Terverifikasi',
    ]);

    return back()->with(
        'success',
        'Pendaftaran berhasil diverifikasi.'
    );

})->middleware('auth');


// ==========================
// MENETAPKAN SISWA LULUS
// ==========================

Route::post('/admin/pendaftar/{id}/lulus', function ($id) {

    $pendaftaran = Pendaftaran::findOrFail($id);

    if ($pendaftaran->status !== 'Terverifikasi') {
        return back()->with(
            'error',
            'Pendaftaran belum diverifikasi. Periksa data siswa terlebih dahulu.'
        );
    }

    if (trim((string) $pendaftaran->catatan_admin) !== '') {
        return back()->with(
            'error',
            'Masih ada catatan perbaikan. Selesaikan perbaikan siswa terlebih dahulu.'
        );
    }

    $jenisBerkasWajib = [
        'Kartu Keluarga',
        'Akta Kelahiran',
        'KTP Ibu',
    ];

    $berkas = Berkas::where(
        'id_pendaftaran',
        $pendaftaran->id
    )->whereIn(
        'jenis_berkas',
        $jenisBerkasWajib
    )->get();

    $semuaBerkasDiterima = collect($jenisBerkasWajib)->every(
        function ($jenis) use ($berkas) {
            return $berkas->contains(function ($item) use ($jenis) {
                return $item->jenis_berkas === $jenis
                    && $item->status === 'Diterima';
            });
        }
    );

    if (!$semuaBerkasDiterima) {
        return back()->with(
            'error',
            'Belum semua berkas wajib diterima. Periksa berkas siswa terlebih dahulu.'
        );
    }

    $pendaftaran->update([
        'status' => 'Lulus',
    ]);

    return back()->with(
        'success',
        'Pendaftar dinyatakan Lulus.'
    );

})->middleware('auth');


// ==========================
// MENETAPKAN SISWA TIDAK LULUS
// ==========================

Route::post('/admin/pendaftar/{id}/tidak-lulus', function ($id) {

    $pendaftaran = Pendaftaran::findOrFail($id);

    if ($pendaftaran->status !== 'Terverifikasi') {
        return back()->with(
            'error',
            'Pendaftaran harus diverifikasi terlebih dahulu sebelum hasil seleksi ditetapkan.'
        );
    }

    $pendaftaran->update([
        'status' => 'Tidak Lulus',
    ]);

    return back()->with(
        'success',
        'Pendaftar dinyatakan Tidak Lulus.'
    );

})->middleware('auth');


// ==========================
// BERKAS ADMIN
// ==========================

Route::get('/admin/berkas', function () {

    $berkas = Berkas::with('pendaftaran')
        ->latest()
        ->get();

    return view(
        'admin-berkas',
        compact('berkas')
    );

})->middleware('auth');

Route::post('/admin/berkas/{id}/terima', [
    BerkasController::class,
    'terima'
])->middleware('auth');

Route::post('/admin/berkas/{id}/tolak', [
    BerkasController::class,
    'tolak'
])->middleware('auth');


// ==========================
// PENGATURAN PPDB
// ==========================

Route::post('/admin/pengaturan-kuota', [
    PengaturanPpdbController::class,
    'update'
])->middleware('auth');

Route::post('/admin/pengaturan-jadwal', [
    PengaturanPpdbController::class,
    'updateJadwal'
])->middleware('auth');

Route::post('/admin/pengaturan-daftar-ulang', [
    PengaturanPpdbController::class,
    'updateDaftarUlang'
])->middleware('auth');


// ==========================
// AKSES DAN FORMULIR PPDB
// ==========================

Route::get('/akses-ppdb', function () {
    return view('akses-ppdb');
});

Route::get('/pendaftaran', [
    PendaftaranController::class,
    'create'
])->middleware('auth');

Route::post('/pendaftaran', [
    PendaftaranController::class,
    'store'
])->middleware('auth');


// ==========================
// UPLOAD BERKAS SISWA
// ==========================

Route::get('/upload-berkas', [
    BerkasController::class,
    'create'
])->middleware('auth');

Route::post('/upload-berkas', [
    BerkasController::class,
    'store'
])->middleware('auth');


// ==========================
// STATUS PENDAFTARAN SISWA
// ==========================

Route::get('/status-pendaftaran', function () {

    $pendaftaran = Pendaftaran::where(
        'user_id',
        Auth::id()
    )->latest()->firstOrFail();

    return view(
        'status-pendaftaran',
        compact('pendaftaran')
    );

})->middleware('auth');


// ==========================
// CETAK BUKTI PENDAFTARAN
// ==========================

Route::get('/bukti-pendaftaran', function () {

    $pendaftaran = Pendaftaran::where(
        'user_id',
        Auth::id()
    )->latest()->first();

    if (!$pendaftaran) {
        return redirect('/pendaftaran')->with(
            'error',
            'Silakan isi formulir pendaftaran terlebih dahulu.'
        );
    }

    if ($pendaftaran->status !== 'Lulus') {
        return redirect('/dashboard')->with(
            'error',
            'Bukti pendaftaran hanya tersedia setelah kamu dinyatakan Lulus oleh admin.'
        );
    }

    $jenisBerkasWajib = [
        'Kartu Keluarga',
        'Akta Kelahiran',
        'KTP Ibu',
    ];

    $berkas = Berkas::where(
        'id_pendaftaran',
        $pendaftaran->id
    )->whereIn(
        'jenis_berkas',
        $jenisBerkasWajib
    )->get();

    $semuaBerkasDiterima = collect($jenisBerkasWajib)->every(
        function ($jenis) use ($berkas) {
            return $berkas->contains(function ($item) use ($jenis) {
                return $item->jenis_berkas === $jenis
                    && $item->status === 'Diterima';
            });
        }
    );

    if (!$semuaBerkasDiterima) {
        return redirect('/dashboard')->with(
            'error',
            'Bukti pendaftaran belum tersedia karena masih ada berkas wajib yang belum diterima admin.'
        );
    }

    return view(
        'bukti-pendaftaran',
        compact('pendaftaran')
    );

})->middleware('auth');