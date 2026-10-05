<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>PPDB SDN Kedung Dalam 1</title>

    <style>
        body {
            background: #ffffff;
            color: #212529;
        }

        /* Navbar */
        .navbar {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .navbar-logo {
            width: 45px;
            height: 45px;
            object-fit: contain;
            background: #ffffff;
            border-radius: 50%;
            padding: 3px;
        }

        /* Hero */
        .hero {
            background: linear-gradient(
                135deg,
                #fff3f3 0%,
                #ffffff 70%
            );
            border-bottom: 1px solid #f1f1f1;
        }

        .hero-title {
            line-height: 1.1;
            font-size: 52px;
        }

        .hero-description {
            max-width: 700px;
            line-height: 1.7;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-content {
            max-width: 1000px;
            margin: 0 auto;
        }

        .hero-card {
            border: 1px solid #eeeeee;
            border-radius: 18px;
        }

        .hero-logo-box {
            background: #fff5f5;
            border-radius: 14px;
            padding: 20px;
        }

        .hero-logo {
            width: 135px;
            height: 135px;
            object-fit: contain;
        }

        .school-stat {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 12px;
        }

        /* Button */
        .btn-main {
            border-radius: 9px;
            font-weight: 600;
        }

        /* Informasi */
        .section-label {
            color: #dc3545;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .info-card {
            border: none;
            border-radius: 15px;
            transition: all 0.2s ease;
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08) !important;
        }

        .info-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff0f0;
            color: #dc3545;
            border-radius: 12px;
            font-size: 22px;
        }

        .info-card p {
            line-height: 1.6;
        }

        /* Sekolah */
        .school-info {
            background: #f8f9fa;
        }

        .school-box {
            background: #ffffff;
            border-radius: 15px;
            padding: 22px;
            height: 100%;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
        }

        .contact-item {
            border-bottom: 1px solid #eeeeee;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }

        .contact-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
            margin-bottom: 0;
        }

        .contact-title {
            font-size: 13px;
            color: #6c757d;
            margin-bottom: 4px;
        }

        /* Informasi sekolah - tambahan */
.school-detail-divider {
    border-top: 1px solid #eeeeee;
    margin-top: 22px;
    padding-top: 18px;
}

.school-hours {
    min-height: 170px;
}

.accreditation-box {
    border-top: 1px solid #eeeeee;
    margin-top: 24px;
    padding-top: 18px;
    text-align: center;
}

.accreditation-box .contact-title {
    margin-bottom: 5px;
}

.accreditation-value {
    font-size: 28px;
    font-weight: 700;
    color: #212529;
}

        /* Footer */
        footer {
            border-top: 1px solid #eeeeee;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 40px;
            }
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar bg-danger py-3">
        <div class="container">

            <a class="navbar-brand text-white fw-bold d-flex align-items-center" href="/">
                <img
                    src="{{ asset('images/logo-sekolah.png') }}"
                    alt="Logo SDN Kedung Dalam 1"
                    class="navbar-logo me-2"
                >

                <span>SDN Kedung Dalam 1</span>
            </a>

            <a href="/akses-ppdb" class="btn btn-light px-4 btn-main">
                Akses PPDB
            </a>

        </div>
    </nav>


   <!-- KIRI: FOKUS UTAMA PPDB -->
<div class="col-12 hero-content text-center">

    <p class="section-label mb-3">
        PENERIMAAN PESERTA DIDIK BARU
    </p>

    <h1 class="fw-bold hero-title mb-3">
        SDN Kedung Dalam 1
    </h1>

    <div class="d-inline-block bg-danger text-white px-3 py-2 rounded-pill mb-4 fw-semibold">
        Tahun Pelajaran 2027/2028
    </div>

    <p class="text-secondary fs-5 hero-description mb-4">
        Selamat datang di website PPDB SDN Kedung Dalam 1.
        Dapatkan informasi pendaftaran dan lakukan proses
        pendaftaran secara online dengan mudah.
    </p>

    <a href="/akses-ppdb"
       class="btn btn-danger px-4 py-3 btn-main">
        Mulai Pendaftaran
    </a>

