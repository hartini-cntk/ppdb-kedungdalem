<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pengumuman Admin</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            padding: 30px;
        }

        .container {
            max-width: 900px;
            margin: auto;
        }

        h2 {
            color: #b91c1c;
        }

        .btn {
            display: inline-block;
            background: #b91c1c;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .card {
            background: white;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 8px #ddd;
        }

        .tanggal {
            color: #777;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="container">

    <h2>Pengumuman PPDB</h2>

    @if (session('success'))
    <div style="background: #d1fae5; color: #065f46; padding: 12px; border-radius: 7px; margin-bottom: 20px;">
        {{ session('success') }}
    </div>
        @endif

    <a href="/admin/pengumuman/tambah" class="btn">
        + Tambah Pengumuman
    </a>

    <a href="/admin/dashboard"
   style="display: inline-block; background: #8496b9; color: white; padding: 10px 15px; text-decoration: none; border-radius: 6px; margin-bottom: 20px;">
    ← Kembali ke Dashboard
    </a>

    @forelse ($pengumumans as $pengumuman)

        <div class="card">
            <h3>{{ $pengumuman->judul }}</h3>

            <p>{{ $pengumuman->isi }}</p>

            <p class="tanggal">
                Tanggal: {{ $pengumuman->tanggal }}
            </p>
        </div>

    @empty

        <div class="card">
            Belum ada pengumuman.
        </div>

    @endforelse

</div>

</body>
</html>