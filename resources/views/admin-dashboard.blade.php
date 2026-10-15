<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Dashboard Admin - PPDB SDN Kedung Dalam 1</title>

<style>
    .admin-header {
        margin-bottom: 35px;
    }

    .admin-title {
        font-size: 32px;
        letter-spacing: -0.5px;
    }

    .admin-subtitle {
        font-size: 15px;
    }

.admin-navbar-logo {
    width: 45px;
    height: 45px;
    object-fit: contain;
}

/* Layout Admin */
.admin-layout {
    display: flex;
    min-height: calc(100vh - 58px);
}

.admin-sidebar {
    width: 240px;
    background: #ffffff;
    border-right: 1px solid #e9ecef;
    padding: 30px 15px;
    flex-shrink: 0;
}

.admin-sidebar-title {
    font-size: 11px;
    font-weight: 700;
    color: #9a9a9a;
    letter-spacing: 1px;
    padding: 0 15px;
    margin-bottom: 14px;
}

.admin-sidebar-link {
    display: block;
    padding: 12px 15px;
    margin-bottom: 6px;
    border-radius: 8px;
    color: #495057;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.2s ease;
}

.admin-sidebar-link:hover {
    background: #fff0f0;
    color: #dc3545;
}

.admin-sidebar-link.active {
    background: #dc3545;
    color: #ffffff;
}

.admin-main {
    flex: 1;
    padding: 40px;
}

/* Pengaturan Kuota PPDB */
.admin-card {
    background: #ffffff;
    border: 1px solid #eeeeee;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
}

.admin-card h3 {
    font-size: 20px;
    font-weight: 700;
    color: #172033;
    margin-bottom: 10px;
}

.admin-card p {
    color: #6c757d;
    font-size: 14px;
}

.admin-card label {
    display: block;
    font-size: 14px;
    font-weight: 600;
}

.admin-card button {
    background: #dc3545;
    color: #ffffff;
    border: none;
    border-radius: 6px;
    padding: 10px 18px;
    cursor: pointer;
}

.admin-card button:hover {
    background: #bb2d3b;
}

/* Statistik Dashboard */
.stat-card {
    border: 1px solid #eeeeee !important;
    border-radius: 12px !important;
    background: #ffffff;
    transition: all 0.2s ease;
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06) !important;
}

.stat-label {
    font-size: 13px;
    color: #777777;
    margin-bottom: 8px;
}

.stat-number {
    font-size: 28px;
    color: #172033;
}

.stat-card:nth-child(4) {
    border-top: 3px solid #198754 !important;
}

.stat-card:nth-child(5) {
    border-top: 3px solid #dc3545 !important;
}

@media (max-width: 768px) {
    .admin-layout {
        display: block;
    }

    .admin-sidebar {
        width: 100%;
        border-right: none;
        border-bottom: 1px solid #eeeeee;
    }

    .admin-main {
        padding: 25px 15px;
    }
}

</style>

</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar bg-danger">
        <div class="container">
            <a href="/" class="navbar-brand text-white fw-bold d-flex align-items-center">
    <img
        src="{{ asset('images/logo-sekolah.png') }}"
        alt="Logo SDN Kedung Dalam 1"
        class="admin-navbar-logo me-2"
    >

    <span>SDN Kedung Dalam 1</span>
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
<div class="admin-layout">

    <!-- Sidebar -->
    <aside class="admin-sidebar">

        <div class="admin-sidebar-title">
            MENU UTAMA
        </div>

        <a href="/admin/dashboard" class="admin-sidebar-link active">
            Dashboard
        </a>

        <a href="/admin/pendaftar" class="admin-sidebar-link">
            Data Pendaftar
        </a>

        <a href="/admin/berkas" class="admin-sidebar-link">
            Verifikasi Berkas
        </a>

        <a href="/admin/pendaftar" class="admin-sidebar-link">
            Status Pendaftaran
        </a>

        <a href="/admin/pengumuman" class="admin-sidebar-link">
            Pengumuman
        </a>

    </aside>

    <!-- Area Utama -->
    <main class="admin-main">

    <div class="admin-header">
        <h1 class="fw-bold admin-title mb-2">
            Dashboard Admin
        </h1>

        <p class="text-secondary admin-subtitle mb-0">
            Selamat datang, Admin. Kelola data pendaftaran PPDB di sini.
        </p>
    </div>

       <!-- Ringkasan -->
<div class="row g-3 mb-5">

    <!-- Total Pendaftar -->
    <div class="col">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body p-3">

                <p class="stat-label">
                    Total Pendaftar
                </p>

                <h2 class="fw-bold stat-number mb-0">
                    {{ $totalPendaftar }}
                </h2>

            </div>
        </div>
    </div>


    <!-- Menunggu Verifikasi -->
    <div class="col">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body p-3">

                <p class="stat-label">
                    Menunggu Verifikasi
                </p>

                <h2 class="fw-bold stat-number mb-0">
                    {{ $menungguVerifikasi }}
                </h2>

            </div>
        </div>
    </div>


    <!-- Terverifikasi -->
    <div class="col">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body p-3">

                <p class="stat-label">
                    Terverifikasi
                </p>

                <h2 class="fw-bold stat-number mb-0">
                    {{ $terverifikasi }}
                </h2>

            </div>
        </div>
    </div>


    <!-- Lulus -->
    <div class="col">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body p-3">

                <p class="stat-label">
                    Lulus
                </p>

                <h2 class="fw-bold stat-number mb-0">
                    {{ $lulus }}
                </h2>

            </div>
        </div>
    </div>


    <!-- Ditolak -->
    <div class="col">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body p-3">

                <p class="stat-label">
                    Ditolak
                </p>

                <h2 class="fw-bold stat-number mb-0">
                    {{ $ditolak }}
                </h2>

            </div>
        </div>
    </div>

</div>


{{-- Pengaturan Kuota PPDB --}}
<div class="admin-card" style="margin-top: 24px; padding: 24px;">
    <h3>Pengaturan Kuota PPDB</h3>

    <p>
        Atur jumlah maksimal peserta yang dapat mendaftar.
    </p>

    @if (session('success'))
        <p style="color: green;">
            {{ session('success') }}
        </p>
    @endif

    @if ($errors->any())
        <p style="color: red;">
            {{ $errors->first('kuota') }}
        </p>
    @endif

    <form action="{{ url('/admin/pengaturan-kuota') }}" method="POST">
        @csrf

        <label for="kuota">Kuota Maksimal Pendaftar</label>

        <input
            type="number"
            id="kuota"
            name="kuota"
            min="1"
            value="{{ old('kuota', $kuota) }}"
            required
            style="display: block; width: 100%; max-width: 300px; padding: 10px; margin: 10px 0 16px;"
        >

        <p>
            Total pendaftar: <strong>{{ $totalPendaftar }}</strong>
        </p>

        <p>
            Sisa kuota: <strong>{{ $sisaKuota }}</strong>
        </p>
        <button type="submit">
            Simpan Kuota
        </button>
    </form>
</div>
    

</main>

</div>

</body>
</html>