<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\BerkasController;
use App\Http\Controllers\PengaturanPpdbController;
use App\Http\Controllers\PengumumanController;
use App\Models\Pendaftaran;
use App\Models\Berkas;
use App\Models\Pengumuman;
use App\Models\PengaturanPpdb;


// BERANDA
Route::get('/', function () {
    $pengaturan = \App\Models\PengaturanPpdb::firstOrCreate(
        [],
        ['kuota' => 100]
    );

    $totalPendaftar = \App\Models\Pendaftaran::count();

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

    $sudahUploadBerkas = $berkas->count() > 0;

    $berkasSudahDiverifikasi =
        $sudahUploadBerkas &&
        $berkas->every(function ($item) {
            return $item->status === 'Diterima';
        });

    $sudahTerverifikasi =
        $pendaftaran &&
        $pendaftaran->status === 'Terverifikasi';

    $adaPengumuman =
        $pendaftaran &&
        $pendaftaran->status === 'Lulus' &&
        Pengumuman::count() > 0;

    return view('dashboard', compact(
        'pendaftaran',
        'sudahIsiFormulir',
        'sudahUploadBerkas',
        'berkasSudahDiverifikasi',
        'sudahTerverifikasi',
        'adaPengumuman'
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
// VERIFIKASI PENDAFTARAN
// ==========================

Route::post('/admin/pendaftar/{id}/verifikasi', function ($id) {

    $pendaftaran = Pendaftaran::findOrFail($id);

    $pendaftaran->update([
        'status' => 'Terverifikasi',
    ]);

    return back()->with(
        'success',
        'Pendaftaran berhasil diverifikasi.'
    );

})->middleware('auth');

Route::post('/admin/pendaftar/{id}/lulus', function ($id) {

    $pendaftaran = Pendaftaran::findOrFail($id);

    $pendaftaran->update([
        'status' => 'Lulus',
    ]);

    return back()->with(
        'success',
        'Pendaftar dinyatakan Lulus.'
    );

})->middleware('auth');

Route::post('/admin/pendaftar/{id}/tidak-lulus', function ($id) {

    $pendaftaran = Pendaftaran::findOrFail($id);

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
// PENGUMUMAN ADMIN
// ==========================

Route::get('/admin/pengumuman', [
    PengumumanController::class,
    'index'
])->middleware('auth');

Route::get('/admin/pengumuman/tambah', [
    PengumumanController::class,
    'create'
])->middleware('auth');

Route::post('/admin/pengumuman', [
    PengumumanController::class,
    'store'
])->middleware('auth');


// ==========================
// PENGATURAN KUOTA PPDB
// ==========================

Route::post('/admin/pengaturan-kuota', [
    PengaturanPpdbController::class,
    'update'
])->middleware('auth');

Route::post('/admin/pengaturan-jadwal', [
    PengaturanPpdbController::class,
    'updateJadwal'
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
// PENGUMUMAN SISWA
// ==========================

Route::get('/pengumuman', function () {

    $pengumumans = Pengumuman::latest()->get();

    $pendaftaran = Pendaftaran::where(
        'user_id',
        Auth::id()
    )->latest()->first();

    return view('pengumuman', compact(
        'pengumumans',
        'pendaftaran'
    ));

})->middleware('auth');


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
    )->latest()->firstOrFail();

    return view(
        'bukti-pendaftaran',
        compact('pendaftaran')
    );

})->middleware('auth');
