<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Bukti Pendaftaran PPDB</title>

    <style>
        body {
            background: #f1f3f5;
        }

        .bukti {
            max-width: 850px;
            margin: 40px auto;
            background: white;
            padding: 45px 55px;
            border-radius: 10px;
            box-shadow: 0 4px 18px rgba(0,0,0,0.08);
        }

        .kop {
            text-align: center;
            border-bottom: 3px solid #b91c1c;
            padding-bottom: 18px;
            margin-bottom: 30px;
        }

        .kop h2 {
            margin: 0;
            font-weight: 700;
        }

        .kop h4 {
            margin: 5px 0;
            font-weight: 600;
        }

        .kop p {
            margin: 0;
            color: #666;
        }

        .judul {
            text-align: center;
            margin-bottom: 30px;
        }

        .judul h3 {
            font-weight: 700;
            margin-bottom: 5px;
        }

        .nomor {
            color: #666;
        }

        .data-title {
            font-weight: 700;
            color: #991b1b;
            margin-bottom: 15px;
        }

        .data-table th {
            width: 35%;
            font-weight: 600;
        }

        .keterangan {
            background: #f8f9fa;
            border-left: 4px solid #b91c1c;
            padding: 15px;
            margin-top: 25px;
        }

        .tanda-tangan {
            width: 220px;
            margin-left: auto;
            text-align: center;
            margin-top: 45px;
        }

        .ttd-space {
            height: 75px;
        }

        .buttons {
            text-align: center;
            margin-top: 35px;
        }

        @media print {
            body {
                background: white;
            }

            .bukti {
                max-width: none;
                margin: 0;
                padding: 20px;
                box-shadow: none;
                border-radius: 0;
            }

            .buttons {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="bukti">

        <!-- Kop -->
        <div class="kop">
            <h2>SDN KEDUNG DALAM 1</h2>
            <h4>PENERIMAAN PESERTA DIDIK BARU</h4>
            <p>Tahun Pelajaran 2026/2027</p>
        </div>

        <!-- Judul -->
        <div class="judul">
            <h3>BUKTI PENDAFTARAN</h3>

            <div class="nomor">
                Nomor Pendaftaran:
                <strong>PPDB-{{ date('Y') }}-{{ str_pad($pendaftaran->id, 4, '0', STR_PAD_LEFT) }}</strong>
            </div>
        </div>

        <!-- Data -->
        <div>
            <div class="data-title">
                A. Data Calon Peserta Didik
            </div>

            <table class="table table-borderless data-table">
                <tr>
                    <th>Nama Lengkap</th>
                    <td>: {{ $pendaftaran->nama_lengkap }}</td>
                </tr>

                <tr>
                    <th>NIK</th>
                    <td>: {{ $pendaftaran->nik }}</td>
                </tr>

                <tr>
                    <th>Tempat, Tanggal Lahir</th>
                    <td>
                        :
                        {{ $pendaftaran->tempat_lahir }},
                        {{ $pendaftaran->tanggal_lahir }}
                    </td>
                </tr>

                <tr>
                    <th>Jenis Kelamin</th>
                    <td>: {{ $pendaftaran->jenis_kelamin }}</td>
                </tr>

                <tr>
                    <th>Asal Sekolah</th>
                    <td>: {{ $pendaftaran->asal_sekolah }}</td>
                </tr>

                <tr>
                    <th>Tanggal Pendaftaran</th>
                    <td>: {{ $pendaftaran->created_at->format('d-m-Y') }}</td>
                </tr>

                <tr>
                    <th>Status Pendaftaran</th>
                    <td>
                        :
                        <strong>{{ $pendaftaran->status }}</strong>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Keterangan -->
        <div class="keterangan">
            <strong>Keterangan:</strong><br>
            Bukti ini menunjukkan bahwa calon peserta didik telah melakukan
            pendaftaran PPDB melalui website PPDB SDN Kedung Dalam 1.
            Simpan bukti ini sebagai dokumen pendaftaran.
        </div>

        <!-- Tanda tangan -->
        <div class="tanda-tangan">
            <p>
                Kedung Dalam,
                {{ $pendaftaran->created_at->format('d-m-Y') }}
            </p>

            <p>Panitia PPDB</p>

            <div class="ttd-space"></div>

            <strong>(_____________________)</strong>
        </div>

        <!-- Tombol -->
        <div class="buttons">
            <button onclick="window.print()" class="btn btn-danger">
                🖨 Cetak Bukti Pendaftaran
            </button>

            <a href="/dashboard" class="btn btn-outline-secondary">
                ← Kembali ke Dashboard
            </a>
        </div>

    </div>

</body>
</html>