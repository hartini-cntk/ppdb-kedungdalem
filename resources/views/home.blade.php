<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>PPDB SDN Kedung Dalem 1</title>

    <style>
        body {
            background: #ffffff;
        }

        .hero {
            background: linear-gradient(
                135deg,
                #fff5f5 0%,
                #ffffff 65%
            );
            border-bottom: 1px solid #f1f1f1;
        }

        .hero-card {
            border-left: 5px solid #dc3545;
        }

        .info-card {
            transition: 0.2s;
        }

        .info-card:hover {
            transform: translateY(-3px);
        }

        .info-icon {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff0f0;
            color: #dc3545;
            border-radius: 10px;
            font-size: 20px;
        }

        .school-info {
            background: #f8f9fa;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar bg-danger py-3">
        <div class="container">

            <a class="navbar-brand text-white fw-bold" href="/">
                SDN Kedung Dalem 1
            </a>

            <a href="/akses-ppdb" class="btn btn-light px-4">
                Akses PPDB
            </a>

        </div>
    </nav>


    <!-- Hero -->
    <section class="hero py-5">
        <div class="container">
            <div class="row align-items-center py-4">

                <!-- Kiri -->
                <div class="col-lg-7">

                    <p class="text-danger fw-semibold mb-2">
                        PENERIMAAN PESERTA DIDIK BARU
                    </p>

                    <h1 class="fw-bold display-5 mb-3">
                        PPDB SDN Kedung Dalem 1
                    </h1>

                    <p class="text-secondary fs-5 mb-4">
                        Selamat datang di website PPDB SDN Kedung Dalem 1.
                        Dapatkan informasi pendaftaran dan lakukan proses
                        pendaftaran secara online.
                    </p>

                    <a href="/akses-ppdb" class="btn btn-danger px-4 py-2">
                        Mulai Pendaftaran
                    </a>

                </div>


                <!-- Kanan -->
                <div class="col-lg-5 mt-4 mt-lg-0">

                    <div class="card hero-card border-0 shadow-sm">
                        <div class="card-body p-4">

                            <p class="text-danger fw-semibold mb-1">
                                PROFIL SEKOLAH
                            </p>

                            <h4 class="fw-bold mb-3">
                                SDN Kedung Dalem 1
                            </h4>

                            <p class="text-secondary mb-4">
                                Sekolah Dasar Negeri yang melaksanakan
                                kegiatan pendidikan dan penerimaan
                                peserta didik baru.
                            </p>

                            <div class="row">

                                <div class="col-6">
                                    <small class="text-secondary">
                                        Akreditasi
                                    </small>

                                    <h5 class="fw-bold mb-0">
                                        B
                                    </h5>
                                </div>

                                <div class="col-6">
                                    <small class="text-secondary">
                                        Tahun Pelajaran
                                    </small>

                                    <h5 class="fw-bold mb-0">
                                        2026/2027
                                    </h5>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>


    <!-- Informasi PPDB -->
    <section class="py-5">
        <div class="container">

            <div class="text-center mb-5">

                <p class="text-danger fw-semibold mb-1">
                    INFORMASI
                </p>

                <h2 class="fw-bold">
                    Informasi PPDB
                </h2>

                <p class="text-secondary">
                    Beberapa informasi yang perlu diketahui sebelum mendaftar.
                </p>

            </div>


            <div class="row g-4">

                <!-- Jadwal -->
                <div class="col-md-4">
                    <div class="card info-card h-100 border-0 shadow-sm">

                        <div class="card-body p-4">

                            <div class="info-icon mb-3">
                                📅
                            </div>

                            <h5 class="fw-bold">
                                Jadwal Pendaftaran
                            </h5>

                            <p class="text-secondary mb-0">
                                Informasi mengenai jadwal dan waktu
                                pelaksanaan PPDB.
                            </p>

                        </div>

                    </div>
                </div>


                <!-- Persyaratan -->
                <div class="col-md-4">
                    <div class="card info-card h-100 border-0 shadow-sm">

                        <div class="card-body p-4">

                            <div class="info-icon mb-3">
                                📄
                            </div>

                            <h5 class="fw-bold">
                                Persyaratan
                            </h5>

                            <p class="text-secondary mb-0">
                                Dokumen dan persyaratan yang perlu
                                disiapkan sebelum mendaftar.
                            </p>

                        </div>

                    </div>
                </div>


                <!-- Alur -->
                <div class="col-md-4">
                    <div class="card info-card h-100 border-0 shadow-sm">

                        <div class="card-body p-4">

                            <div class="info-icon mb-3">
                                📝
                            </div>

                            <h5 class="fw-bold">
                                Alur Pendaftaran
                            </h5>

                            <p class="text-secondary mb-0">
                                Tahapan pendaftaran mulai dari registrasi
                                akun hingga proses selesai.
                            </p>

                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>


    <!-- Informasi Sekolah -->
    <section class="school-info py-5">

        <div class="container">

            <div class="row">

                <div class="col-md-8">

                    <p class="text-danger fw-semibold mb-1">
                        TENTANG SEKOLAH
                    </p>

                    <h3 class="fw-bold">
                        SDN Kedung Dalem 1
                    </h3>

                    <p class="text-secondary mb-2">
                        JL. KH. Musa Kp. Margasari Desa Kedung Dalem
                        RT.07 RW.02
                    </p>

                    <p class="text-secondary mb-0">
                        Kec. Mauk - Kab. Tangerang - Banten 15530
                    </p>

                </div>

                <div class="col-md-4 mt-4 mt-md-0">

                    <small class="text-secondary">
                        Jam Sekolah
                    </small>

                    <p class="fw-semibold mb-2">
                        07.00 - 12.00 WIB
                    </p>

                    <small class="text-secondary">
                        Informasi pelayanan dapat menyesuaikan
                        kebutuhan sekolah.
                    </small>

                </div>

            </div>

        </div>

    </section>


    <!-- Footer -->
    <footer class="py-3">

        <div class="container text-center">

            <p class="mb-0 text-secondary">
                © 2026 SDN Kedung Dalem 1
            </p>

        </div>

    </footer>

</body>
</html>