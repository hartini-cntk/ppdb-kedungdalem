<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Verifikasi Berkas - PPDB SDN Kedung Dalem 1</title>
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar bg-danger">
        <div class="container">

            <a href="/admin/dashboard"
               class="navbar-brand text-white fw-bold">
                SDN Kedung Dalem 1
            </a>

            <form method="POST" action="/logout">
                @csrf

                <button type="submit" class="btn btn-light">
                    Keluar
                </button>
            </form>

        </div>
    </nav>


    <!-- Content -->
    <div class="container py-5">

        <div class="mb-4">

            <h1 class="fw-bold">
                Verifikasi Berkas
            </h1>

            <p class="text-secondary">
                Periksa dan verifikasi berkas persyaratan calon siswa.
            </p>

        </div>


        @if (session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif


        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <h4 class="fw-bold mb-4">
                    Daftar Berkas Siswa
                </h4>


                @forelse ($berkas as $item)

                    <div class="border rounded p-3 mb-3">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <h5 class="fw-bold mb-1">
                                    {{ $item->pendaftaran->nama_lengkap ?? 'Nama Siswa' }}
                                </h5>

                                <p class="text-secondary mb-1">
                                    {{ $item->jenis_berkas }}
                                </p>

                                <small class="text-secondary">
                                    {{ $item->nama_file }}
                                </small>

                            </div>


                            <div>

                                @if ($item->status === 'Diterima')

                                    <span class="badge bg-success">
                                        Diterima
                                    </span>

                                @elseif ($item->status === 'Ditolak')

                                    <span class="badge bg-danger">
                                        Ditolak
                                    </span>

                                @else

                                    <span class="badge bg-warning text-dark">
                                        Menunggu Verifikasi
                                    </span>

                                @endif

                            </div>

                        </div>


                        <div class="mt-3">

                            <a
                                href="{{ asset('storage/' . $item->nama_file) }}"
                                target="_blank"
                                class="btn btn-sm btn-outline-secondary"
                            >
                                Lihat Berkas
                            </a>


                            @if ($item->status !== 'Diterima')

                                <form
                                    method="POST"
                                    action="/admin/berkas/{{ $item->id_berkas }}/terima"
                                    class="d-inline"
                                >
                                    @csrf

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-success"
                                    >
                                        Terima
                                    </button>

                                </form>

                            @endif


                            @if ($item->status !== 'Ditolak')

                                <form
                                    method="POST"
                                    action="/admin/berkas/{{ $item->id_berkas }}/tolak"
                                    class="d-inline"
                                >
                                    @csrf

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-danger"
                                    >
                                        Tolak
                                    </button>

                                </form>

                            @endif

                        </div>

                    </div>

                @empty

                    <div class="text-center py-5">

                        <p class="text-secondary mb-0">
                            Belum ada berkas yang diupload oleh siswa.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</body>
</html>