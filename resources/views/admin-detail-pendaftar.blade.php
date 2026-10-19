<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Detail Pendaftar - PPDB SDN Kedung Dalam 1</title>

    <style>
        body {
            background: #f7f8fc;
            color: #292d32;
        }

        .topbar {
            background: #c62828;
        }

        .page-title {
            font-weight: 750;
        }

        .detail-card {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 14px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, .04);
        }

        .tab-menu {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            padding: 8px;
            background: #fff;
            border: 1px solid #eee;
            border-radius: 14px;
            margin-bottom: 20px;
        }

        .tab-button {
            flex: 1;
            min-width: 130px;
            padding: 12px 14px;
            border: 0;
            border-radius: 9px;
            background: transparent;
            color: #555;
            font-weight: 600;
            transition: .2s;
        }

        .tab-button:hover {
            background: #fff0f0;
            color: #c62828;
        }

        .tab-button.active {
            background: #c62828;
            color: #fff;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .info-row {
            display: grid;
            grid-template-columns: minmax(140px, 210px) minmax(0, 1fr);
            gap: 16px;
            padding: 13px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .info-row:last-child {
            border-bottom: 0;
        }

        .info-label {
            color: #737373;
            font-size: .92rem;
        }

        .info-value {
            font-weight: 600;
            overflow-wrap: anywhere;
        }

        .subheading {
            color: #c62828;
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .document-row {
            padding: 16px 0;
            border-bottom: 1px solid #eee;
        }

        .document-row:last-child {
            border-bottom: 0;
        }

        .status-box {
            background: #fffafa;
            border: 1px solid #f0dddd;
            border-radius: 12px;
            padding: 20px;
        }

        @media (max-width: 576px) {
            .info-row {
                grid-template-columns: 1fr;
                gap: 4px;
            }

            .tab-button {
                min-width: calc(50% - 8px);
            }
        }
    </style>
</head>

<body>

<nav class="navbar topbar">
    <div class="container">
        <a href="/admin/dashboard" class="navbar-brand text-white fw-bold">
            SDN Kedung Dalam 1
        </a>

        <a href="/admin/pendaftar" class="btn btn-light btn-sm">
            Kembali
        </a>
    </div>
</nav>

<main class="container py-4 py-md-5">

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <p class="text-danger fw-semibold small mb-1">ADMINISTRATOR / DATA PENDAFTAR</p>
            <h1 class="page-title h2 mb-2">Detail Pendaftar</h1>
            <p class="text-secondary mb-0">
                Informasi lengkap calon siswa dan proses seleksi PPDB.
            </p>
        </div>

        <span class="badge rounded-pill text-bg-light border px-3 py-2">
            ID: {{ $pendaftaran->id }}
        </span>
    </div>

    <!-- Menu Tab -->
    <div class="tab-menu" role="tablist" aria-label="Detail pendaftar">
        <button type="button" class="tab-button active"
            id="btn-siswa" role="tab" aria-selected="true"
            aria-controls="tab-siswa" onclick="bukaTab('siswa')">
            Data Siswa
        </button>

        <button type="button" class="tab-button"
            id="btn-alamat" role="tab" aria-selected="false"
            aria-controls="tab-alamat" onclick="bukaTab('alamat')">
            Alamat
        </button>

        <button type="button" class="tab-button"
            id="btn-orangtua" role="tab" aria-selected="false"
            aria-controls="tab-orangtua" onclick="bukaTab('orangtua')">
            Data Orang Tua
        </button>

        <button type="button" class="tab-button"
            id="btn-berkas" role="tab" aria-selected="false"
            aria-controls="tab-berkas" onclick="bukaTab('berkas')">
            Berkas & Status
        </button>
    </div>

    <!-- TAB 1: DATA SISWA -->
    <section id="tab-siswa" class="tab-content active detail-card p-3 p-md-4"
        role="tabpanel" aria-labelledby="btn-siswa">

        <h2 class="section-title">Data Calon Siswa</h2>

        <div class="info-row">
            <span class="info-label">Nama Lengkap</span>
            <span class="info-value">{{ $pendaftaran->nama_lengkap }}</span>
        </div>

        <div class="info-row">
            <span class="info-label">NIK</span>
            <span class="info-value">{{ $pendaftaran->nik }}</span>
        </div>

        <div class="info-row">
            <span class="info-label">NISN</span>
            <span class="info-value">{{ $pendaftaran->nisn ?? '-' }}</span>
        </div>

        <div class="info-row">
            <span class="info-label">Jenis Kelamin</span>
            <span class="info-value">{{ $pendaftaran->jenis_kelamin }}</span>
        </div>

        <div class="info-row">
            <span class="info-label">Agama</span>
            <span class="info-value">{{ $pendaftaran->agama }}</span>
        </div>

        <div class="info-row">
            <span class="info-label">Tempat, Tanggal Lahir</span>
            <span class="info-value">
                {{ $pendaftaran->tempat_lahir }},
                {{ $pendaftaran->tanggal_lahir }}
            </span>
        </div>

        <div class="info-row">
            <span class="info-label">Asal Sekolah</span>
            <span class="info-value">{{ $pendaftaran->asal_sekolah }}</span>
        </div>
    </section>

    <!-- TAB 2: ALAMAT -->
    <section id="tab-alamat" class="tab-content detail-card p-3 p-md-4"
        role="tabpanel" aria-labelledby="btn-alamat">

        <h2 class="section-title">Alamat Tempat Tinggal</h2>

        <div class="info-row">
            <span class="info-label">Alamat Lengkap</span>
            <span class="info-value">{{ $pendaftaran->alamat }}</span>
        </div>

        <div class="info-row">
            <span class="info-label">RT/RW</span>
            <span class="info-value">{{ $pendaftaran->rt }}/{{ $pendaftaran->rw }}</span>
        </div>

        <div class="info-row">
            <span class="info-label">Desa/Kelurahan</span>
            <span class="info-value">{{ $pendaftaran->desa }}</span>
        </div>

        <div class="info-row">
            <span class="info-label">Kecamatan</span>
            <span class="info-value">{{ $pendaftaran->kecamatan }}</span>
        </div>

        <div class="info-row">
            <span class="info-label">Kabupaten/Kota</span>
            <span class="info-value">{{ $pendaftaran->kabupaten }}</span>
        </div>

        <div class="info-row">
            <span class="info-label">Provinsi</span>
            <span class="info-value">{{ $pendaftaran->provinsi }}</span>
        </div>
    </section>

    <!-- TAB 3: DATA ORANG TUA -->
    <section id="tab-orangtua" class="tab-content detail-card p-3 p-md-4"
        role="tabpanel" aria-labelledby="btn-orangtua">

        <h2 class="section-title">Data Orang Tua/Wali</h2>

        <div class="row g-4">
            <div class="col-12 col-lg-6">
                <h3 class="subheading">Data Ayah</h3>

                <div class="info-row">
                    <span class="info-label">Nama</span>
                    <span class="info-value">{{ $pendaftaran->nama_ayah }}</span>
                </div>

                <div class="info-row">
                    <span class="info-label">NIK</span>
                    <span class="info-value">{{ $pendaftaran->nik_ayah }}</span>
                </div>

                <div class="info-row">
                    <span class="info-label">Pendidikan</span>
                    <span class="info-value">{{ $pendaftaran->pendidikan_ayah }}</span>
                </div>

                <div class="info-row">
                    <span class="info-label">Pekerjaan</span>
                    <span class="info-value">{{ $pendaftaran->pekerjaan_ayah }}</span>
                </div>

                <div class="info-row">
                    <span class="info-label">Penghasilan</span>
                    <span class="info-value">{{ $pendaftaran->penghasilan_ayah }}</span>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <h3 class="subheading">Data Ibu</h3>

                <div class="info-row">
                    <span class="info-label">Nama</span>
                    <span class="info-value">{{ $pendaftaran->nama_ibu }}</span>
                </div>

                <div class="info-row">
                    <span class="info-label">NIK</span>
                    <span class="info-value">{{ $pendaftaran->nik_ibu }}</span>
                </div>

                <div class="info-row">
                    <span class="info-label">Pendidikan</span>
                    <span class="info-value">{{ $pendaftaran->pendidikan_ibu }}</span>
                </div>

                <div class="info-row">
                    <span class="info-label">Pekerjaan</span>
                    <span class="info-value">{{ $pendaftaran->pekerjaan_ibu }}</span>
                </div>

                <div class="info-row">
                    <span class="info-label">Penghasilan</span>
                    <span class="info-value">{{ $pendaftaran->penghasilan_ibu }}</span>
                </div>
            </div>

            <div class="col-12">
                <div class="info-row">
                    <span class="info-label">No. HP Orang Tua/Wali</span>
                    <span class="info-value">{{ $pendaftaran->no_hp }}</span>
                </div>
            </div>
        </div>
    </section>

    <!-- TAB 4: BERKAS DAN STATUS -->
    <section id="tab-berkas" class="tab-content"
        role="tabpanel" aria-labelledby="btn-berkas">

        <div class="detail-card p-3 p-md-4 mb-4">
            <h2 class="section-title">Berkas Pendaftar</h2>

            @forelse ($pendaftaran->berkas as $berkas)
                <div class="document-row">
                    <div class="d-flex flex-column flex-md-row justify-content-between gap-3">
                        <div>
                            <p class="fw-bold mb-2">{{ $berkas->jenis_berkas }}</p>

                            <span class="text-secondary small">Status: </span>

                            @if ($berkas->status === 'Diterima')
                                <span class="badge text-bg-success">Diterima</span>
                            @elseif ($berkas->status === 'Ditolak')
                                <span class="badge text-bg-danger">Ditolak</span>
                            @else
                                <span class="badge text-bg-warning">{{ $berkas->status }}</span>
                            @endif
                        </div>

                        <div class="d-flex flex-wrap gap-2 align-items-start">
                            <a href="{{ asset('storage/' . $berkas->nama_file) }}"
                                target="_blank" rel="noopener noreferrer"
                                class="btn btn-sm btn-outline-danger">
                                Lihat Berkas
                            </a>

                            @if ($berkas->status === 'Diterima')
                                <span class="badge text-bg-success py-2 px-3">Sudah Diterima</span>
                            @elseif ($berkas->status === 'Ditolak')
                                <span class="badge text-bg-danger py-2 px-3">Sudah Ditolak</span>
                            @else
                                <form method="POST"
    action="/admin/berkas/{{ $berkas->id_berkas }}/terima">
    @csrf
    <button type="submit" class="btn btn-sm btn-success">
        Terima
    </button>
</form>

<form method="POST"
    action="/admin/berkas/{{ $berkas->id_berkas }}/tolak">
    @csrf
    <button type="submit" class="btn btn-sm btn-danger">
        Tolak
    </button>
</form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-secondary mb-0">
                    Belum ada berkas yang diunggah oleh pendaftar.
                </p>
            @endforelse
        </div>

        <div class="detail-card p-3 p-md-4">
            <h2 class="section-title">Status Pendaftaran</h2>

            <div class="status-box mb-4">
                <p class="text-secondary mb-2">Status saat ini</p>

                
<h3 class="h5 fw-bold mb-0">
    @if ($pendaftaran->status === 'Lulus')
        <span class="badge text-bg-success">Lulus</span>
    @elseif ($pendaftaran->status === 'Tidak Lulus')
        <span class="badge text-bg-danger">Tidak Lulus</span>
    @elseif ($pendaftaran->status === 'Terverifikasi')
        <span class="badge text-bg-primary">Terverifikasi</span>
    @else
        <span class="badge text-bg-warning">
            {{ $pendaftaran->status }}
        </span>
    @endif
</h3>

            </div>

            <div class="d-flex flex-wrap gap-2">
                @if ($pendaftaran->status !== 'Terverifikasi'
                    && $pendaftaran->status !== 'Lulus'
                    && $pendaftaran->status !== 'Tidak Lulus')
                    <form method="POST"
                        action="/admin/pendaftar/{{ $pendaftaran->id }}/verifikasi">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            Verifikasi Pendaftaran
                        </button>
                    </form>
                @endif

                
                @if ($pendaftaran->status !== 'Lulus' && $pendaftaran->status !== 'Tidak Lulus')
                    <form method="POST"
                        action="/admin/pendaftar/{{ $pendaftaran->id }}/lulus">
                        @csrf
                        <button type="submit" class="btn btn-success">
                            Lulus
                        </button>
                    </form>

                    <form method="POST"
                        action="/admin/pendaftar/{{ $pendaftaran->id }}/tidak-lulus">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            Tidak Lulus
                        </button>
                    </form>
                @endif

            </div>
        </div>
    </section>

</main>

<script>
    function bukaTab(nama) {
        document.querySelectorAll('.tab-content').forEach(function (tab) {
            tab.classList.remove('active');
        });

        document.querySelectorAll('.tab-button').forEach(function (tombol) {
            tombol.classList.remove('active');
            tombol.setAttribute('aria-selected', 'false');
        });

        document.getElementById('tab-' + nama).classList.add('active');

        const tombolAktif = document.getElementById('btn-' + nama);
        tombolAktif.classList.add('active');
        tombolAktif.setAttribute('aria-selected', 'true');
    }
</script>

</body>
</html>