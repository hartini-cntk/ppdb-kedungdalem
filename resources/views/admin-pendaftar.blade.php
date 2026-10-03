<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Data Pendaftar - PPDB SDN Kedung Dalam 1</title>
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar bg-danger">
        <div class="container">
            <a href="/admin/dashboard" class="navbar-brand text-white fw-bold">
                SDN Kedung Dalam 1
            </a>

            <a href="/admin/dashboard" class="btn btn-light">
                Kembali
            </a>
        </div>
    </nav>

    <!-- Content -->
    <div class="container py-5">

        <div class="mb-4">
            <h1 class="fw-bold">Data Pendaftar</h1>

            <p class="text-secondary mb-0">
                Daftar calon siswa yang telah melakukan pendaftaran PPDB.
            </p>
        </div>

        <div class="card border-0 shadow-sm">
    <div class="card-body p-4">

        <div class="table-responsive">
            <table class="table table-bordered align-middle">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Asal Sekolah</th>
                        <th>Tanggal Daftar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($pendaftarans as $pendaftaran)

                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $pendaftaran->nama_lengkap }}</td>

                            <td>{{ $pendaftaran->asal_sekolah }}</td>

                            <td>{{ $pendaftaran->created_at->format('d M Y, H:i') }}</td>

                            <td>


    @if ($pendaftaran->status === 'Terverifikasi')

        <span class="badge text-bg-success">
            Terverifikasi
        </span>

    @elseif ($pendaftaran->status === 'Ditolak')

        <span class="badge text-bg-danger">
            Ditolak
        </span>

    @else

        <span class="badge text-bg-warning">
            {{ $pendaftaran->status }}
        </span>

    @endif

</td>


                            <td>
                                 <a href="/admin/pendaftar/{{ $pendaftaran->id }}"
                                    class="btn btn-sm btn-danger">
                                    Lihat Detail
                                 </a>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center text-secondary">
                                Belum ada data pendaftar.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>
        </div>

    </div>
</div>

    </div>

</body>
</html>