<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Pengumuman PPDB</title>
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar bg-danger">
        <div class="container">
            <a href="/dashboard" class="navbar-brand text-white fw-bold">
                SDN Kedung Dalam 1
            </a>

            <a href="/dashboard" class="btn btn-light">
                Kembali
            </a>
        </div>
    </nav>

    <div class="container py-5">

        <div class="mb-4">
            <h1 class="fw-bold">Pengumuman PPDB</h1>

            <p class="text-secondary">
                Informasi terbaru mengenai penerimaan peserta didik baru.
            </p>
        </div>

        @if ($pendaftaran && $pendaftaran->status === 'Lulus')

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">

            <h4 class="fw-bold text-success mb-2">
                🎉 Selamat!
            </h4>

            <p class="mb-3">
                Berdasarkan hasil seleksi PPDB SDN Kedung Dalem 1,
                kamu dinyatakan <strong class="text-success">LULUS</strong>.
            </p>

            <a
                href="/bukti-pendaftaran"
                class="btn btn-danger"
            >
                Lihat Bukti Pendaftaran
            </a>

        </div>
    </div>

@endif

        @forelse ($pengumumans as $pengumuman)

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">

                    <h4 class="fw-bold">
                        {{ $pengumuman->judul }}
                    </h4>

                    <p class="text-secondary small">
                        {{ $pengumuman->tanggal }}
                    </p>

                    <p class="mb-0">
                        {{ $pengumuman->isi }}
                    </p>

                </div>
            </div>

        @empty

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 text-center">
                    <p class="text-secondary mb-0">
                        Belum ada pengumuman.
                    </p>
                </div>
            </div>

        @endforelse

    </div>

</body>
</html>