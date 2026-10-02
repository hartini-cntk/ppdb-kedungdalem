<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Registrasi PPDB - SDN Kedung Dalam 1</title>

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

        .register-wrapper {
            min-height: calc(100vh - 72px);
        }

        .register-card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .register-header {
            background: #fff8f8;
            padding: 30px 20px 20px;
            border-bottom: 1px solid #f1f1f1;
        }

        .register-logo {
            width: 85px;
            height: 85px;
            object-fit: contain;
            margin-bottom: 15px;
        }

        .register-label {
            color: #dc3545;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .register-title {
            font-weight: 700;
        }

        .form-control {
            border-radius: 10px;
            padding: 11px 13px;
            border: 1px solid #dee2e6;
        }

        .form-control:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.15rem rgba(220, 53, 69, 0.12);
        }

        .btn-register {
            border-radius: 10px;
            font-weight: 600;
            padding: 11px;
        }

        .login-link {
            color: #dc3545;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link:hover {
            text-decoration: underline;
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

            <a href="/login" class="btn btn-light px-4">
                Login
            </a>

        </div>

    </nav>


    <!-- Register -->
    <div class="container register-wrapper d-flex align-items-center py-5">

        <div class="row justify-content-center w-100">

            <div class="col-md-7 col-lg-5">

                <div class="card register-card">

                    <!-- Header -->
                    <div class="register-header text-center">

                        <img
                            src="{{ asset('images/logo-sekolah.png') }}"
                            alt="Logo SDN Kedung Dalam 1"
                            class="register-logo"
                        >

                        <p class="register-label mb-2">
                            PPDB SDN KEDUNG DALAM 1
                        </p>

                        <h1 class="register-title h3 mb-2">
                            Registrasi Akun
                        </h1>

                        <p class="text-secondary mb-0">
                            Buat akun untuk melanjutkan proses pendaftaran PPDB.
                        </p>

                    </div>


                    <!-- Form -->
                    <div class="card-body p-4 p-md-5">

                        <form method="POST" action="/register">

                            @csrf

                            <!-- Nama -->
                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Nama Lengkap
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    placeholder="Masukkan nama lengkap"
                                    required
                                >

                            </div>


                            <!-- Email -->
                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Email
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    placeholder="Masukkan email"
                                    required
                                >

                            </div>


                            <!-- Password -->
                            <div class="mb-4">

                                <label class="form-label fw-semibold">
                                    Password
                                </label>

                                <input
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="Buat password"
                                    required
                                >

                            </div>


                            <!-- Button -->
                            <button
                                type="submit"
                                class="btn btn-danger w-100 btn-register"
                            >
                                Registrasi
                            </button>

                        </form>


                        <!-- Login -->
                        <div class="text-center mt-4">

                            <p class="text-secondary mb-1">
                                Sudah memiliki akun?
                            </p>

                            <a href="/login" class="login-link">
                                Login di sini
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>
</html>