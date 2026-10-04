<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Detail Pendaftar - PPDB SDN Kedung Dalam 1</title>
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar bg-danger">
        <div class="container">
            <a href="/admin/dashboard" class="navbar-brand text-white fw-bold">
                SDN Kedung Dalam 1
            </a>

            <a href="/admin/pendaftar" class="btn btn-light">
                Kembali
            </a>
        </div>
    </nav>

   <!-- Content -->
<div class="container py-5">

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="mb-4">
        <h1 class="fw-bold">Detail Pendaftar</h1>

        <p class="text-secondary mb-0">
            Informasi lengkap calon siswa yang telah mendaftar.
        </p>
    </div>

        <!-- Data Calon Siswa -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">

                <h4 class="fw-bold mb-4">Data Calon Siswa</h4>

                <p><strong>Nama Lengkap:</strong>
                    {{ $pendaftaran->nama_lengkap }}
                </p>

                <p><strong>NIK:</strong>
                    {{ $pendaftaran->nik }}
                </p>

                <p><strong>NISN:</strong>
                    {{ $pendaftaran->nisn ?? '-' }}
                </p>

                <p><strong>Jenis Kelamin:</strong>
                    {{ $pendaftaran->jenis_kelamin }}
                </p>

                <p><strong>Agama:</strong>
                    {{ $pendaftaran->agama }}
                </p>

                <p><strong>Tempat, Tanggal Lahir:</strong>
                    {{ $pendaftaran->tempat_lahir }},
                    {{ $pendaftaran->tanggal_lahir }}
                </p>

                <p><strong>Asal Sekolah:</strong>
                    {{ $pendaftaran->asal_sekolah }}
                </p>

            </div>
        </div>

        <!-- Alamat -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">

                <h4 class="fw-bold mb-4">Alamat Tempat Tinggal</h4>

                <p><strong>Alamat:</strong>
                    {{ $pendaftaran->alamat }}
                </p>

                <p><strong>RT/RW:</strong>
                    {{ $pendaftaran->rt }}/{{ $pendaftaran->rw }}
                </p>

                <p><strong>Desa/Kelurahan:</strong>
                    {{ $pendaftaran->desa }}
                </p>

                <p><strong>Kecamatan:</strong>
                    {{ $pendaftaran->kecamatan }}
                </p>

                <p><strong>Kabupaten/Kota:</strong>
                    {{ $pendaftaran->kabupaten }}
                </p>

                <p><strong>Provinsi:</strong>
                    {{ $pendaftaran->provinsi }}
                </p>

            </div>
        </div>

        <!-- Data Orang Tua -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">

                <h4 class="fw-bold mb-4">Data Orang Tua/Wali</h4>

                <h5 class="fw-bold">Data Ayah</h5>

                <p><strong>Nama:</strong>
                    {{ $pendaftaran->nama_ayah }}
                </p>

                <p><strong>NIK:</strong>
                    {{ $pendaftaran->nik_ayah }}
                </p>

                <p><strong>Pendidikan:</strong>
                    {{ $pendaftaran->pendidikan_ayah }}
                </p>

                <p><strong>Pekerjaan:</strong>
                    {{ $pendaftaran->pekerjaan_ayah }}
                </p>

                <p><strong>Penghasilan:</strong>
                    {{ $pendaftaran->penghasilan_ayah }}
                </p>

                <hr>

                <h5 class="fw-bold">Data Ibu</h5>

                <p><strong>Nama:</strong>
                    {{ $pendaftaran->nama_ibu }}
                </p>

                <p><strong>NIK:</strong>
                    {{ $pendaftaran->nik_ibu }}
                </p>

                <p><strong>Pendidikan:</strong>
                    {{ $pendaftaran->pendidikan_ibu }}
                </p>

                <p><strong>Pekerjaan:</strong>
                    {{ $pendaftaran->pekerjaan_ibu }}
                </p>

                <p><strong>Penghasilan:</strong>
                    {{ $pendaftaran->penghasilan_ibu }}
                </p>

                <hr>

                <p><strong>No. HP Orang Tua/Wali:</strong>
                    {{ $pendaftaran->no_hp }}
                </p>

            </div>
        </div>

        <!-- Berkas Pendaftar -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-4">

        <h4 class="fw-bold mb-4">Berkas Pendaftar</h4>

        @forelse ($pendaftaran->berkas as $berkas)

            <div class="border-bottom py-3">

                <div class="mb-2">
                    <p class="fw-semibold mb-1">
                        {{ $berkas->jenis_berkas }}
                    </p>

                    <small class="text-secondary">
                        Status: {{ $berkas->status }}
                    </small>
                </div>

                <div class="d-flex gap-2 flex-wrap">

    <a
        href="{{ asset('storage/' . $berkas->nama_file) }}"
        target="_blank"
        class="btn btn-sm btn-outline-danger"
    >
        Lihat Berkas
    </a>

    @if ($berkas->status === 'Diterima')

        <span class="badge bg-success d-flex align-items-center px-3">
            Diterima
        </span>

    @elseif ($berkas->status === 'Ditolak')

        <span class="badge bg-danger d-flex align-items-center px-3">
            Ditolak
        </span>

    @else

        <form
            method="POST"
            action="/admin/berkas/{{ $berkas->id_berkas }}/terima"
        >
            @csrf

            <button type="submit" class="btn btn-sm btn-success">
                Terima
            </button>
        </form>

        <form
            method="POST"
            action="/admin/berkas/{{ $berkas->id_berkas }}/tolak"
        >
            @csrf

            <button type="submit" class="btn btn-sm btn-danger">
                Tolak
            </button>
        </form>

    @endif

