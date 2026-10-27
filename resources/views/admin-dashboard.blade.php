<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Dashboard Admin - PPDB SDN Kedung Dalam 1</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: #f6f7f9;
            color: #252b36;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background: #dc3545;
            padding: 12px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
        }

        .logo { width: 44px; height: 44px; object-fit: contain; }

        .logout {
            background: white;
            color: #dc3545;
            border: 0;
            border-radius: 7px;
            padding: 10px 16px;
            cursor: pointer;
        }

        .layout { display: flex; min-height: calc(100vh - 68px); }

        .sidebar {
            width: 240px;
            flex-shrink: 0;
            background: white;
            border-right: 1px solid #e5e7eb;
            padding: 30px 16px;
        }

        .sidebar-title {
            color: #969ba5;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1px;
            margin: 0 12px 20px;
        }

        .sidebar a {
            display: block;
            padding: 13px 15px;
            margin-bottom: 9px;
            border-radius: 8px;
            color: #555d6b;
            text-decoration: none;
            font-size: 14px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #dc3545;
            color: white;
        }

        .main { flex: 1; min-width: 0; padding: 35px; }

        .page-header { margin-bottom: 28px; }

        .page-header h1 { margin: 0 0 8px; font-size: 29px; }

        .muted { color: #777f8d; font-size: 14px; line-height: 1.6; }

        .section-title { font-size: 19px; margin: 0 0 16px; }

        .stats {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 15px;
            margin-bottom: 25px;
        }

        .stat {
            background: white;
            border: 1px solid #e7e9ee;
            border-top: 4px solid #dc3545;
            border-radius: 12px;
            padding: 20px 16px;
            box-shadow: 0 2px 6px #17203308;
        }
        

        .stat-label { color: #777f8d; font-size: 12px; min-height: 32px; margin: 0 0 10px; }
        .stat-number { font-size: 28px; font-weight: bold; margin: 0; }

        .panel {
            background: white;
            border: 1px solid #e7e9ee;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 2px 6px #17203308;
        }

        .panel-description { color: #777f8d; font-size: 13px; line-height: 1.6; margin: 0 0 20px; }

        .quota-summary {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            flex-wrap: wrap;
            gap: 10px;
        }

        .quota-number { font-size: 26px; font-weight: bold; margin-top: 5px; }
        .small-muted { color: #777f8d; font-size: 13px; }

        .progress-track {
            height: 12px;
            background: #eceef2;
            border-radius: 20px;
            overflow: hidden;
            margin: 14px 0;
        }

        .progress-fill { height: 100%; background: #dc3545; border-radius: 20px; }

        .quota-foot {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 8px;
            color: #777f8d;
            font-size: 12px;
        }

        .form-row { display: flex; align-items: flex-end; gap: 12px; flex-wrap: wrap; }
        .form-field { width: 100%; max-width: 300px; }
        .form-label { display: block; font-size: 14px; font-weight: bold; margin-bottom: 8px; }

        .form-input {
            width: 100%;
            padding: 11px;
            border: 1px solid #d9dde5;
            border-radius: 7px;
            font-size: 14px;
        }

        .primary-button {
            background: #dc3545;
            color: white;
            border: 0;
            border-radius: 7px;
            padding: 12px 18px;
            cursor: pointer;
            font-weight: bold;
        }

        .primary-button:hover { background: #bb2d3b; }

        .alert-success, .alert-error { padding: 12px; border-radius: 7px; font-size: 13px; margin-bottom: 15px; }
        .alert-success { background: #edf8f0; color: #24733a; }
        .alert-error { background: #fff0f0; color: #b42332; }

        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: 13px; }
        th { text-align: left; background: #f8f9fb; color: #687080; padding: 13px 12px; white-space: nowrap; }
        td { padding: 15px 12px; border-bottom: 1px solid #edf0f4; }
        tbody tr:last-child td { border-bottom: 0; }

        .status {
            display: inline-block;
            background: #f0f1f4;
            color: #555d6b;
            padding: 6px 9px;
            border-radius: 20px;
            font-size: 11px;
            white-space: nowrap;
        }

        .empty { text-align: center; color: #818896; padding: 25px 10px; }

        @media (max-width: 1100px) {
            .stats { grid-template-columns: repeat(3, minmax(0, 1fr)); }
            .main { padding: 25px; }
        }

        @media (max-width: 768px) {
            .layout { display: block; }
            .sidebar { width: 100%; padding: 16px; border-right: 0; border-bottom: 1px solid #e5e7eb; }
            .sidebar-title { margin-bottom: 10px; }
            .sidebar a { margin-bottom: 5px; padding: 10px 12px; }
            .main { padding: 22px 15px; }
            .stats { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 10px; }
            .stat { padding: 15px 12px; }
            .stat-number { font-size: 24px; }
            .panel { padding: 18px 14px; }
            .page-header h1 { font-size: 25px; }
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <a href="/" class="brand">
            <img src="{{ asset('images/logo-sekolah.png') }}" alt="Logo sekolah" class="logo">
            <span>SDN Kedung Dalam 1</span>
        </a>

        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="logout">Keluar</button>
        </form>
    </nav>

    <div class="layout">
        <aside class="sidebar">
            <p class="sidebar-title">MENU UTAMA</p>
            <a href="/admin/dashboard" class="active">Dashboard</a>
            <a href="/admin/pendaftar">Data Pendaftar</a>
            <a href="/admin/pengumuman">Pengumuman</a>
        </aside>

        <main class="main">
            <header class="page-header">
                <h1>Dashboard Admin</h1>
                <p class="muted">Selamat datang, Admin. Pantau pendaftaran dan kelola data PPDB SDN Kedung Dalam 1 di sini.</p>
            </header>

            <h2 class="section-title">Ringkasan Pendaftaran</h2>

            <div class="stats">
                <div class="stat">
                    <p class="stat-label">Total Pendaftar</p>
                    <p class="stat-number">{{ $totalPendaftar }}</p>
                </div>
                <div class="stat">
                    <p class="stat-label">Menunggu Verifikasi</p>
                    <p class="stat-number">{{ $menungguVerifikasi }}</p>
                </div>
                <div class="stat">
                    <p class="stat-label">Terverifikasi</p>
                    <p class="stat-number">{{ $terverifikasi }}</p>
                </div>
                <div class="stat">
                    <p class="stat-label">Lulus</p>
                    <p class="stat-number">{{ $lulus }}</p>
                </div>
                <div class="stat">
                    <p class="stat-label">Ditolak</p>
                    <p class="stat-number">{{ $ditolak }}</p>
                </div>
            </div>

            <section class="panel">
                <h2 class="section-title">Progres Kuota PPDB</h2>
                <p class="panel-description">Pantau jumlah pendaftar dibandingkan dengan kuota maksimal yang ditentukan.</p>

                <div class="quota-summary">
                    <div>
                        <div class="small-muted">Pendaftar saat ini</div>
                        <div class="quota-number">{{ $totalPendaftar }} <span class="small-muted">/ {{ $kuota }}</span></div>
                    </div>
                    <div class="small-muted">{{ $persentaseKuota }}% terpakai</div>
                </div>

                <div class="progress-track" role="progressbar" aria-valuenow="{{ $persentaseKuota }}" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-fill" style="width: {{ $persentaseKuota }}%;"></div>
                </div>

                <div class="quota-foot">
                    <span>Sisa kuota: {{ $sisaKuota }} peserta</span>
                    <span>Kuota maksimal: {{ $kuota }} peserta</span>
                </div>
            </section>

            <section class="panel">
                <h2 class="section-title">Pengaturan Kuota PPDB</h2>
                <p class="panel-description">Atur jumlah maksimal peserta yang dapat mendaftar.</p>

                @if (session('success'))
                    <div class="alert-success">{{ session('success') }}</div>
                @endif

                
@if ($errors->any())
    <div class="alert-error">
        {{ $errors->first() }}
    </div>
@endif

                <form action="{{ url('/admin/pengaturan-kuota') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-field">
                            <label for="kuota" class="form-label">Kuota Maksimal Pendaftar</label>
                            <input type="number" id="kuota" name="kuota" min="1" value="{{ old('kuota', $kuota) }}" class="form-input" required>
                        </div>
                        <button type="submit" class="primary-button">Simpan Kuota</button>
                    </div>
                </form>

            </section>

            <section class="panel">
                <h2 class="section-title">Pengaturan Jadwal Pendaftaran</h2>

                <p class="panel-description">
                    Atur tanggal dan jam pembukaan serta penutupan pendaftaran PPDB.
                </p>

                @if ($errors->any())
                    <div class="alert-error">
                        {{ $errors->first() }}
                    </div>
                @endif

                 @if (session('success_jadwal'))
                      <div class="alert-success">
                        {{ session('success_jadwal') }}
                      </div>
                @endif

                <form action="{{ url('/admin/pengaturan-jadwal') }}" method="POST">
                    @csrf

                    <div class="form-row">
                        <div class="form-field">
                            <label for="tanggal_buka" class="form-label">
                                Tanggal dan Jam Buka
                            </label>

                            <input
                                type="datetime-local"
                                id="tanggal_buka"
                                name="tanggal_buka"
                                value="{{ old('tanggal_buka', isset($pengaturan) && $pengaturan->tanggal_buka ? \Carbon\Carbon::parse($pengaturan->tanggal_buka)->format('Y-m-d\TH:i') : '') }}"
                                class="form-input"
                            >
                        </div>

                        <div class="form-field">
                            <label for="tanggal_tutup" class="form-label">
                                Tanggal dan Jam Tutup
                            </label>

                            <input
                                type="datetime-local"
                                id="tanggal_tutup"
                                name="tanggal_tutup"
                                value="{{ old('tanggal_tutup', isset($pengaturan) && $pengaturan->tanggal_tutup ? \Carbon\Carbon::parse($pengaturan->tanggal_tutup)->format('Y-m-d\TH:i') : '') }}"
                                class="form-input"
                            >
                        </div>
                    </div>

                    <p class="small-muted" style="margin: 14px 0;">
                        Kosongkan jadwal jika tanggal pendaftaran belum ditentukan.
                    </p>

                    <button type="submit" class="primary-button">
                        Simpan Jadwal
                    </button>
                </form>
            </section>

            <section class="panel">
                <h2 class="section-title">Pendaftar Terbaru</h2>
                <p class="panel-description">Lima pendaftaran terbaru yang tercatat di sistem.</p>

                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Pendaftar</th>
                                <th>Tanggal Daftar</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pendaftarTerbaru as $pendaftar)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pendaftar->nama_lengkap ?? '-' }}</td>
                                    <td>{{ $pendaftar->created_at ? $pendaftar->created_at->format('d/m/Y') : '-' }}</td>
                                    <td><span class="status">{{ $pendaftar->status ?? 'Belum ada status' }}</span></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="empty">Belum ada pendaftar yang tercatat.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
</body>
</html>