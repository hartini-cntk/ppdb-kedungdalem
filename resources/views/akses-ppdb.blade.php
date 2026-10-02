<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Akses PPDB - SDN Kedung Dalam 1</title>

    <style>
        body {
            background: linear-gradient(
                135deg,
                #fff5f5 0%,
                #ffffff 55%
            );
            min-height: 100vh;
        }

        .navbar {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .access-wrapper {
            min-height: calc(100vh - 72px);
        }

        .access-card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .access-header {
            background: #fff8f8;
            padding: 30px 20px 25px;
            border-bottom: 1px solid #f1f1f1;
        }

        .access-logo {
            width: 85px;
            height: 85px;
            object-fit: contain;
            margin-bottom: 15px;
        }

        .access-label {
            color: #dc3545;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .access-title {
            font-weight: 700;
        }

        .access-description {
            line-height: 1.6;
        }

        .access-btn {
            border-radius: 10px;
            padding: 11px;
            font-weight: 600;
        }

        .login-btn {
            background: #dc3545;
            border-color: #dc3545;
        }

        .login-btn:hover {
            background: #bb2d3b;
            border-color: #bb2d3b;
        }

        .register-btn {
            border: 1px solid #dc3545;
            color: #dc3545;
        }

        .register-btn:hover {
            background: #dc3545;
            color: #ffffff;
        }

        .access-note {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar bg-danger py-3">

        <div class="container">

            <a href="/" class="navbar-brand text-white fw-bold">
                SDN Kedung Dalam 1
            </a>

            <a href="/" class="btn btn-light px-4">
                Beranda
            </a>

        </div>

    </nav>


    <!-- Akses PPDB -->
    <div class="container access-wrapper d-flex align-items-center py-5">

        <div class="row justify-content-center w-100">

            <div class="col-md-7 col-lg-5">

                <div class="card access-card">

                    <!-- Header -->
                    <div class="access-header text-center">

                        <img
                            src="{{ asset('images/logo-sekolah.png') }}"
                            alt="Logo SDN Kedung Dalam 1"
                            class="access-logo"
                        >

                        <p class="access-label mb-2">
                            PENERIMAAN PESERTA DIDIK BARU
                        </p>

                        <h1 class="access-title h3 mb-2">
                            Akses PPDB
                        </h1>

                        <p class="text-secondary access-description mb-0">
                            Silakan pilih akses yang sesuai untuk melanjutkan
                            proses pendaftaran PPDB SDN Kedung Dalam 1.
                        </p>

                    </div>


                    <!-- Pilihan -->
                    <div class="card-body p-4 p-md-5">

                        <div class="d-grid gap-3">

                            <a
                                href="/login"
                                class="btn btn-danger access-btn login-btn"
                            >
                                Login
                            </a>

                            <a
                                href="/register"
                                class="btn access-btn register-btn"
                            >
                                Registrasi Akun
                            </a>

                        </div>


                        <div class="access-note text-center text-secondary mt-4">

                            Belum memiliki akun?
                            Pilih <strong>Registrasi Akun</strong> terlebih dahulu.

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>
</html>