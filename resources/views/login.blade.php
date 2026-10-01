<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Login PPDB - SDN Kedung Dalem 1</title>
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar bg-danger">
        <div class="container">
            <a href="/" class="navbar-brand text-white fw-bold">
                SDN Kedung Dalem 1
            </a>

            <a href="/akses-ppdb" class="btn btn-light">
                Kembali
            </a>
        </div>
    </nav>


    <!-- Form Login -->
    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-md-6 col-lg-5">

                <div class="card border-0 shadow-sm">

                    <div class="card-body p-4 p-md-5">

                        <div class="text-center mb-4">

                            <p class="text-danger fw-semibold mb-2">
                                PPDB SDN KEDUNG DALEM 1
                            </p>

                            <h1 class="fw-bold">
                                Login
                            </h1>

                            <p class="text-secondary">
                                Silakan login untuk melanjutkan proses pendaftaran.
                            </p>

                        </div>


                        @if ($errors->any())
                            <div class="alert alert-danger">
                                {{ $errors->first() }}
                            </div>
                        @endif


                        <form method="POST" action="/login">

                            @csrf

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


                            <div class="mb-4">
                                <label class="form-label fw-semibold">
                                    Password
                                </label>

                                <input
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="Masukkan password"
                                    required
                                >
                            </div>


                            <button type="submit" class="btn btn-danger w-100 py-2">
                                Login
                            </button>

                        </form>


                        <div class="text-center mt-4">

                            <p class="text-secondary mb-1">
                                Belum memiliki akun?
                            </p>

                            <a href="/register" class="text-danger text-decoration-none fw-semibold">
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