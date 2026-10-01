<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Akses PPDB - SDN Kedung Dalem 1</title>
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar bg-danger">
        <div class="container">
            <a href="/" class="navbar-brand text-white fw-bold">
                SDN Kedung Dalem 1
            </a>

            <a href="/" class="btn btn-light">
                Beranda
            </a>
        </div>
    </nav>


    <!-- Isi Halaman -->
    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-md-7 col-lg-6">

                <div class="card border-0 shadow-sm">

                    <div class="card-body p-4 p-md-5">

                        <div class="text-center mb-4">
                            <p class="text-danger fw-semibold mb-2">
                                PENERIMAAN PESERTA DIDIK BARU
                            </p>

                            <h1 class="fw-bold">
                                Akses PPDB
                            </h1>

                            <p class="text-secondary">
                                Silakan pilih untuk melanjutkan proses pendaftaran
                                di SDN Kedung Dalem 1.
                            </p>
                        </div>


                        <div class="d-grid gap-3">

                            <a href="/login" class="btn btn-danger py-2">
                                Login
                            </a>

                            <a href="/register" class="btn btn-outline-danger py-2">
                                Registrasi Akun
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>
</html>