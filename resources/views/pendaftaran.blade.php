<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Formulir Pendaftaran - PPDB SDN Kedung Dalem 1</title>
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar bg-danger">
        <div class="container">
            <a href="/dashboard" class="navbar-brand text-white fw-bold">
                SDN Kedung Dalem 1
            </a>

            <a href="/dashboard" class="btn btn-light">
                Kembali
            </a>
        </div>
    </nav>


    <!-- Isi Formulir -->
    <div class="container py-5">

        <div class="row justify-content-center">
            <div class="col-lg-8">

                <!-- Judul -->
                <div class="text-center mb-4">
                    <p class="text-danger fw-semibold mb-2">
                        PPDB SDN KEDUNG DALEM 1
                    </p>

                    <h1 class="fw-bold">
                        Formulir Pendaftaran
                    </h1>

                    <p class="text-secondary">
                        Silakan lengkapi data calon siswa dan orang tua/wali.
                    </p>
                </div>


                <form method="POST" action="/pendaftaran">

                    @csrf

                    <!-- Data Calon Siswa -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-4">

        <h4 class="fw-bold mb-4">
            Data Calon Siswa
        </h4>

        <!-- Nama -->
        <div class="mb-3">
            <label class="form-label fw-semibold">
                Nama Lengkap
            </label>

            <input
                type="text"
                name="nama_lengkap"
                class="form-control"
                placeholder="Masukkan nama lengkap"
                required
            >
        </div>


        <!-- NIK & NISN -->
        <div class="row">

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">
                    NIK
                </label>

                <input
                    type="text"
                    name="nik"
                    class="form-control"
                    placeholder="Masukkan NIK"
                    required
                >
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">
                    NISN
                </label>

                <input
                    type="text"
                    name="nisn"
                    class="form-control"
                    placeholder="Masukkan NISN (jika sudah memiliki)"
                >

                <small class="text-secondary">
                    Kosongkan jika belum memiliki NISN.
                </small>
            </div>

        </div>


        <!-- Jenis Kelamin & Agama -->
        <div class="row">

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">
                    Jenis Kelamin
                </label>

                <select
                    name="jenis_kelamin"
                    class="form-select"
                    required
                >
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">
                    Agama
                </label>

                <select
                    name="agama"
                    class="form-select"
                    required
                >
                    <option value="">-- Pilih Agama --</option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Konghucu">Konghucu</option>
                </select>
            </div>

        </div>


        <!-- Tempat & Tanggal Lahir -->
        <div class="row">

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">
                    Tempat Lahir
                </label>

                <input
                    type="text"
                    name="tempat_lahir"
                    class="form-control"
                    placeholder="Masukkan tempat lahir"
                    required
                >
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">
                    Tanggal Lahir
                </label>

                <input
                    type="date"
                    name="tanggal_lahir"
                    class="form-control"
                    required
                >
            </div>

        </div>


        <!-- Anak ke & Jumlah Saudara -->
        <div class="row">

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">
                    Anak ke-
                </label>

                <input
                    type="number"
                    name="anak_ke"
                    class="form-control"
                    placeholder="Contoh: 2"
                    min="1"
                >

                <small class="text-secondary">
                    Opsional.
                </small>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">
                    Jumlah Saudara Kandung
                </label>

                <input
                    type="number"
                    name="jumlah_saudara"
                    class="form-control"
                    placeholder="Contoh: 2"
                    min="0"
                >

                <small class="text-secondary">
                    Opsional.
                </small>
            </div>

        </div>


        <!-- Alamat Tempat Tinggal -->
<div class="mb-4">

    <h5 class="fw-bold mb-3">
        Alamat Tempat Tinggal
    </h5>

    <!-- Alamat Lengkap -->
    <div class="mb-3">
        <label class="form-label fw-semibold">
            Alamat Lengkap
        </label>

        <textarea
            name="alamat"
            class="form-control"
            rows="3"
            placeholder="Masukkan alamat lengkap"
            required
        ></textarea>
    </div>

    <!-- RT & RW -->
    <div class="row">

        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">
                RT
            </label>

            <input
                type="text"
                name="rt"
                class="form-control"
                placeholder="Contoh: 001"
                required
            >
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">
                RW
            </label>

            <input
                type="text"
                name="rw"
                class="form-control"
                placeholder="Contoh: 002"
                required
            >
        </div>

    </div>

    <!-- Desa & Kecamatan -->
    <div class="row">

        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">
                Desa/Kelurahan
            </label>

            <input
                type="text"
                name="desa"
                class="form-control"
                placeholder="Masukkan desa/kelurahan"
                required
            >
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">
                Kecamatan
            </label>

            <input
                type="text"
                name="kecamatan"
                class="form-control"
                placeholder="Masukkan kecamatan"
                required
            >
        </div>

    </div>

    <!-- Kabupaten & Provinsi -->
    <div class="row">

        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">
                Kabupaten/Kota
            </label>

            <input
                type="text"
                name="kabupaten"
                class="form-control"
                placeholder="Masukkan kabupaten/kota"
                required
            >
        </div>

        <div class="col-md-6 mb-0">
            <label class="form-label fw-semibold">
                Provinsi
            </label>

            <input
                type="text"
                name="provinsi"
                class="form-control"
                placeholder="Masukkan provinsi"
                required
            >
        </div>

    </div>