</div>


                

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- Informasi PPDB -->
    <section class="py-5">

        <div class="container">

            <div class="text-center mb-5">

                <p class="section-label mb-1">
                    INFORMASI
                </p>

                <h2 class="fw-bold">
                    Informasi PPDB
                </h2>

                <p class="text-secondary mb-0">
                    Beberapa informasi yang perlu diketahui sebelum melakukan pendaftaran.
                </p>

            </div>


            <div class="row g-4">

                <!-- Jadwal -->
                <div class="col-md-4">

                    <div class="card info-card h-100 shadow-sm">

                        <div class="card-body p-4">

                            
                            <h5 class="fw-bold mb-2">
                                Jadwal Pendaftaran
                            </h5>

                            <p class="text-secondary mb-0">
                                Informasi mengenai jadwal dan waktu
                                pelaksanaan PPDB dapat dilihat sebelum
                                melakukan pendaftaran.
                            </p>

                        </div>

                    </div>

                </div>


                <!-- Persyaratan -->
                <div class="col-md-4">

                    <div class="card info-card h-100 shadow-sm">

                        <div class="card-body p-4">

                            

                            <h5 class="fw-bold mb-2">
                                Persyaratan
                            </h5>

                            <p class="text-secondary mb-0">
                                Persiapkan dokumen dan persyaratan yang
                                diperlukan untuk mengikuti proses PPDB.
                            </p>

                        </div>

                    </div>

                </div>


                <!-- Alur -->
                <div class="col-md-4">

                    <div class="card info-card h-100 shadow-sm">

                        <div class="card-body p-4">

                            

                            <h5 class="fw-bold mb-2">
                                Alur Pendaftaran
                            </h5>

                            <p class="text-secondary mb-0">
                                Ikuti tahapan pendaftaran mulai dari
                                registrasi akun hingga proses pendaftaran
                                selesai.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- Informasi Sekolah -->
    <div class="text-center mb-5">

    <p class="section-label mb-1">
        INFORMASI SEKOLAH
    </p>

    <h2 class="fw-bold">
        SDN Kedung Dalam 1
    </h2>

    <p class="text-secondary mt-3 mb-0 mx-auto" style="max-width: 700px;">
        Sekolah Dasar Negeri yang mendukung perkembangan peserta didik
        melalui lingkungan belajar yang nyaman dan positif.
    </p>

</div>


           <div class="row g-4 align-items-stretch">


<!-- Alamat -->
<div class="col-lg-5">

    <div class="school-box">

        <p class="section-label mb-2">
            ALAMAT SEKOLAH
        </p>

        <h5 class="fw-bold mb-3">
            Lokasi Sekolah
        </h5>

        <p class="text-secondary mb-0">
            JL. KH. Musa Kp. Margasari Desa Kedung Dalam
            RT.07 RW.02
            <br>
            Kec. Mauk - Kab. Tangerang - Banten 15530
        </p>

        <!-- Email Sekolah -->
<div class="school-detail-divider">

    <div class="contact-title">
        Email Sekolah
    </div>

    <p class="fw-semibold mb-0">
         sdnkedungdalamsatu@gmail.com
    </p>

</div>
    </div>

</div>


                <!-- Kontak & Jam -->
<div class="col-lg-7">

    <div class="school-box school-hours">

        <div class="row g-4">

            <!-- Jam Kegiatan -->
            <div class="col-md-6">

                <div class="contact-item">

                    <div class="contact-title">
                        Jam Kegiatan Sekolah
                    </div>

                    <h5 class="fw-bold mb-1">
                        07.00 - 12.00 WIB
                    </h5>

                    <small class="text-secondary">
                        Jam kegiatan belajar di sekolah.
                    </small>

                </div>

            </div>


            <!-- Jam Operasional -->
            <div class="col-md-6">

                <div class="contact-item">

                    <div class="contact-title">
                        Jam Operasional
                    </div>

                    <h5 class="fw-bold mb-1">
                        07.00 - 15.00 WIB
                    </h5>

                    <small class="text-secondary">
                        Menyesuaikan kebutuhan pelayanan sekolah.
                    </small>

                </div>

            </div>


            <!-- Akreditasi -->
            <div class="col-12">

                <div class="accreditation-box">

                    <div class="contact-title">
                        Akreditasi
                    </div>

                    <div class="accreditation-value">
                        B
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</div>

    </section>


    <!-- Footer -->
    <footer class="py-4">

        <div class="container text-center">

            <p class="mb-1 fw-semibold">
                SDN Kedung Dalam 1
            </p>

            <p class="mb-0 text-secondary small">
                © 2026 SDN Kedung Dalam 1 · Website PPDB
            </p>

        </div>

    </footer>

</body>
</html>