
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Upload Berkas - PPDB SDN Kedung Dalem 1</title>
</head>

<body class="bg-light">

    @php
        $jenisBerkas = [
            [
                'nama' => 'Kartu Keluarga (KK)',
                'jenis' => 'Kartu Keluarga',
                'input' => 'kk',
                'wajib' => true,
            ],
            [
                'nama' => 'Akta Kelahiran / Surat Kenal Lahir',
                'jenis' => 'Akta Kelahiran',
                'input' => 'akta',
                'wajib' => true,
            ],
            [
                'nama' => 'KTP Ibu',
                'jenis' => 'KTP Ibu',
                'input' => 'ktp_ibu',
                'wajib' => true,
            ],
            [
                'nama' => 'Kartu PKH',
                'jenis' => 'PKH',
                'input' => 'pkh',
                'wajib' => false,
            ],
            [
                'nama' => 'Dokumen Pendukung Lainnya',
                'jenis' => 'Dokumen Pendukung',
                'input' => 'dokumen_lain',
                'wajib' => false,
            ],
        ];

        $berkasByJenis = $berkas->keyBy('jenis_berkas');
    @endphp

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

    <!-- Content -->
    <div class="container py-5">

        <div class="mb-4">
            <h1 class="fw-bold">Upload Berkas</h1>

            <p class="text-secondary mb-0">
                Silakan upload dokumen persyaratan untuk melanjutkan
                proses pendaftaran PPDB.
            </p>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Periksa kembali dokumen kamu:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($berkasTerkunci)
            <div class="alert alert-warning">
                <strong>Berkas sudah dikunci.</strong>
                <p class="mb-0 mt-1">
                    Pendaftaran kamu sudah mencapai tahap verifikasi
                    atau keputusan akhir. Kamu masih bisa melihat
                    berkas, tetapi tidak dapat menambah atau menggantinya.
                </p>
            </div>
        @else
            <div class="alert alert-info">
                <strong>Informasi:</strong>
                Format file yang diterima adalah JPG, JPEG, PNG, atau PDF.
                Ukuran maksimal setiap file adalah 2 MB.
                Dokumen bertanda (*) wajib diunggah.
            </div>
        @endif

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">

                <form method="POST"
                      action="/upload-berkas"
                      enctype="multipart/form-data">

                    @csrf

                    @foreach ($jenisBerkas as $item)

                        @php
                            $dokumen = $berkasByJenis->get($item['jenis']);
                        @endphp

                        <div class="border rounded p-3 mb-4">

                            <label class="form-label fw-semibold">
                                {{ $item['nama'] }}

                                @if ($item['wajib'])
                                    <span class="text-danger">*</span>
                                @else
                                    <span class="text-secondary">
                                        (Opsional)
                                    </span>
                                @endif
                            </label>

                            @if ($dokumen)

                                <div class="mb-3">

                                    <p class="mb-1 text-secondary">
                                        File saat ini:
                                    </p>

                                    <p class="fw-semibold mb-2">
                                        {{ basename($dokumen->nama_file) }}
                                    </p>

                                    <a
                                        href="{{ asset('storage/' . $dokumen->nama_file) }}"
                                        target="_blank"
                                        class="btn btn-sm btn-outline-primary"
                                    >
                                        Lihat Berkas
                                    </a>

                                    <div class="mt-2">

                                        @if ($dokumen->status === 'Diterima')
                                            <span class="badge bg-success">
                                                Diterima
                                            </span>

                                        @elseif ($dokumen->status === 'Ditolak')
                                            <span class="badge bg-danger">
                                                Ditolak
                                            </span>

                                        @else
                                            <span class="badge bg-warning text-dark">
                                                Menunggu Verifikasi
                                            </span>
                                        @endif

                                    </div>
                                </div>

                            @else

                                <p class="text-secondary small mb-3">
                                    Dokumen belum diunggah.
                                </p>

                            @endif

                            @if (!$berkasTerkunci)

                                @if ($dokumen)
                                    <small class="text-secondary d-block mb-2">
                                        Pilih file baru jika ingin mengganti dokumen.
                                    </small>
                                @endif

                                <input
                                    type="file"
                                    name="{{ $item['input'] }}"
                                    class="form-control"
                                    accept=".jpg,.jpeg,.png,.pdf"
                                    @if ($item['wajib'] && !$dokumen)
                                        required
                                    @endif
                                >

                                <small class="text-secondary">
                                    Format JPG, JPEG, PNG, atau PDF.
                                    Maksimal 2 MB.
                                </small>

                            @endif

                        </div>

                    @endforeach

                    @if (!$berkasTerkunci)
                        <button
                            type="submit"
                            class="btn btn-danger w-100 py-2"
                        >
                            Simpan Berkas
                        </button>
                    @endif

                </form>

            </div>
        </div>

    </div>

</body>
</html>
