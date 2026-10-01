<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Status Pendaftaran - PPDB SDN Kedung Dalem 1</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-white shadow-sm">
        <div class="container">

            <a class="navbar-brand fw-bold text-danger" href="/dashboard">
                PPDB SDN Kedung Dalem 1
            </a>

            <a href="/dashboard" class="btn btn-outline-danger btn-sm">
                Kembali
            </a>

        </div>
    </nav>

    <!-- Content -->
    <div class="container py-5">

        <div class="mb-4">
            <h1 class="fw-bold">Status Pendaftaran</h1>

            <p class="text-secondary">
                Berikut adalah status pendaftaran dan berkas kamu.
            </p>
        </div>

        <!-- Status Pendaftaran -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">

                <h4 class="fw-bold mb-3">Status Pendaftaran</h4>

                <p class="mb-0">
                    Status:
                    <span class="badge bg-warning text-dark">
                        {{ $pendaftaran->status }}
                    </span>
                </p>

            </div>
        </div>

        <!-- Status Berkas -->
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">

                <h4 class="fw-bold mb-4">Status Berkas</h4>

                @forelse ($pendaftaran->berkas as $berkas)

                    <div class="d-flex justify-content-between align-items-center
                                border-bottom py-3">

                        <div>
                            <p class="fw-semibold mb-1">
                                {{ $berkas->jenis_berkas }}
                            </p>

                            <small class="text-secondary">
                                {{ $berkas->nama_file }}
                            </small>
                        </div>

                        <span class="badge
                            @if ($berkas->status == 'Diterima')
                                bg-success
                            @elseif ($berkas->status == 'Ditolak')
                                bg-danger
                            @else
                                bg-warning text-dark
                            @endif
                        ">
                            {{ $berkas->status }}
                        </span>

                    </div>

                @empty

                    <p class="text-secondary mb-0">
                        Belum ada berkas yang diupload.
                    </p>

                @endforelse

            </div>
        </div>

    </div>

</body>
</html>