</div>

            </div>

        @empty

            <p class="text-secondary mb-0">
                Belum ada berkas yang diupload.
            </p>

        @endforelse

    </div>
</div>

        <!-- Status -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">

        <h4 class="fw-bold mb-3">
            Status Pendaftaran
        </h4>

        @if ($pendaftaran->status === 'Lulus')

            <span class="badge text-bg-success px-3 py-2">
                Lulus
            </span>

            <p class="text-secondary mt-3 mb-0">
                Siswa ini dinyatakan lulus dalam proses PPDB.
            </p>

        @elseif ($pendaftaran->status === 'Tidak Lulus')

            <span class="badge text-bg-danger px-3 py-2">
                Tidak Lulus
            </span>

            <p class="text-secondary mt-3 mb-0">
                Siswa ini dinyatakan tidak lulus dalam proses PPDB.
            </p>

        @elseif ($pendaftaran->status === 'Terverifikasi')

            <span class="badge text-bg-success px-3 py-2">
                Terverifikasi
            </span>

            <p class="text-secondary mt-3">
                Data dan seluruh berkas siswa sudah diverifikasi.
            </p>

            <hr>

            <p class="fw-semibold mb-2">
                Tentukan Hasil Seleksi
            </p>

            <div class="d-flex gap-2">

                <form
                    method="POST"
                    action="/admin/pendaftar/{{ $pendaftaran->id }}/lulus"
                >
                    @csrf

                    <button type="submit" class="btn btn-success">
                        Lulus
                    </button>
                </form>

                <form
                    method="POST"
                    action="/admin/pendaftar/{{ $pendaftaran->id }}/tidak-lulus"
                >
                    @csrf

                    <button type="submit" class="btn btn-danger">
                        Tidak Lulus
                    </button>
                </form>

            </div>

        @else

            <span class="badge text-bg-warning px-3 py-2">
                {{ $pendaftaran->status }}
            </span>

            @if (
                $pendaftaran->berkas->count() > 0 &&
                $pendaftaran->berkas->every(function ($berkas) {
                    return $berkas->status === 'Diterima';
                })
            )

                <form
                    method="POST"
                    action="/admin/pendaftar/{{ $pendaftaran->id }}/verifikasi"
                    class="mt-3"
                >
                    @csrf

                    <button type="submit" class="btn btn-success">
                        Verifikasi Pendaftaran
                    </button>
                </form>

            @else

                <button
                    type="button"
                    class="btn btn-secondary mt-3"
                    disabled
                >
                    Verifikasi Pendaftaran
                </button>

                <p class="text-secondary mt-2 mb-0">
                    Verifikasi pendaftaran dapat dilakukan setelah semua berkas diterima.
                </p>

            @endif

        @endif

            </div>
         </div>
    </div>

</body>
</html>