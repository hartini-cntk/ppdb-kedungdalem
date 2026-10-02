<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Dashboard Admin - PPDB SDN Kedung Dalam 1</title>
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar bg-danger">
        <div class="container">
            <a href="/" class="navbar-brand text-white fw-bold">
                SDN Kedung Dalam 1
            </a>

            <form method="POST" action="/logout">
                @csrf

                <button type="submit" class="btn btn-light">
                    Keluar
                </button>
            </form>
        </div>
    </nav>

    <!-- Content -->
    <div class="container py-5">

        <div class="mb-4">
            <h1 class="fw-bold">Dashboard Admin</h1>

            <p class="text-secondary mb-0">
                Selamat datang, Admin. Kelola data pendaftaran PPDB di sini.
            </p>
        </div>

        <!-- Ringkasan -->
<div class="row g-4 mb-4">

    <!-- Total Pendaftar -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <p class="text-secondary mb-1">
                    Total Pendaftar
                </p>

                <h2 class="fw-bold mb-0">
                    {{ $totalPendaftar }}
                </h2>
            </div>
        </div>
    </div>

    <!-- Menunggu Verifikasi -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <p class="text-secondary mb-1">
                    Menunggu Verifikasi
                </p>

                <h2 class="fw-bold mb-0">
                    {{ $menungguVerifikasi }}
                </h2>
            </div>
        </div>
    </div>

    <!-- Terverifikasi -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <p class="text-secondary mb-1">
                    Terverifikasi
                </p>

                <h2 class="fw-bold mb-0">
                    {{ $terverifikasi }}
                </h2>
            </div>
        </div>
    </div>

</div>

<!-- Ditolak -->
<div class="col-md-4">
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <p class="text-secondary mb-1">
                Ditolak
            </p>

            <h2 class="fw-bold mb-0">
                {{ $ditolak }}
            </h2>
        </div>
    </div>
</div>

        
        <!-- Menu Admin -->
        <div class="row g-4">

            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">

                        <h4 class="fw-bold">
                            Data Pendaftar
                        </h4>

                        <p class="text-secondary">
                            Lihat dan kelola data calon siswa yang telah melakukan pendaftaran.
                        </p>

                        <a href="/admin/pendaftar" class="btn btn-danger">
                            Kelola Data
                        </a>  

                        
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">

                        <h4 class="fw-bold">
                            Verifikasi Berkas
                        </h4>

                        <p class="text-secondary">
                            Periksa berkas persyaratan yang telah diupload oleh siswa.
                        </p>

                        <button class="btn btn-outline-danger" disabled>
                            Verifikasi Berkas
                        </button>

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">

                        <h4 class="fw-bold">
                            Status Pendaftaran
                        </h4>

                        <p class="text-secondary">
                            Ubah status pendaftaran sesuai hasil verifikasi.
                        </p>

                        <button class="btn btn-outline-danger" disabled>
                            Kelola Status
                        </button>

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">

                        <h4 class="fw-bold">
                            Pengumuman
                        </h4>

                        <p class="text-secondary">
                            Kelola informasi dan pengumuman hasil PPDB.
                        </p>

                        <a href="/admin/pengumuman/tambah" class="btn btn-danger">
                          Kelola Pengumuman
                        </a>

                    </div>
                </div>
            </div>

        </div>

    </div>

</body>
</html>