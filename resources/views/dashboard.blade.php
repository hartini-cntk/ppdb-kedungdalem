<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Dashboard Siswa - PPDB SDN Kedung Dalem 1</title>
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar bg-danger">
        <div class="container">
            <a href="/" class="navbar-brand text-white fw-bold">
                SDN Kedung Dalem 1
            </a>

            <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="btn btn-light">
                    Keluar
                </button>
            </form>
        </div>
    </nav>


    <!-- Dashboard -->
    <div class="container py-5">
        @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

        <!-- Sapaan -->
        <div class="mb-4">
            <h1 class="fw-bold">
                Dashboard Siswa
            </h1>

            <p class="text-secondary mb-0">
                Selamat datang, {{ auth()->user()->name }}.
                Silakan lanjutkan proses pendaftaran PPDB.
            </p>
        </div>


        <!-- Status -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                    <div>
                        <h5 class="fw-bold mb-1">
                            Status Pendaftaran
                        </h5>

                        <p class="text-secondary mb-0">
                          Pendaftaran kamu sedang menunggu verifikasi admin.
                        </p>
                    </div>

                @if ($pendaftaran)
                   <span class="badge text-bg-warning px-3 py-2">
                     {{ $pendaftaran->status }}
                   </span>
                @else
                   <span class="badge text-bg-secondary px-3 py-2">
                       Belum Mengisi Formulir
                   </span>
                @endif

                </div>

            </div>
        </div>


        <!-- Menu -->
        <div class="row g-4">

            <!-- Formulir -->
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">

                        <h4 class="fw-bold">
                            Formulir Pendaftaran
                        </h4>

                        <p class="text-secondary">
                            Isi data calon siswa dan data orang tua/wali
                            untuk melanjutkan pendaftaran.
                        </p>

                        <a href="/pendaftaran" class="btn btn-danger">
                            Isi Formulir
                        </a>

                    </div>
                </div>
            </div>


            <!-- Berkas -->
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">

                        <h4 class="fw-bold">
                            Upload Berkas
                        </h4>

                        <p class="text-secondary">
                            Upload dokumen persyaratan setelah mengisi
                            formulir pendaftaran.
                        </p>

                        <a href="/upload-berkas" class="btn btn-outline-danger">
                           Upload Berkas
                        </a>
                    </div>
                </div>
            </div>


            <!-- Status -->
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">

                        <h4 class="fw-bold">
                            Cek Status
                        </h4>

                        <p class="text-secondary">
                            Lihat status pendaftaran dan hasil verifikasi
                            berkas.
                        </p>

                        <a href="/status-pendaftaran" class="btn btn-outline-danger">
                           Cek Status
                        </a>

                        <small class="d-block text-secondary mt-2">
                           Lihat status pendaftaran dan verifikasi berkas.
                        </small>

                    </div>
                </div>
            </div>


            <!-- Pengumuman -->
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">

                        <h4 class="fw-bold">
                            Pengumuman
                        </h4>

                        <p class="text-secondary">
                            Lihat informasi dan pengumuman hasil PPDB.
                        </p>

                        <a href="/pengumuman" class="btn btn-outline-danger">
                           Lihat Pengumuman
                        </a>

                        <small class="d-block text-secondary mt-2">
                            Informasi akan tersedia sesuai jadwal.
                        </small>

                    </div>
                </div>
            </div>

        </div>

    </div>

</body>
</html>