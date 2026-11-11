
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

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if ($pendaftaranDitutup && !$pendaftaran)
            <div class="alert alert-danger">
                <strong>Pendaftaran PPDB belum dapat dilakukan.</strong>
                <p class="mb-0 mt-1">
                    @if (isset($pengaturan) && $pengaturan->tanggal_buka && now()->lt($pengaturan->tanggal_buka))
                        Pendaftaran belum dibuka. Silakan kembali sesuai jadwal yang ditentukan.
                    @elseif (isset($pengaturan) && $pengaturan->tanggal_tutup && now()->gt($pengaturan->tanggal_tutup))
                        Pendaftaran telah melewati batas waktu.
                    @else
                        Kuota pendaftaran telah terpenuhi.
                    @endif
                </p>
            </div>
        @endif

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

                @if ($formulirTerkunci)
                    <div class="alert alert-warning">
                        <strong>Formulir pendaftaran telah dikunci.</strong>
                        <p class="mb-0 mt-1">
                            Data tidak dapat diubah karena pendaftaran sudah diverifikasi atau hasil seleksi telah ditetapkan.
                        </p>
                    </div>
                @endif

                @if (!$pendaftaranDitutup || $pendaftaran)

                    <form method="POST" action="/pendaftaran">
                        @csrf

                        <fieldset
                            {{ $formulirTerkunci ? 'disabled' : '' }}
                            class="border-0 p-0 m-0"
                        >

                            <!-- Data Calon Siswa -->
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-body p-4">

                                    <h4 class="fw-bold mb-4">
                                        Data Calon Siswa
                                    </h4>

                                    <!-- Nama -->
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">
                                            Nama Lengkap <span class="text-danger">*</span>
                                        </label>

                                        <input
                                            type="text"
                                            name="nama_lengkap"
                                            class="form-control"
                                            placeholder="Masukkan nama lengkap"
                                            value="{{ old('nama_lengkap', $pendaftaran->nama_lengkap ?? '') }}"
                                            required
                                        >

                                        <small class="text-muted">
                                            Gunakan huruf kapital untuk nama lengkap.
                                        </small>
                                    </div>

                                    <!-- NIK & NISN -->
                                    <div class="row">

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold">
                                                NIK <span class="text-danger">*</span>
                                            </label>

                                            <input
                                                type="text"
                                                name="nik"
                                                class="form-control"
                                                placeholder="Masukkan 16 digit NIK"
                                                maxlength="16"
                                                inputmode="numeric"
                                                pattern="[0-9]{16}"
                                                title="NIK harus terdiri dari tepat 16 digit angka."
                                                value="{{ old('nik', $pendaftaran->nik ?? '') }}"
                                                required
                                            >
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold">
                                                NISN <span class="text-danger">*</span>
                                            </label>

                                            <input
                                                type="text"
                                                name="nisn"
                                                class="form-control"
                                                placeholder="Masukkan 10 digit NISN"
                                                maxlength="10"
                                                inputmode="numeric"
                                                pattern="[0-9]{10}"
                                                title="NISN harus terdiri dari tepat 10 digit angka."
                                                value="{{ old('nisn', $pendaftaran->nisn ?? '') }}"
                                                required
                                            >
                                        </div>

                                    </div>

                                    <!-- Jenis Kelamin & Agama -->
                                    <div class="row">

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold">
                                                Jenis Kelamin <span class="text-danger">*</span>
                                            </label>

                                            <select name="jenis_kelamin" class="form-select" required>
                                                <option value="">-- Pilih Jenis Kelamin --</option>
                                                <option value="Laki-laki" @selected(old('jenis_kelamin', $pendaftaran->jenis_kelamin ?? '') == 'Laki-laki')>Laki-laki</option>
                                                <option value="Perempuan" @selected(old('jenis_kelamin', $pendaftaran->jenis_kelamin ?? '') == 'Perempuan')>Perempuan</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold">
                                                Agama <span class="text-danger">*</span>
                                            </label>

                                            <select name="agama" class="form-select" required>
                                                <option value="">-- Pilih Agama --</option>
                                                <option value="Islam" @selected(old('agama', $pendaftaran->agama ?? '') == 'Islam')>Islam</option>
                                                <option value="Kristen" @selected(old('agama', $pendaftaran->agama ?? '') == 'Kristen')>Kristen</option>
                                                <option value="Katolik" @selected(old('agama', $pendaftaran->agama ?? '') == 'Katolik')>Katolik</option>
                                                <option value="Hindu" @selected(old('agama', $pendaftaran->agama ?? '') == 'Hindu')>Hindu</option>
                                                <option value="Buddha" @selected(old('agama', $pendaftaran->agama ?? '') == 'Buddha')>Buddha</option>
                                                <option value="Konghucu" @selected(old('agama', $pendaftaran->agama ?? '') == 'Konghucu')>Konghucu</option>
                                            </select>
                                        </div>

                                    </div>

                                    <!-- Tempat & Tanggal Lahir -->
                                    <div class="row">

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold">
                                                Tempat Lahir <span class="text-danger">*</span>
                                            </label>

                                            <input
                                                type="text"
                                                name="tempat_lahir"
                                                class="form-control"
                                                placeholder="Masukkan tempat lahir"
                                                value="{{ old('tempat_lahir', $pendaftaran->tempat_lahir ?? '') }}"
                                                required
                                            >
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold">
                                                Tanggal Lahir <span class="text-danger">*</span>
                                            </label>

                                            <input
                                                type="date"
                                                name="tanggal_lahir"
                                                class="form-control"
                                                value="{{ old('tanggal_lahir', isset($pendaftaran) && $pendaftaran->tanggal_lahir ? \Carbon\Carbon::parse($pendaftaran->tanggal_lahir)->format('Y-m-d') : '') }}"
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
                                                value="{{ old('anak_ke', $pendaftaran->anak_ke ?? '') }}"
                                            >

                                            <small class="text-secondary">Opsional.</small>
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
                                                value="{{ old('jumlah_saudara', $pendaftaran->jumlah_saudara ?? '') }}"
                                            >

                                            <small class="text-secondary">Opsional.</small>
                                        </div>

                                    </div>

                                    <!-- Alamat Tempat Tinggal -->
                                    <div class="mb-4">

                                        <h5 class="fw-bold mb-3">
                                            Alamat Tempat Tinggal
                                        </h5>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">
                                                Alamat Lengkap <span class="text-danger">*</span>
                                            </label>

                                            <textarea
                                                name="alamat"
                                                class="form-control"
                                                rows="3"
                                                placeholder="Masukkan alamat lengkap"
                                                required
                                            >{{ old('alamat', $pendaftaran->alamat ?? '') }}</textarea>
                                        </div>

                                        <!-- RT & RW -->
                                        <div class="row">

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-semibold">
                                                    RT <span class="text-danger">*</span>
                                                </label>

                                                <input
                                                    type="text"
                                                    name="rt"
                                                    class="form-control"
                                                    placeholder="Contoh: 001"
                                                    value="{{ old('rt', $pendaftaran->rt ?? '') }}"
                                                    required
                                                >
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-semibold">
                                                    RW <span class="text-danger">*</span>
                                                </label>

                                                <input
                                                    type="text"
                                                    name="rw"
                                                    class="form-control"
                                                    placeholder="Contoh: 002"
                                                    value="{{ old('rw', $pendaftaran->rw ?? '') }}"
                                                    required
                                                >
                                            </div>

                                        </div>

                                        <!-- Desa & Kecamatan -->
                                        <div class="row">

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-semibold">
                                                    Desa/Kelurahan <span class="text-danger">*</span>
                                                </label>

                                                <input
                                                    type="text"
                                                    name="desa"
                                                    class="form-control"
                                                    placeholder="Masukkan desa/kelurahan"
                                                    value="{{ old('desa', $pendaftaran->desa ?? '') }}"
                                                    required
                                                >
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-semibold">
                                                    Kecamatan <span class="text-danger">*</span>
                                                </label>

                                                <input
                                                    type="text"
                                                    name="kecamatan"
                                                    class="form-control"
                                                    placeholder="Masukkan kecamatan"
                                                    value="{{ old('kecamatan', $pendaftaran->kecamatan ?? '') }}"
                                                    required
                                                >
                                            </div>

                                        </div>

                                        <!-- Kabupaten & Provinsi -->
                                        <div class="row">

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-semibold">
                                                    Kabupaten/Kota <span class="text-danger">*</span>
                                                </label>

                                                <input
                                                    type="text"
                                                    name="kabupaten"
                                                    class="form-control"
                                                    placeholder="Masukkan kabupaten/kota"
                                                    value="{{ old('kabupaten', $pendaftaran->kabupaten ?? '') }}"
                                                    required
                                                >
                                            </div>

                                            <div class="col-md-6 mb-0">
                                                <label class="form-label fw-semibold">
                                                    Provinsi <span class="text-danger">*</span>
                                                </label>

                                                <input
                                                    type="text"
                                                    name="provinsi"
                                                    class="form-control"
                                                    placeholder="Masukkan provinsi"
                                                    value="{{ old('provinsi', $pendaftaran->provinsi ?? '') }}"
                                                    required
                                                >
                                            </div>

                                        </div>

                                    </div>

                                    <!-- Asal Sekolah -->
                                    <div class="mb-0">
                                        <label class="form-label fw-semibold">
                                            Asal TK/RA/PAUD <span class="text-danger">*</span>
                                        </label>

                                        <input
                                            type="text"
                                            name="asal_sekolah"
                                            class="form-control"
                                            placeholder="Masukkan asal sekolah"
                                            value="{{ old('asal_sekolah', $pendaftaran->asal_sekolah ?? '') }}"
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
                                    <h5 class="fw-bold mb-3">Data Ayah</h5>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">
                                            Nama Ayah <span class="text-danger">*</span>
                                        </label>

                                        <input
                                            type="text"
                                            name="nama_ayah"
                                            class="form-control"
                                            placeholder="Masukkan nama ayah"
                                            value="{{ old('nama_ayah', $pendaftaran->nama_ayah ?? '') }}"
                                            required
                                        >
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">
                                            NIK Ayah <span class="text-danger">*</span>
                                        </label>

                                        <input
                                            type="text"
                                            name="nik_ayah"
                                            class="form-control"
                                            placeholder="Masukkan NIK ayah"
                                            value="{{ old('nik_ayah', $pendaftaran->nik_ayah ?? '') }}"
                                            required
                                        >
                                    </div>

                                    <div class="row">

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold">
                                                Pendidikan Terakhir <span class="text-danger">*</span>
                                            </label>

                                            <select name="pendidikan_ayah" class="form-select" required>
                                                <option value="">-- Pilih Pendidikan --</option>
                                                <option value="Tidak Sekolah" @selected(old('pendidikan_ayah', $pendaftaran->pendidikan_ayah ?? '') == 'Tidak Sekolah')>Tidak Sekolah</option>
                                                <option value="SD/Sederajat" @selected(old('pendidikan_ayah', $pendaftaran->pendidikan_ayah ?? '') == 'SD/Sederajat')>SD/Sederajat</option>
                                                <option value="SMP/Sederajat" @selected(old('pendidikan_ayah', $pendaftaran->pendidikan_ayah ?? '') == 'SMP/Sederajat')>SMP/Sederajat</option>
                                                <option value="SMA/Sederajat" @selected(old('pendidikan_ayah', $pendaftaran->pendidikan_ayah ?? '') == 'SMA/Sederajat')>SMA/Sederajat</option>
                                                <option value="Diploma" @selected(old('pendidikan_ayah', $pendaftaran->pendidikan_ayah ?? '') == 'Diploma')>Diploma</option>
                                                <option value="S1" @selected(old('pendidikan_ayah', $pendaftaran->pendidikan_ayah ?? '') == 'S1')>S1</option>
                                                <option value="S2" @selected(old('pendidikan_ayah', $pendaftaran->pendidikan_ayah ?? '') == 'S2')>S2</option>
                                                <option value="S3" @selected(old('pendidikan_ayah', $pendaftaran->pendidikan_ayah ?? '') == 'S3')>S3</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold">
                                                Pekerjaan <span class="text-danger">*</span>
                                            </label>

                                            <select name="pekerjaan_ayah" class="form-select" required>
                                                <option value="">-- Pilih Pekerjaan --</option>
                                                <option value="PNS" @selected(old('pekerjaan_ayah', $pendaftaran->pekerjaan_ayah ?? '') == 'PNS')>PNS</option>
                                                <option value="TNI/Polri" @selected(old('pekerjaan_ayah', $pendaftaran->pekerjaan_ayah ?? '') == 'TNI/Polri')>TNI/Polri</option>
                                                <option value="Guru" @selected(old('pekerjaan_ayah', $pendaftaran->pekerjaan_ayah ?? '') == 'Guru')>Guru</option>
                                                <option value="Karyawan Swasta" @selected(old('pekerjaan_ayah', $pendaftaran->pekerjaan_ayah ?? '') == 'Karyawan Swasta')>Karyawan Swasta</option>
                                                <option value="Wiraswasta" @selected(old('pekerjaan_ayah', $pendaftaran->pekerjaan_ayah ?? '') == 'Wiraswasta')>Wiraswasta</option>
                                                <option value="Petani" @selected(old('pekerjaan_ayah', $pendaftaran->pekerjaan_ayah ?? '') == 'Petani')>Petani</option>
                                                <option value="Buruh" @selected(old('pekerjaan_ayah', $pendaftaran->pekerjaan_ayah ?? '') == 'Buruh')>Buruh</option>
                                                <option value="Pedagang" @selected(old('pekerjaan_ayah', $pendaftaran->pekerjaan_ayah ?? '') == 'Pedagang')>Pedagang</option>
                                                <option value="Nelayan" @selected(old('pekerjaan_ayah', $pendaftaran->pekerjaan_ayah ?? '') == 'Nelayan')>Nelayan</option>
                                                <option value="Sopir" @selected(old('pekerjaan_ayah', $pendaftaran->pekerjaan_ayah ?? '') == 'Sopir')>Sopir</option>
                                                <option value="Tidak Bekerja" @selected(old('pekerjaan_ayah', $pendaftaran->pekerjaan_ayah ?? '') == 'Tidak Bekerja')>Tidak Bekerja</option>
                                                <option value="Pensiunan" @selected(old('pekerjaan_ayah', $pendaftaran->pekerjaan_ayah ?? '') == 'Pensiunan')>Pensiunan</option>
                                                <option value="Lainnya" @selected(old('pekerjaan_ayah', $pendaftaran->pekerjaan_ayah ?? '') == 'Lainnya')>Lainnya</option>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label fw-semibold">
                                            Penghasilan per Bulan <span class="text-danger">*</span>
                                        </label>

                                        <select name="penghasilan_ayah" class="form-select" required>
                                            <option value="">-- Pilih Penghasilan --</option>
                                            <option value="Kurang dari Rp500.000" @selected(old('penghasilan_ayah', $pendaftaran->penghasilan_ayah ?? '') == 'Kurang dari Rp500.000')>Kurang dari Rp500.000</option>
                                            <option value="Rp500.000–Rp999.999" @selected(old('penghasilan_ayah', $pendaftaran->penghasilan_ayah ?? '') == 'Rp500.000–Rp999.999')>Rp500.000–Rp999.999</option>
                                            <option value="Rp1.000.000–Rp1.999.999" @selected(old('penghasilan_ayah', $pendaftaran->penghasilan_ayah ?? '') == 'Rp1.000.000–Rp1.999.999')>Rp1.000.000–Rp1.999.999</option>
                                            <option value="Rp2.000.000–Rp4.999.999" @selected(old('penghasilan_ayah', $pendaftaran->penghasilan_ayah ?? '') == 'Rp2.000.000–Rp4.999.999')>Rp2.000.000–Rp4.999.999</option>
                                            <option value="Lebih dari Rp5.000.000" @selected(old('penghasilan_ayah', $pendaftaran->penghasilan_ayah ?? '') == 'Lebih dari Rp5.000.000')>Lebih dari Rp5.000.000</option>
                                        </select>
                                    </div>

                                    <hr class="my-4">

                                    <!-- Data Ibu -->
                                    <h5 class="fw-bold mb-3">Data Ibu</h5>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">
                                            Nama Ibu <span class="text-danger">*</span>
                                        </label>

                                        <input
                                            type="text"
                                            name="nama_ibu"
                                            class="form-control"
                                            placeholder="Masukkan nama ibu"
                                            value="{{ old('nama_ibu', $pendaftaran->nama_ibu ?? '') }}"
                                            required
                                        >
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">
                                            NIK Ibu <span class="text-danger">*</span>
                                        </label>

                                        <input
                                            type="text"
                                            name="nik_ibu"
                                            class="form-control"
                                            placeholder="Masukkan NIK ibu"
                                            value="{{ old('nik_ibu', $pendaftaran->nik_ibu ?? '') }}"
                                            required
                                        >
                                    </div>

                                    <div class="row">

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold">
                                                Pendidikan Terakhir <span class="text-danger">*</span>
                                            </label>

                                            <select name="pendidikan_ibu" class="form-select" required>
                                                <option value="">-- Pilih Pendidikan --</option>
                                                <option value="Tidak Sekolah" @selected(old('pendidikan_ibu', $pendaftaran->pendidikan_ibu ?? '') == 'Tidak Sekolah')>Tidak Sekolah</option>
                                                <option value="SD/Sederajat" @selected(old('pendidikan_ibu', $pendaftaran->pendidikan_ibu ?? '') == 'SD/Sederajat')>SD/Sederajat</option>
                                                <option value="SMP/Sederajat" @selected(old('pendidikan_ibu', $pendaftaran->pendidikan_ibu ?? '') == 'SMP/Sederajat')>SMP/Sederajat</option>
                                                <option value="SMA/Sederajat" @selected(old('pendidikan_ibu', $pendaftaran->pendidikan_ibu ?? '') == 'SMA/Sederajat')>SMA/Sederajat</option>
                                                <option value="Diploma" @selected(old('pendidikan_ibu', $pendaftaran->pendidikan_ibu ?? '') == 'Diploma')>Diploma</option>
                                                <option value="S1" @selected(old('pendidikan_ibu', $pendaftaran->pendidikan_ibu ?? '') == 'S1')>S1</option>
                                                <option value="S2" @selected(old('pendidikan_ibu', $pendaftaran->pendidikan_ibu ?? '') == 'S2')>S2</option>
                                                <option value="S3" @selected(old('pendidikan_ibu', $pendaftaran->pendidikan_ibu ?? '') == 'S3')>S3</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold">
                                                Pekerjaan <span class="text-danger">*</span>
                                            </label>

                                            <select name="pekerjaan_ibu" class="form-select" required>
                                                <option value="">-- Pilih Pekerjaan --</option>
                                                <option value="PNS" @selected(old('pekerjaan_ibu', $pendaftaran->pekerjaan_ibu ?? '') == 'PNS')>PNS</option>
                                                <option value="TNI/Polri" @selected(old('pekerjaan_ibu', $pendaftaran->pekerjaan_ibu ?? '') == 'TNI/Polri')>TNI/Polri</option>
                                                <option value="Guru" @selected(old('pekerjaan_ibu', $pendaftaran->pekerjaan_ibu ?? '') == 'Guru')>Guru</option>
                                                <option value="Karyawan Swasta" @selected(old('pekerjaan_ibu', $pendaftaran->pekerjaan_ibu ?? '') == 'Karyawan Swasta')>Karyawan Swasta</option>
                                                <option value="Wiraswasta" @selected(old('pekerjaan_ibu', $pendaftaran->pekerjaan_ibu ?? '') == 'Wiraswasta')>Wiraswasta</option>
                                                <option value="Petani" @selected(old('pekerjaan_ibu', $pendaftaran->pekerjaan_ibu ?? '') == 'Petani')>Petani</option>
                                                <option value="Buruh" @selected(old('pekerjaan_ibu', $pendaftaran->pekerjaan_ibu ?? '') == 'Buruh')>Buruh</option>
                                                <option value="Pedagang" @selected(old('pekerjaan_ibu', $pendaftaran->pekerjaan_ibu ?? '') == 'Pedagang')>Pedagang</option>
                                                <option value="Ibu Rumah Tangga" @selected(old('pekerjaan_ibu', $pendaftaran->pekerjaan_ibu ?? '') == 'Ibu Rumah Tangga')>Ibu Rumah Tangga</option>
                                                <option value="Pensiunan" @selected(old('pekerjaan_ibu', $pendaftaran->pekerjaan_ibu ?? '') == 'Pensiunan')>Pensiunan</option>
                                                <option value="Tidak Bekerja" @selected(old('pekerjaan_ibu', $pendaftaran->pekerjaan_ibu ?? '') == 'Tidak Bekerja')>Tidak Bekerja</option>
                                                <option value="Lainnya" @selected(old('pekerjaan_ibu', $pendaftaran->pekerjaan_ibu ?? '') == 'Lainnya')>Lainnya</option>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label fw-semibold">
                                            Penghasilan per Bulan <span class="text-danger">*</span>
                                        </label>

                                        <select name="penghasilan_ibu" class="form-select" required>
                                            <option value="">-- Pilih Penghasilan --</option>
                                            <option value="Kurang dari Rp500.000" @selected(old('penghasilan_ibu', $pendaftaran->penghasilan_ibu ?? '') == 'Kurang dari Rp500.000')>Kurang dari Rp500.000</option>
                                            <option value="Rp500.000–Rp999.999" @selected(old('penghasilan_ibu', $pendaftaran->penghasilan_ibu ?? '') == 'Rp500.000–Rp999.999')>Rp500.000–Rp999.999</option>
                                            <option value="Rp1.000.000–Rp1.999.999" @selected(old('penghasilan_ibu', $pendaftaran->penghasilan_ibu ?? '') == 'Rp1.000.000–Rp1.999.999')>Rp1.000.000–Rp1.999.999</option>
                                            <option value="Rp2.000.000–Rp4.999.999" @selected(old('penghasilan_ibu', $pendaftaran->penghasilan_ibu ?? '') == 'Rp2.000.000–Rp4.999.999')>Rp2.000.000–Rp4.999.999</option>
                                            <option value="Lebih dari Rp5.000.000" @selected(old('penghasilan_ibu', $pendaftaran->penghasilan_ibu ?? '') == 'Lebih dari Rp5.000.000')>Lebih dari Rp5.000.000</option>
                                        </select>
                                    </div>

                                    <hr class="my-4">

                                    <!-- Kontak -->
                                    <h5 class="fw-bold mb-3">
                                        Kontak Orang Tua/Wali
                                    </h5>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">
                                            No. HP Orang Tua/Wali <span class="text-danger">*</span>
                                        </label>

                                        <input
                                            type="text"
                                            name="no_hp"
                                            class="form-control"
                                            placeholder="Masukkan nomor HP yang aktif"
                                            value="{{ old('no_hp', $pendaftaran->no_hp ?? '') }}"
                                            required
                                        >
                                    </div>

                                    <div class="mb-0">
                                        <label class="form-label fw-semibold">
                                            Email Orang Tua/Wali <span class="text-danger">*</span>
                                        </label>

                                        <input
                                            type="email"
                                            name="email_orang_tua"
                                            class="form-control"
                                            placeholder="Masukkan email orang tua/wali"
                                            value="{{ old('email_orang_tua', $pendaftaran->email_orang_tua ?? '') }}"
                                            required
                                        >
                                    </div>

                                </div>
                            </div>

                        </fieldset>

                        <!-- Tombol -->
                        <div class="d-flex justify-content-between align-items-center">

                            <a href="/dashboard" class="btn btn-outline-danger">
                                Kembali
                            </a>

                            @if (!$formulirTerkunci)
                                <button type="submit" class="btn btn-danger px-4">
                                    Simpan & Lanjutkan
                                </button>
                            @endif

                        </div>

                    </form>

                @else

                    <div class="alert alert-warning">
                        <strong>Formulir pendaftaran belum dapat diisi.</strong>
                        <p class="mb-0 mt-1">
                            @if ($pengaturan->tanggal_buka && now()->lt($pengaturan->tanggal_buka))
                                Pendaftaran belum dibuka. Silakan kembali sesuai jadwal.
                            @elseif ($pengaturan->tanggal_tutup && now()->gt($pengaturan->tanggal_tutup))
                                Pendaftaran sudah melewati batas waktu.
                            @else
                                Kuota pendaftaran telah terpenuhi.
                            @endif
                        </p>
                    </div>

                @endif

            </div>
        </div>

    </div>

</body>
</html>