</div>

        <!-- Asal Sekolah -->
        <div class="mb-0">
            <label class="form-label fw-semibold">
                Asal TK/RA/PAUD
            </label>

            <input
                type="text"
                name="asal_sekolah"
                class="form-control"
                placeholder="Masukkan asal sekolah"
                required
            >
        </div>

    </div>
</div>


                  <!-- Data Orang Tua -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-4">

        <h4 class="fw-bold mb-4">
            Data Orang Tua/Wali
        </h4>

        <!-- Data Ayah -->
        <h5 class="fw-bold mb-3">
            Data Ayah
        </h5>

        <div class="mb-3">
            <label class="form-label fw-semibold">
                Nama Ayah
            </label>

            <input
                type="text"
                name="nama_ayah"
                class="form-control"
                placeholder="Masukkan nama ayah"
                required
            >
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">
                NIK Ayah
            </label>

            <input
                type="text"
                name="nik_ayah"
                class="form-control"
                placeholder="Masukkan NIK ayah"
                required
            >
        </div>

        <div class="row">

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">
                    Pendidikan Terakhir
                </label>

                <select
                    name="pendidikan_ayah"
                    class="form-select"
                    required
                >
                    <option value="">-- Pilih Pendidikan --</option>
                    <option value="Tidak Sekolah">Tidak Sekolah</option>
                    <option value="SD/Sederajat">SD/Sederajat</option>
                    <option value="SMP/Sederajat">SMP/Sederajat</option>
                    <option value="SMA/Sederajat">SMA/Sederajat</option>
                    <option value="Diploma">Diploma</option>
                    <option value="S1">S1</option>
                    <option value="S2">S2</option>
                    <option value="S3">S3</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">
                    Pekerjaan
                </label>

                <input
                    type="text"
                    name="pekerjaan_ayah"
                    class="form-control"
                    placeholder="Masukkan pekerjaan ayah"
                    required
                >
            </div>

        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">
                Penghasilan per Bulan
            </label>

            <input
                type="text"
                name="penghasilan_ayah"
                class="form-control"
                placeholder="Contoh: Rp2.000.000"
                required
            >
        </div>


        <hr class="my-4">


        <!-- Data Ibu -->
        <h5 class="fw-bold mb-3">
            Data Ibu
        </h5>

        <div class="mb-3">
            <label class="form-label fw-semibold">
                Nama Ibu
            </label>

            <input
                type="text"
                name="nama_ibu"
                class="form-control"
                placeholder="Masukkan nama ibu"
                required
            >
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">
                NIK Ibu
            </label>

            <input
                type="text"
                name="nik_ibu"
                class="form-control"
                placeholder="Masukkan NIK ibu"
                required
            >
        </div>

        <div class="row">

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">
                    Pendidikan Terakhir
                </label>

                <select
                    name="pendidikan_ibu"
                    class="form-select"
                    required
                >
                    <option value="">-- Pilih Pendidikan --</option>
                    <option value="Tidak Sekolah">Tidak Sekolah</option>
                    <option value="SD/Sederajat">SD/Sederajat</option>
                    <option value="SMP/Sederajat">SMP/Sederajat</option>
                    <option value="SMA/Sederajat">SMA/Sederajat</option>
                    <option value="Diploma">Diploma</option>
                    <option value="S1">S1</option>
                    <option value="S2">S2</option>
                    <option value="S3">S3</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">
                    Pekerjaan
                </label>

                <input
                    type="text"
                    name="pekerjaan_ibu"
                    class="form-control"
                    placeholder="Masukkan pekerjaan ibu"
                    required
                >
            </div>

        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">
                Penghasilan per Bulan
            </label>

            <input
                type="text"
                name="penghasilan_ibu"
                class="form-control"
                placeholder="Contoh: Rp2.000.000"
                required
            >
        </div>


        <hr class="my-4">


        <!-- Kontak -->
        <h5 class="fw-bold mb-3">
            Kontak Orang Tua/Wali
        </h5>

        <div class="mb-0">
            <label class="form-label fw-semibold">
                No. HP Orang Tua/Wali
            </label>

            <input
                type="text"
                name="no_hp"
                class="form-control"
                placeholder="Masukkan nomor HP yang aktif"
                required
            >
        </div>

    </div>
</div>


                    <!-- Tombol -->
                    <div class="d-flex justify-content-between align-items-center">

                        <a href="/dashboard" class="btn btn-outline-danger">
                            Kembali
                        </a>

                        <button type="submit" class="btn btn-danger px-4">
                            Simpan & Lanjutkan
                        </button>

                    </div>

                </form>

            </div>
        </div>

    </div>

</body>
</html>