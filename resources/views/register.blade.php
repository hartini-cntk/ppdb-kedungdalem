<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Registrasi Akun PPDB</title>
</head>

<body>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card">
                    <div class="card-body">

                        <h2 class="text-center fw-bold mb-4">
                            Registrasi Akun
                        </h2>

                        <p class="text-center">
                            Silakan buat akun untuk melanjutkan pendaftaran PPDB.
                        </p>

                        <form method="POST" action="/register">
                          @csrf
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-danger w-100">
                                Registrasi
                            </button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

</body>
</html>