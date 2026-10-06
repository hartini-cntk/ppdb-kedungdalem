<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\BerkasController;

Route::get('/', function () {
    return view('home');
});
Route::get('/register', [RegisterController::class, 'showRegister']);
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/dashboard', function () {

    $pendaftaran = \App\Models\Pendaftaran::where(
        'user_id',
        auth()->id()
    )->first();

    // Cek apakah siswa sudah mengisi formulir
    $sudahIsiFormulir = $pendaftaran !== null;

    // Cek berkas siswa
    $berkas = collect();

    if ($pendaftaran) {
        $berkas = \App\Models\Berkas::where(
            'id_pendaftaran',
            $pendaftaran->id
        )->get();
    }

    // Cek apakah sudah upload berkas
    $sudahUploadBerkas = $berkas->count() > 0;

    // Cek apakah semua berkas sudah diterima admin
    $berkasSudahDiverifikasi =
        $sudahUploadBerkas &&
        $berkas->every(function ($item) {
            return $item->status === 'Diterima';
        });

    // Cek verifikasi pendaftaran
    $sudahTerverifikasi =
        $pendaftaran &&
        $pendaftaran->status === 'Terverifikasi';

        // Cek apakah sudah ada pengumuman
           $adaPengumuman = \App\Models\Pengumuman::count() > 0;

    return view('dashboard', compact(
        'pendaftaran',
        'sudahIsiFormulir',
        'sudahUploadBerkas',
        'berkasSudahDiverifikasi',
        'sudahTerverifikasi',
        'adaPengumuman',

    ));

})->middleware('auth');
Route::get('/admin/dashboard', function () {

    $totalPendaftar = \App\Models\Pendaftaran::count();

    $menungguVerifikasi = \App\Models\Pendaftaran::where(
    'status',
    'Menunggu Verifikasi'
     )->count();

     $terverifikasi = \App\Models\Pendaftaran::where(
    'status',
    'Terverifikasi'
     )->count();

     $ditolak = \App\Models\Pendaftaran::where(
    'status',
    'Ditolak'
      )->count();

     $lulus = \App\Models\Pendaftaran::where(
    'status',
    'Lulus'
      )->count();

    return view('admin-dashboard', compact(
    'totalPendaftar',
    'menungguVerifikasi',
    'terverifikasi',
    'ditolak',
    'lulus'
     ));

    })->middleware('auth');

Route::get('/admin/pendaftar', function () {

    $pendaftarans = \App\Models\Pendaftaran::latest()->get();

    return view('admin-pendaftar', compact('pendaftarans'));

})->middleware('auth');

// Verifikasi Berkas Admin
Route::get('/admin/berkas', function () {

    $berkas = \App\Models\Berkas::with('pendaftaran')
        ->latest()
        ->get();

    return view('admin-berkas', compact('berkas'));

})->middleware('auth');

// Pengumuman Admin
Route::get('/admin/pengumuman', [
    \App\Http\Controllers\PengumumanController::class,
    'index'
])->middleware('auth');

Route::get('/admin/pengumuman/tambah', [
    \App\Http\Controllers\PengumumanController::class,
    'create'
])->middleware('auth');
  
Route::post('/admin/pengumuman', [
    \App\Http\Controllers\PengumumanController::class,
    'store'
])->middleware('auth');

Route::get('/admin/pendaftar/{id}', function ($id) {

    $pendaftaran = \App\Models\Pendaftaran::findOrFail($id);

    return view('admin-detail-pendaftar', compact('pendaftaran'));

})->middleware('auth');

Route::get('/akses-ppdb', function () {
    return view('akses-ppdb');
});
Route::get('/pendaftaran', [PendaftaranController::class, 'create'])->middleware('auth');
Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->middleware('auth');

Route::get('/upload-berkas', [BerkasController::class, 'create'])->middleware('auth');
Route::post('/upload-berkas', [BerkasController::class, 'store'])->middleware('auth');

// Pengumuman Siswa
Route::get('/pengumuman', function () {

    $pengumumans = \App\Models\Pengumuman::latest()->get();

    $pendaftaran = \App\Models\Pendaftaran::where(
        'user_id',
        Auth::id()
    )->latest()->first();

    return view('pengumuman', compact(
        'pengumumans',
        'pendaftaran'
    ));

})->middleware('auth');

// Status Pendaftaran Siswa

Route::get('/status-pendaftaran', function () {
    $pendaftaran = \App\Models\Pendaftaran::where(
        'user_id',
        Auth::id()
    )->latest()->firstOrFail();

    return view('status-pendaftaran', compact('pendaftaran'));
})->middleware('auth');

// Cetak Bukti Pendaftaran
Route::get('/bukti-pendaftaran', function () {
    $pendaftaran = \App\Models\Pendaftaran::where(
        'user_id',
        Auth::id()
    )->latest()->firstOrFail();

    return view('bukti-pendaftaran', compact('pendaftaran'));
})->middleware('auth');


// Verifikasi Pendaftaran
Route::post('/admin/pendaftar/{id}/verifikasi', function ($id) {

    $pendaftaran = \App\Models\Pendaftaran::findOrFail($id);

    $pendaftaran->update([
        'status' => 'Terverifikasi',
    ]);

    return back()->with(
        'success',
        'Pendaftaran berhasil diverifikasi.'
    );

})->middleware('auth');


// Hasil Seleksi: Lulus
Route::post('/admin/pendaftar/{id}/lulus', function ($id) {

    $pendaftaran = \App\Models\Pendaftaran::findOrFail($id);

    $pendaftaran->update([
        'status' => 'Lulus',
    ]);

    return back()->with(
        'success',
        'Pendaftar dinyatakan Lulus.'
    );

})->middleware('auth');


// Hasil Seleksi: Tidak Lulus
Route::post('/admin/pendaftar/{id}/tidak-lulus', function ($id) {

    $pendaftaran = \App\Models\Pendaftaran::findOrFail($id);

    $pendaftaran->update([
        'status' => 'Tidak Lulus',
    ]);

    return back()->with(
        'success',
        'Pendaftar dinyatakan Tidak Lulus.'
    );

})->middleware('auth');

// Verifikasi Berkas
Route::post('/admin/berkas/{id}/terima', [
    BerkasController::class,
    'terima'
])->middleware('auth');

Route::post('/admin/berkas/{id}/tolak', [
    BerkasController::class,
    'tolak'
])->middleware('auth');

Route::post('/logout', function () {
    Auth::logout();

    return redirect('/login');
});