<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>PPDB SDN Kedung Dalam 1</title>

    <style>
        :root {
            --navy: #103765;
            --blue: #1769c2;
            --blue-light: #eaf4ff;
            --text: #183657;
            --muted: #64748b;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background: #fff;
            color: var(--text);
            font-family: Arial, sans-serif;
            overflow-x: hidden;
        }

        /* NAVBAR */
        .main-navbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: var(--navy);
            padding: 13px 0;
            box-shadow: 0 4px 18px rgba(16, 55, 101, .12);
        }

        .navbar-logo {
            width: 48px;
            height: 48px;
            object-fit: contain;
        }

        .brand-name {
            color: white;
            font-size: 19px;
            font-weight: 800;
        }

        .brand-caption {
            color: #c9ddf5;
            font-size: 11px;
        }

        .nav-link-custom {
            color: #e8f2ff;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            padding: 10px 13px;
            transition: .2s;
        }

        .nav-link-custom:hover {
            color: #8dc5ff;
        }

        /* HERO */
        .hero {
            position: relative;
            overflow: hidden;
            background:
                radial-gradient(ellipse at 82% 42%, rgba(205, 231, 255, .62) 0%, rgba(205, 231, 255, 0) 58%),
                linear-gradient(115deg, #f4f9ff 0%, #edf6ff 32%, #e2f1ff 68%, #d6ebff 100%);
        }

        .hero::before {
            content: "";
            position: absolute;
            width: 360px;
            height: 360px;
            border-radius: 50%;
            background: rgba(255,255,255,.35);
            top: -180px;
            left: -100px;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            padding-top: 75px;
            padding-bottom: 75px;
        }

        .hero-label {
            display: inline-block;
            background: #d8eaff;
            color: #14569c;
            border-radius: 30px;
            padding: 9px 17px;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .hero-title {
            color: #103765;
            font-size: clamp(38px, 5vw, 65px);
            font-weight: 800;
            line-height: 1.08;
            letter-spacing: -1.5px;
        }

        .hero-title span {
            color: #1674d1;
        }

        .hero-description {
            color: #58708c;
            font-size: 17px;
            line-height: 1.7;
            max-width: 500px;
            margin-top: 20px;
        }

        .hero-button {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: linear-gradient(135deg, #1976d2, #103765);
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 12px;
            padding: 15px 25px;
            font-weight: 700;
            transition: .25s;
            box-shadow: 0 7px 18px rgba(23, 105, 194, .2);
        }

        .hero-button:hover {
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 22px rgba(23, 105, 194, .28);
        }

        .hero-button:disabled {
            background: #8797aa;
            cursor: not-allowed;
            transform: none;
        }

        /* ILUSTRASI KARAKTER */
        .hero-illustration {
            width: 100%;
            max-width: 570px;
            height: auto;
            margin: auto;
            display: block;
            object-fit: contain;

            filter: drop-shadow(0 15px 15px rgba(30, 80, 130, .12));
        }

        /* SECTION */
        .section-label {
            color: #1976d2;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1.5px;
        }

        .section-title {
            color: var(--navy);
            font-size: 32px;
            font-weight: 800;
        }

        .section-description {
            color: var(--muted);
        }

        /* INFO CARDS */
        .info-card {
            height: 100%;
            padding: 25px;
            border: 1px solid #e2edfa;
            border-radius: 17px;
            background: white;
            box-shadow: 0 5px 18px rgba(30, 80, 130, .06);
            transition: .25s;
        }

        .info-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 25px rgba(30, 80, 130, .12);
        }

        .info-icon {
            width: 58px;
            height: 58px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 16px;
            background: #e6f2ff;
            color: #1769c2;
            font-size: 27px;
            font-weight: 800;
        }

        .info-card h5 {
            color: var(--navy);
            font-weight: 800;
        }

        .info-card p {
            color: var(--muted);
            line-height: 1.6;
            font-size: 14px;
        }

        /* SCHOOL PROFILE */
        .school-section {
            background: #f2f7fd;
        }

        .school-panel {
            background: white;
            border: 1px solid #e2edfa;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(30, 80, 130, .05);
            height: 100%;
        }

        .school-heading {
            color: var(--navy);
            font-weight: 800;
        }

        .school-description {
            color: var(--muted);
            line-height: 1.7;
            font-size: 14px;
        }

        .school-photo-placeholder {
            overflow: hidden;
            width: 100%;
            height: 220px;
            border-radius: 16px;
            background: linear-gradient(135deg, #d7eaff, #f2f8ff);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: #1769c2;
            padding: 20px;
            flex-shrink: 0;
        }

        .school-photo-placeholder span {
            font-size: 48px;
            margin-bottom: 8px;
        }

        .contact-item {
            display: flex;
            gap: 13px;
            padding: 13px 0;
            border-bottom: 1px solid #edf2f8;
        }

        .contact-item:last-child {
            border-bottom: none;
        }

        .contact-icon {
            color: #1769c2;
            font-size: 20px;
            flex-shrink: 0;
        }

        .contact-title {
            font-size: 12px;
            color: #8795a7;
            margin-bottom: 4px;
        }

        .contact-value {
            color: var(--text);
            font-size: 13px;
            font-weight: 600;
            line-height: 1.5;
            overflow-wrap: anywhere;
        }

        .accreditation {
            text-align: center;
            background: #edf5ff;
            border-radius: 16px;
            padding: 30px 15px;
            width: 100%;
        }

        .accreditation-letter {
            color: #1769c2;
            font-size: 65px;
            font-weight: 800;
            line-height: 1.1;
            margin: 10px 0;
        }

        /* FOOTER */
        .main-footer {
            background: #103765;
            color: white;
            padding: 25px 0;
        }

        .footer-caption {
            color: #c6d9ef;
            font-size: 12px;
        }

        .admin-link {
            color: #d7e9ff;
            font-size: 12px;
            text-decoration: none;
            transition: .2s;
        }

        .admin-link:hover {
            color: white;
            text-decoration: underline;
        }

        /* RESPONSIVE */
        @media (max-width: 991px) {
            .hero-content {
                padding-top: 55px;
                padding-bottom: 45px;
            }

            .hero-illustration {
                max-width: 440px;
                margin-top: 30px;
            }

            .navbar-menu {
                justify-content: center;
                margin-top: 15px;
            }
        }

        @media (max-width: 576px) {
            .brand-name {
                font-size: 15px;
            }

            .navbar-logo {
                width: 40px;
                height: 40px;
            }

            .nav-link-custom {
                font-size: 12px;
                padding: 8px;
            }

            .hero-content {
                padding-top: 45px;
            }

            .hero-title {
                font-size: 39px;
            }

            .hero-description {
                font-size: 15px;
            }

            .section-title {
                font-size: 26px;
            }

            .school-panel {
                padding: 20px;
            }

            .school-photo-placeholder {
            overflow: hidden;
                height: 200px;
            }

            .footer-content {
                text-align: center;
                gap: 15px;
                justify-content: center !important;
            }
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="main-navbar">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-between">

                <a href="/" class="d-flex align-items-center text-decoration-none">
                    <img src="{{ asset('images/logo-sekolah.png') }}"
                         alt="Logo Sekolah"
                         class="navbar-logo me-2">

                    <div>
                        <div class="brand-name">SDN Kedung Dalam 1</div>
                        <div class="brand-caption">Cerdas · Berkarakter · Berprestasi</div>
                    </div>
                </a>

                <div class="d-flex align-items-center flex-wrap navbar-menu">
                    <a href="/" class="nav-link-custom">Beranda</a>
                    <a href="#informasi" class="nav-link-custom">Informasi</a>
                    <a href="#profil" class="nav-link-custom">Profil Sekolah</a>
                    <a href="#kontak" class="nav-link-custom">Kontak</a>
                </div>

            </div>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero">
        <div class="container">
            <div class="row align-items-center hero-content">

                <div class="col-lg-6">

                    <div class="hero-label">
                        ✦ PENERIMAAN PESERTA DIDIK BARU
                    </div>

                    <h1 class="hero-title">
                        Selamat Datang di
                        <span>PPDB Online</span>
                    </h1>

                    <div class="mt-3">
                        <span class="badge rounded-pill px-3 py-2"
                              style="background:#d8eaff;color:#14569c;">
                            Tahun Pelajaran 2027/2028
                        </span>
                    </div>

                    <p class="hero-description">
                        Selamat datang di website PPDB SDN Kedung Dalam 1.
                        Dapatkan informasi pendaftaran dan lakukan proses
                        pendaftaran secara online dengan mudah.
                    </p>

                    @if ($pendaftaranDitutup)
                        <button type="button"
                                class="hero-button"
                                disabled>
                            @if ($belumDibuka)
                                Pendaftaran Belum Dibuka
                            @elseif ($sudahDitutup)
                                Pendaftaran Ditutup
                            @else
                                Kuota Pendaftaran Penuh
                            @endif
                        </button>
                    @else
                        <a href="/akses-ppdb" class="hero-button">
                            Mulai Pendaftaran <span>→</span>
                        </a>
                    @endif

                </div>

                <!-- ILUSTRASI KARAKTER ANAK SD -->
                <div class="col-lg-6">
                    <img
                        src="{{ asset('images/karakter-siswa-transparan.png') }}"
                        alt="Ilustrasi anak laki-laki dan perempuan SD berseragam merah putih"
                        class="hero-illustration"
                    >
                </div>

            </div>
        </div>
    </section>

    <!-- INFORMASI PPDB -->
    <section class="py-5" id="informasi">
        <div class="container">

            <div class="text-center mb-5">
                <p class="section-label mb-2">INFORMASI PENDAFTARAN</p>
                <h2 class="section-title">Informasi PPDB</h2>
                <p class="section-description">
                    Beberapa informasi penting sebelum melakukan pendaftaran.
                </p>
            </div>

            <div class="row g-4">

                <!-- JADWAL -->
                <div class="col-md-4">
                    <div class="info-card">
                        <div class="d-flex gap-3">
                            <div class="info-icon">▦</div>

                            <div>
                                <h5 class="mb-2">Jadwal Pendaftaran</h5>

                                <p>
                                    Informasi jadwal pelaksanaan PPDB
                                    SDN Kedung Dalam 1.
                                </p>

                                <div class="small mb-2">
                                    <strong>Tanggal Buka:</strong><br>

                                    @if ($pengaturan->tanggal_buka)
                                        {{ $pengaturan->tanggal_buka->translatedFormat('d F Y, H:i') }} WIB
                                    @else
                                        Belum ditentukan
                                    @endif
                                </div>

                                <div class="small">
                                    <strong>Tanggal Tutup:</strong><br>

                                    @if ($pengaturan->tanggal_tutup)
                                        {{ $pengaturan->tanggal_tutup->translatedFormat('d F Y, H:i') }} WIB
                                    @else
                                        Belum ditentukan
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PERSYARATAN -->
                <div class="col-md-4">
                    <div class="info-card">
                        <div class="d-flex gap-3">
                            <div class="info-icon">☷</div>

                            <div>
                                <h5 class="mb-2">Persyaratan</h5>

                                <p class="mb-0">
                                    Persiapkan dokumen dan persyaratan
                                    yang diperlukan untuk mengikuti
                                    proses PPDB.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ALUR -->
                <div class="col-md-4">
                    <div class="info-card">
                        <div class="d-flex gap-3">
                            <div class="info-icon">⌘</div>

                            <div>
                                <h5 class="mb-2">Alur Pendaftaran</h5>

                                <p class="mb-0">
                                    Ikuti tahapan pendaftaran mulai
                                    dari registrasi akun hingga
                                    proses pendaftaran selesai.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- PROFIL SEKOLAH -->
    <section class="school-section py-5" id="profil">
        <div class="container">

            <div class="text-center mb-5">
                <p class="section-label mb-2">TENTANG SEKOLAH</p>
                <h2 class="section-title">Profil Sekolah</h2>
                <p class="section-description">
                    Mengenal lebih dekat SDN Kedung Dalam 1.
                </p>
            </div>

            <div class="row g-4 align-items-stretch">

                <!-- DESKRIPSI SEKOLAH -->
                <div class="col-lg-4">
                    <div class="school-panel">

                        <div class="school-photo-placeholder p-0">
                            <img src="{{ asset('images/foto-profil-sekolah.jpeg') }}"
                                 alt="Gedung dan papan nama SDN Kedung Dalam 1"
                                 class="w-100 h-100"
                                 style="object-fit: cover;">
                        </div>

                        <h4 class="school-heading mt-4">SDN Kedung Dalam 1</h4>
                        <p class="school-description mb-0">
                            Sekolah Dasar Negeri yang mendukung perkembangan peserta didik melalui lingkungan belajar yang nyaman dan positif.
                        </p>

                    </div>
                </div>

                <!-- INFORMASI SEKOLAH -->
                <div class="col-lg-5" id="kontak">
                    <div class="school-panel">

                        <h5 class="school-heading mb-3">
                            Informasi Sekolah
                        </h5>

                        <div class="contact-item">
                            <div class="contact-icon">⌖</div>

                            <div>
                                <div class="contact-title">Alamat Sekolah</div>

                                <div class="contact-value">
                                    JL. KH. Musa Kp. Margasari Desa Kedung Dalam
                                    RT.07 RW.02, Kec. Mauk - Kab. Tangerang -
                                    Banten 15530
                                </div>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">✉</div>

                            <div>
                                <div class="contact-title">Email Sekolah</div>

                                <div class="contact-value">
                                    sdnkedungdalamsatu@gmail.com
                                </div>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">◷</div>

                            <div>
                                <div class="contact-title">
                                    Jam Kegiatan Sekolah
                                </div>

                                <div class="contact-value">
                                    07.00 - 12.00 WIB
                                </div>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">◷</div>

                            <div>
                                <div class="contact-title">
                                    Jam Operasional
                                </div>

                                <div class="contact-value">
                                    07.00 - 15.00 WIB
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- AKREDITASI -->
                <div class="col-lg-3">
                    <div class="school-panel d-flex align-items-center">

                        <div class="accreditation">
                            <div class="contact-title">
                                AKREDITASI SEKOLAH
                            </div>

                            <div class="accreditation-letter">
                                B
                            </div>

                            <div class="fw-bold" style="color:#1769c2;">
                                Terakreditasi
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="main-footer">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center flex-wrap footer-content">

                <div class="d-flex align-items-center gap-2">
                    <img src="{{ asset('images/logo-sekolah.png') }}"
                         alt="Logo Sekolah"
                         style="width:42px;height:42px;object-fit:contain;">

                    <div>
                        <div class="fw-bold">SDN Kedung Dalam 1</div>

                        <div class="footer-caption">
                            © 2026 SDN Kedung Dalam 1 · Website PPDB
                        </div>
                    </div>
                </div>

                <a href="/admin/login" class="admin-link">
                    ♙ Login Admin
                </a>

            </div>
        </div>
    </footer>

</body>
</html>