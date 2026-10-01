<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Formulir Pendaftaran - PPDB</title>
</head>

<body>

<div class="container py-5">

    <div class="text-center mb-4">
        <h1 class="fw-bold">Formulir Pendaftaran</h1>
        <p>PPDB SDN Kedung Dalem 1</p>
    </div>

    <form method="POST" action="/pendaftaran">

        @csrf

        <div class="card mb-4">
            <div class="card-body">

                <h4 class="mb-4">Data Calon Siswa</h4>

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">NIK</label>
                    <input type="text" name="nik" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">NISN</label>
                    <input type="text" name="nisn" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control">
                        <option value="">-- Pilih --</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Asal TK/RA/PAUD</label>
                    <input type="text" name="asal_sekolah" class="form-control">
                </div>

            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">

                <h4 class="mb-4">Data Orang Tua/Wali</h4>

                <div class="mb-3">
                    <label class="form-label">Nama Ayah</label>
                    <input type="text" name="nama_ayah" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Ibu</label>
                    <input type="text" name="nama_ibu" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">No. HP Orang Tua/Wali</label>
                    <input type="text" name="no_hp" class="form-control">
                </div>

            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-danger px-5">
                Kirim Pendaftaran
            </button>
        </div>

    </form>

</div>

</body>
</html>