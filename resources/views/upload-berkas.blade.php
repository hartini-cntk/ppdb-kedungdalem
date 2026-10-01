<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Upload Berkas - PPDB SDN Kedung Dalem 1</title>
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar bg-danger">
        <div class="container">
            <a href="/dashboard" class="navbar-brand text-white fw-bold">
                SDN Kedung Dalem 1
            </a>

            <a href="/dashboard" class="btn btn-light">
                Kembali
            </a>
        </div>
    </nav>

    <div class="container py-5">

        <div class="mb-4">
            <h1 class="fw-bold">Upload Berkas</h1>

            <p class="text-secondary mb-0">
                Silakan upload dokumen persyaratan untuk melanjutkan
                proses pendaftaran PPDB.
            </p>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">

                <form method="POST" action="/upload-berkas"
                      enctype="multipart/form-data">
                    @csrf

                    <!-- Kartu Keluarga -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            Kartu Keluarga (KK)
                        </label>

                        <input
                            type="file"
                            name="kk"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.pdf"
                            required
                        >

                        <small class="text-secondary">
                            Format: JPG, JPEG, PNG, atau PDF.
                        </small>
                    </div>

                    <!-- Akta Kelahiran -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            Akta Kelahiran
                        </label>

                        <input
                            type="file"
                            name="akta"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.pdf"
                            required
                        >

                        <small class="text-secondary">
                            Format: JPG, JPEG, PNG, atau PDF.
                        </small>
                    </div>

                    <!-- Dokumen Lain -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            Dokumen Pendukung Lainnya
                        </label>

                        <input
                            type="file"
                            name="dokumen_lain"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.pdf"
                        >

                        <small class="text-secondary">
                            Opsional. Upload jika terdapat dokumen
                            pendukung yang diperlukan.
                        </small>
                    </div>

                    <button
                        type="submit"
                        class="btn btn-danger w-100 py-2"
                    >
                        Upload Berkas
                    </button>

                </form>

            </div>
        </div>

    </div>

</body>
</html>