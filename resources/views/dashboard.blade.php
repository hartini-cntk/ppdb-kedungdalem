<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Dashboard Siswa - PPDB SDN Kedung Dalam 1</title>

    <style>
    body {
        background: linear-gradient(
            135deg,
            #fff5f5 0%,
            #ffffff 55%
        );
        min-height: 100vh;
        color: #212529;
    }

    .navbar {
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    }

    .dashboard-wrapper {
        padding-top: 45px;
        padding-bottom: 60px;
    }

    .welcome-title {
        font-weight: 700;
    }

    /* Logo Dashboard */
    .dashboard-brand {
        display: flex;
        align-items: center;
        gap: 18px;
    }

    .dashboard-logo {
        width: 75px;
        height: 75px;
        object-fit: contain;
        background: #ffffff;
        border-radius: 14px;
        padding: 7px;
        box-shadow: 0 5px 18px rgba(0, 0, 0, 0.06);
    }

    .status-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06);
    }

    .menu-card {
        border: none;
        border-radius: 16px;
        height: 100%;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
        transition: all 0.2s ease;
    }

    .menu-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }

    .menu-title {
        font-weight: 700;
    }

    .menu-description {
        color: #6c757d;
        line-height: 1.6;
        min-height: 50px;
    }

    .btn-menu {
        border-radius: 9px;
        font-weight: 600;
        padding: 9px 18px;
        border: 1px solid #dc3545;
        color: #dc3545;
        background: #ffffff;
        transition: all 0.2s ease;
    }

    .btn-menu:hover {
        background: #dc3545;
        color: #ffffff;
    }

    .status-label {
        color: #dc3545;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 0.5px;
    }

.progress-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
}

.progress-step {
    text-align: center;
}

.step-number {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: #f1f3f5;
    color: #6c757d;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 10px;
    font-weight: 700;
}

.step-active {
    background: #dc3545;
    color: #ffffff;
}

.step-title {
    font-size: 14px;
    font-weight: 600;
}

.step-line {
    height: 2px;
    background: #e9ecef;
    width: 100%;
    margin-top: 21px;
}
    
</style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar bg-danger py-3">

        <div class="container">

            <a href="/" class="navbar-brand text-white fw-bold">
                SDN Kedung Dalem 1
            </a>

            <form method="POST" action="/logout">
                @csrf

                <button type="submit" class="btn btn-light px-4">
                    Keluar
                </button>
            </form>

        </div>

    </nav>


    <!-- Dashboard -->
    <div class="container dashboard-wrapper">

        @if (session('success'))

            <div class="alert alert-success shadow-sm">
                {{ session('success') }}
            </div>

        @endif


        <!-- Sapaan -->
        <div class="mb-4">

            <div class="dashboard-heading mb-4">

    <div class="dashboard-brand">

        <img
            src="{{ asset('images/logo-sekolah.png') }}"
            alt="Logo SDN Kedung Dalam 1"
            class="dashboard-logo"
        >

        <div>
            <p class="status-label mb-1">
                PPDB SDN KEDUNG DALAM 1
            </p>

            <h1 class="welcome-title mb-2">
                Dashboard Siswa
            </h1>

            <p class="text-secondary mb-0">
                Selamat datang, {{ auth()->user()->name }}.
                Silakan lanjutkan proses pendaftaran PPDB.
            </p>
        </div>

    </div>

</div>
            

        <!-- Status Pendaftaran -->
        <div class="card status-card mb-4">

            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                    <div>

                        <h5 class="fw-bold mb-1">
                            Status Pendaftaran
                        </h5>

                        <p class="text-secondary mb-0">
                            Pantau proses pendaftaran dan verifikasi kamu.
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


        <!-- Proses Pendaftaran -->
        <div class="progress-card mb-4">

            <p class="status-label mb-1">
                TAHAPAN PPDB
            </p>

            <h4 class="fw-bold mb-4">
                Proses Pendaftaran
            </h4>

            <div class="row align-items-start">

                <div class="col">
                    <div class="progress-step">
                        <div class="step-number step-active">
                            1
                        </div>
                        <div class="step-title">
                            Registrasi
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="step-line"></div>
                </div>

                <div class="col">
                    <div class="progress-step">
                        <div class="step-number">
                            2
                        </div>
                        <div class="step-title">
                            Formulir
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="step-line"></div>
                </div>

                <div class="col">
                    <div class="progress-step">
                        <div class="step-number">
                            3
                        </div>
                        <div class="step-title">
                            Berkas
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="step-line"></div>
                </div>

                <div class="col">
                    <div class="progress-step">
                        <div class="step-number">
                            4
                        </div>
                        <div class="step-title">
                            Verifikasi
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="step-line"></div>
                </div>

                <div class="col">
                    <div class="progress-step">
                        <div class="step-number">
                            5
                        </div>
                        <div class="step-title">
                            Pengumuman
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <!-- Menu -->
        <div class="row g-4">


            <!-- Formulir -->
            <div class="col-md-6">

                <div class="card menu-card">

                    <div class="card-body p-4">


                        <h4 class="menu-title mb-2">
                            Formulir Pendaftaran
                        </h4>

                        <p class="menu-description">
                            Isi data calon siswa dan data orang tua/wali
                            untuk melanjutkan proses pendaftaran.
                        </p>

                        <a
                          href="/pendaftaran"
                          class="btn btn-menu"
                         >
                          Isi Formulir
                        </a>

                    </div>

                </div>

            </div>


            <!-- Berkas -->
            <div class="col-md-6">

                <div class="card menu-card">

                    <div class="card-body p-4">

                        
                        <h4 class="menu-title mb-2">
                            Upload Berkas
                        </h4>

                        <p class="menu-description">
                            Upload dokumen persyaratan setelah mengisi
                            formulir pendaftaran.
                        </p>

                        <a
                            href="/upload-berkas"
                            class="btn btn-outline-danger btn-menu"
                        >
                            Upload Berkas
                        </a>

                    </div>

                </div>

            </div>


            <!-- Status -->
            <div class="col-md-6">

                <div class="card menu-card">

                    <div class="card-body p-4">


                        <h4 class="menu-title mb-2">
                            Cek Status
                        </h4>

                        <p class="menu-description">
                            Lihat status pendaftaran dan hasil verifikasi
                            berkas kamu.
                        </p>

                        <a
                            href="/status-pendaftaran"
                            class="btn btn-outline-danger btn-menu"
                        >
                            Cek Status
                        </a>

                    </div>

                </div>

            </div>


            <!-- Pengumuman -->
            <div class="col-md-6">

                <div class="card menu-card">

                    <div class="card-body p-4">


                        <h4 class="menu-title mb-2">
                            Pengumuman
                        </h4>

                        <p class="menu-description">
                            Lihat informasi dan pengumuman hasil PPDB.
                        </p>

                        <a
                            href="/pengumuman"
                            class="btn btn-outline-danger btn-menu"
                        >
                            Lihat Pengumuman
                        </a>

                    </div>

                </div>

            </div>


        </div>

    </div>

</body>
</html>