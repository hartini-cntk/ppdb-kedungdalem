<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengumuman;

class PengumumanController extends Controller
{
    public function index()
    
{
    $pengumumans = Pengumuman::latest()->get();

    return view('admin-pengumuman', compact('pengumumans'));
}
    public function create()
{
    return view('admin-tambah-pengumuman');
}

   public function store(Request $request)
{
    $request->validate([
        'judul' => 'required',
        'isi' => 'required',
        'tanggal' => 'required|date',
    ]);

    Pengumuman::create([
        'judul' => $request->judul,
        'isi' => $request->isi,
        'tanggal' => $request->tanggal,
    ]);

    return redirect('/admin/pengumuman')
        ->with('success', 'Pengumuman berhasil ditambahkan.');
}

}
