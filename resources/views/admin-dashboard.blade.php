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
            font-family: Segoe UI, Tahoma, system-ui, sans-serif;
        }

        .navbar {
            background: #103765;
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

        .profile-menu { position: relative; }
.profile-trigger { background: transparent; border: 0; padding: 4px; cursor: pointer; }
.profile-trigger .profile-avatar { width: 42px; height: 42px; border: 2px solid rgba(255,255,255,.75); font-size: 16px; }
.profile-trigger:hover .profile-avatar { background: white; }
        .profile-avatar { width: 30px; height: 30px; border-radius: 50%; display: grid; place-items: center; background: #e7effa; color: #103765; font-weight: 700; }
        .profile-dropdown { display: none; position: absolute; z-index: 20; right: 0; top: calc(100% + 10px); width: 290px; padding: 12px; background: white; border: 1px solid #e5e7eb; border-radius: 12px; box-shadow: 0 12px 30px rgba(16, 55, 101, .18); color: #252b36; }
        .profile-menu.open .profile-dropdown { display: block; }
        .profile-form { max-height: 60vh; overflow-y: auto; padding: 8px 2px 2px; }
.profile-form label { display:block; color:#475467; font-size:13px; font-weight:600; margin:12px 0 5px; }
.profile-form input { width:100%; padding:10px 11px; border:1px solid #d0d5dd; border-radius:7px; font:inherit; }
.profile-form input:focus { outline:2px solid #b2d4ff; border-color:#1769c2; }
.profile-summary { text-align: center; padding: 18px 12px; background: #f1f5fb; border-radius: 9px; }
        .profile-summary .profile-avatar { width: 54px; height: 54px; margin: 0 auto 10px; font-size: 20px; }
        .profile-email { color: #697386; font-size: 13px; overflow-wrap: anywhere; margin-top: 4px; }
        .profile-logout { width: 100%; margin-top: 10px; padding: 10px; background: white; border: 1px solid #e5e7eb; border-radius: 8px; color: #b42318; cursor: pointer; }


        .layout { display: flex; min-height: calc(100vh - 68px); }

        .sidebar {
            position: sticky;
            top: 0;
            height: calc(100vh - 68px);
            overflow-y: auto;
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
            background: #1769c2;
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
            border-top: 4px solid #1769c2;
            border-radius: 12px;
            padding: 20px 16px;
            box-shadow: 0 2px 6px #17203308;
        }

        .stat-label {
            color: #777f8d;
            font-size: 12px;
            min-height: 32px;
            margin: 0 0 10px;
        }

        .stat-number { font-size: 28px; font-weight: bold; margin: 0; }

        .panel {
            background: white;
            border: 1px solid #e7e9ee;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 2px 6px #17203308;
        }

        .panel-description {
            color: #777f8d;
            font-size: 13px;
            line-height: 1.6;
            margin: 0 0 20px;
        }

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

        .progress-fill { height: 100%; background: #1769c2; border-radius: 20px; }

        .quota-foot {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 8px;
            color: #777f8d;
            font-size: 12px;
        }

        .form-row {
            display: flex;
            align-items: flex-end;
            gap: 12px;
            flex-wrap: wrap;
        }

        .form-field { width: 100%; max-width: 300px; }

        .form-field.full-width {
            max-width: 100%;
            flex: 1 1 100%;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .form-input {
            width: 100%;
            padding: 11px;
            border: 1px solid #d9dde5;
            border-radius: 7px;
            font-size: 14px;
            font-family: Segoe UI, Tahoma, system-ui, sans-serif;
        }

        textarea.form-input {
            min-height: 120px;
            resize: vertical;
            line-height: 1.6;
        }

        .primary-button {
            background: #1769c2;
            color: white;
            border: 0;
            border-radius: 7px;
            padding: 12px 18px;
            cursor: pointer;
            font-weight: bold;
        }

        .primary-button:hover { background: #103765; }

        .alert-success, .alert-error {
            padding: 12px;
            border-radius: 7px;
            font-size: 13px;
            margin-bottom: 15px;
        }

        .alert-success { background: #edf8f0; color: #24733a; }
        .alert-error { background: #fff0f0; color: #b42332; }

        .table-wrap { overflow-x: auto; }

        table { width: 100%; border-collapse: collapse; font-size: 13px; }

        th {
            text-align: left;
            background: #f8f9fb;
            color: #687080;
            padding: 13px 12px;
            white-space: nowrap;
        }

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
            .sidebar {
                width: 100%;
                padding: 16px;
                border-right: 0;
                border-bottom: 1px solid #e5e7eb;
            }
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

        <div class="profile-menu" id="profileMenu">
            <button type="button" class="profile-trigger" id="profileTrigger" aria-expanded="false">
                <span class="profile-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</span>
            </button>
            <div class="profile-dropdown">
                <div class="profile-summary">
                    <div class="profile-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
                    <strong>{{ auth()->user()->name ?? 'Admin' }}</strong>
                    <div class="profile-email">{{ auth()->user()->email ?? '' }}</div>
                </div>
                <button type="button" class="profile-logout" id="editProfileTrigger" style="color:#1769c2">Edit Profil</button>
                <form method="POST" action="/admin/profile" id="editProfileForm" hidden class="profile-form">
                    @csrf
                    <label style="display:block;font-size:13px;margin:8px 0 4px">Nama admin</label>
                    <input name="name" value="{{ old('name', auth()->user()->name) }}" required maxlength="255" style="width:100%;padding:9px;border:1px solid #d6dce5;border-radius:7px">
                    <label style="display:block;font-size:13px;margin:8px 0 4px">Email</label>
                    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required style="width:100%;padding:9px;border:1px solid #d6dce5;border-radius:7px">
                    <label style="display:block;font-size:13px;margin:8px 0 4px">Password saat ini (untuk ganti password)</label>
                    <input type="password" name="current_password" autocomplete="current-password" style="width:100%;padding:9px;border:1px solid #d6dce5;border-radius:7px">
                    <label style="display:block;font-size:13px;margin:8px 0 4px">Password baru (opsional)</label>
                    <input type="password" name="new_password" autocomplete="new-password" style="width:100%;padding:9px;border:1px solid #d6dce5;border-radius:7px">
                    <label style="display:block;font-size:13px;margin:8px 0 4px">Ulangi password baru</label>
                    <input type="password" name="new_password_confirmation" autocomplete="new-password" style="width:100%;padding:9px;border:1px solid #d6dce5;border-radius:7px">
                    <button type="submit" class="profile-logout" style="background:#1769c2;color:white">Simpan Profil</button>
                </form>
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="profile-logout">Keluar</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="layout">
        <aside class="sidebar">
            <p class="sidebar-title">MENU UTAMA</p>
            <a href="#ringkasan" class="admin-menu active" data-target="ringkasan">Dashboard</a>
            <a href="#kuota" class="admin-menu" data-target="kuota">Pengaturan Kuota</a>
            <a href="#jadwal" class="admin-menu" data-target="jadwal">Jadwal Pendaftaran</a>
            <a href="#daftar-ulang" class="admin-menu" data-target="daftar-ulang">Informasi Daftar Ulang</a>
            <a href="/admin/pendaftar">Data Pendaftar</a>
        </aside>

        <main class="main">
            <header class="page-header">
                <h1>Dashboard Admin</h1>
                <p class="muted">
                    Selamat datang, Admin. Pantau pendaftaran dan kelola data PPDB SDN Kedung Dalam 1 di sini.
                </p>
            </header>

            <h2 class="section-title">Ringkasan Pendaftaran</h2>

            <div class="stats" data-summary-stats>
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

            <!-- PROGRES KUOTA -->
            <section class="panel menu-panel" id="progress-kuota" data-menu-panel="ringkasan kuota">
                <h2 class="section-title">Progres Kuota PPDB</h2>
                <p class="panel-description">
                    Pantau jumlah pendaftar dibandingkan dengan kuota maksimal yang ditentukan.
                </p>

                <div class="quota-summary">
                    <div>
                        <div class="small-muted">Pendaftar saat ini</div>
                        <div class="quota-number">
                            {{ $totalPendaftar }}
                            <span class="small-muted">/ {{ $kuota }}</span>
                        </div>
                    </div>
                    <div class="small-muted">{{ $persentaseKuota }}% terpakai</div>
                </div>

                <div class="progress-track" role="progressbar"
                    aria-valuenow="{{ $persentaseKuota }}"
                    aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-fill" style="width: {{ $persentaseKuota }}%;"></div>
                </div>

                <div class="quota-foot">
                    <span>Sisa kuota: {{ $sisaKuota }} peserta</span>
                    <span>Kuota maksimal: {{ $kuota }} peserta</span>
                </div>
            </section>

            <!-- PENGATURAN KUOTA -->
            <section class="panel menu-panel" id="kuota" data-menu-panel="kuota">
                <h2 class="section-title">Pengaturan Kuota PPDB</h2>
                <p class="panel-description">
                    Atur jumlah maksimal peserta yang dapat mendaftar.
                </p>

                @if (session('success'))
                    <div class="alert-success">{{ session('success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert-error">{{ $errors->first() }}</div>
                @endif

                <form action="{{ url('/admin/pengaturan-kuota') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-field">
                            <label for="kuota" class="form-label">Kuota Maksimal Pendaftar</label>
                            <input type="number" id="kuota" name="kuota"
                                min="1" value="{{ old('kuota', $kuota) }}"
                                class="form-input" required>
                        </div>
                        <button type="submit" class="primary-button">Simpan Kuota</button>
                    </div>
                </form>
            </section>

            <!-- PENGATURAN JADWAL -->
            <section class="panel menu-panel" id="jadwal" data-menu-panel="jadwal">
                <h2 class="section-title">Pengaturan Jadwal Pendaftaran</h2>

                <p class="panel-description">
                    Atur tanggal dan jam pembukaan serta penutupan pendaftaran PPDB.
                </p>

                @if (session('success_jadwal'))
                    <div class="alert-success">{{ session('success_jadwal') }}</div>
                @endif

                <form action="{{ url('/admin/pengaturan-jadwal') }}" method="POST">
                    @csrf

                    <div class="form-row">
                        <div class="form-field">
                            <label for="tanggal_buka" class="form-label">
                                Tanggal dan Jam Buka
                            </label>
                            <input type="datetime-local" id="tanggal_buka"
                                name="tanggal_buka"
                                value="{{ old('tanggal_buka', isset($pengaturan) && $pengaturan->tanggal_buka ? \Carbon\Carbon::parse($pengaturan->tanggal_buka)->format('Y-m-d\TH:i') : '') }}"
                                class="form-input">
                        </div>

                        <div class="form-field">
                            <label for="tanggal_tutup" class="form-label">
                                Tanggal dan Jam Tutup
                            </label>
                            <input type="datetime-local" id="tanggal_tutup"
                                name="tanggal_tutup"
                                value="{{ old('tanggal_tutup', isset($pengaturan) && $pengaturan->tanggal_tutup ? \Carbon\Carbon::parse($pengaturan->tanggal_tutup)->format('Y-m-d\TH:i') : '') }}"
                                class="form-input">
                        </div>
                    </div>

                    <p class="small-muted" style="margin: 14px 0;">
                        Kosongkan jadwal jika tanggal pendaftaran belum ditentukan.
                    </p>

                    <button type="submit" class="primary-button">Simpan Jadwal</button>
                </form>
            </section>

            <!-- PENGATURAN DAFTAR ULANG -->
            <section class="panel menu-panel" id="daftar-ulang" data-menu-panel="daftar-ulang">
                <h2 class="section-title">Informasi Daftar Ulang</h2>

                <p class="panel-description">
                    Isi informasi pelaksanaan daftar ulang bagi calon siswa yang dinyatakan lulus.
                    Informasi ini nantinya ditampilkan di dashboard siswa yang berstatus Lulus.
                </p>

                @if (session('success_daftar_ulang'))
                    <div class="alert-success">
                        {{ session('success_daftar_ulang') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert-error">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ url('/admin/pengaturan-daftar-ulang') }}" method="POST">
                    @csrf

                    <div class="form-row">
                        <div class="form-field">
                            <label for="tanggal_daftar_ulang" class="form-label">
                                Tanggal Daftar Ulang
                            </label>
                            <input
                                type="date"
                                id="tanggal_daftar_ulang"
                                name="tanggal_daftar_ulang"
                                value="{{ old('tanggal_daftar_ulang', isset($pengaturan) && $pengaturan->tanggal_daftar_ulang ? \Carbon\Carbon::parse($pengaturan->tanggal_daftar_ulang)->format('Y-m-d') : '') }}"
                                class="form-input"
                            >
                        </div>

                        <div class="form-field">
                            <label for="jam_daftar_ulang" class="form-label">
                                Jam Daftar Ulang
                            </label>
                            <input
                                type="text"
                                id="jam_daftar_ulang"
                                name="jam_daftar_ulang"
                                value="{{ old('jam_daftar_ulang', $pengaturan->jam_daftar_ulang ?? '') }}"
                                class="form-input"
                                placeholder="Contoh: 08.00 - 12.00 WIB"
                            >
                        </div>

                        <div class="form-field full-width">
                            <label for="lokasi_daftar_ulang" class="form-label">
                                Lokasi Daftar Ulang
                            </label>
                            <input
                                type="text"
                                id="lokasi_daftar_ulang"
                                name="lokasi_daftar_ulang"
                                value="{{ old('lokasi_daftar_ulang', $pengaturan->lokasi_daftar_ulang ?? '') }}"
                                class="form-input"
                                placeholder="Contoh: SDN Kedung Dalem 1"
                            >
                        </div>

                        <div class="form-field full-width">
                            <label for="persyaratan_daftar_ulang" class="form-label">
                                Persyaratan Daftar Ulang
                            </label>
                            <textarea
                                id="persyaratan_daftar_ulang"
                                name="persyaratan_daftar_ulang"
                                class="form-input"
                                placeholder="Tuliskan persyaratan daftar ulang. Pisahkan setiap persyaratan dengan baris baru."
                            >{{ old('persyaratan_daftar_ulang', $pengaturan->persyaratan_daftar_ulang ?? '') }}</textarea>
                        </div>
                    </div>

                    <p class="small-muted" style="margin: 14px 0;">
                        Informasi dapat dikosongkan jika jadwal daftar ulang belum ditentukan.
                    </p>

                    <button type="submit" class="primary-button">
                        Simpan Informasi Daftar Ulang
                    </button>
                </form>
            </section>

            <!-- PENDAFTAR TERBARU -->
            <section class="panel menu-panel" id="terbaru" data-menu-panel="ringkasan">
                <h2 class="section-title">Pendaftar Terbaru</h2>
                <p class="panel-description">
                    Lima pendaftaran terbaru yang tercatat di sistem.
                </p>

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
                                    <td>
                                        {{ $pendaftar->created_at ? $pendaftar->created_at->format('d/m/Y') : '-' }}
                                    </td>
                                    <td>
                                        <span class="status">
                                            {{ $pendaftar->status ?? 'Belum ada status' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="empty">
                                        Belum ada pendaftar yang tercatat.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const profileMenu = document.getElementById('profileMenu');
            const profileTrigger = document.getElementById('profileTrigger');
            const editProfileTrigger = document.getElementById('editProfileTrigger');
            const editProfileForm = document.getElementById('editProfileForm');
            editProfileTrigger?.addEventListener('click', () => { editProfileForm.hidden = !editProfileForm.hidden; });
            profileTrigger?.addEventListener('click', () => {
                const isOpen = profileMenu.classList.toggle('open');
                profileTrigger.setAttribute('aria-expanded', String(isOpen));
            });
            document.addEventListener('click', event => {
                if (profileMenu && !profileMenu.contains(event.target)) {
                    profileMenu.classList.remove('open');
                    profileTrigger?.setAttribute('aria-expanded', 'false');
                }
            });

            const menus = document.querySelectorAll('.admin-menu');
            const panels = document.querySelectorAll('[data-menu-panel]');
            const summaryStats = document.querySelector('[data-summary-stats]');
            const showPanel = (target) => {
                panels.forEach(panel => panel.hidden = !panel.dataset.menuPanel.split(" ").includes(target));
                if (summaryStats) summaryStats.hidden = target !== 'ringkasan';
                menus.forEach(menu => menu.classList.toggle('active', menu.dataset.target === target));
            };
            menus.forEach(menu => menu.addEventListener('click', event => {
                event.preventDefault();
                const target = menu.dataset.target;
                showPanel(target);
                history.replaceState(null, '', `#${target}`);
            }));
            const initial = location.hash.slice(1);
            showPanel([...panels].some(panel => panel.dataset.menuPanel.split(' ').includes(initial)) ? initial : 'ringkasan');
        });
    </script>
</body>
</html>










