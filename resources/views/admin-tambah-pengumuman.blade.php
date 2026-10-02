<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Pengumuman</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f6fa;
            color: #333;
        }

        .navbar {
            background: #b91c1c;
            color: white;
            padding: 20px 40px;
            font-size: 20px;
            font-weight: bold;
        }

        .container {
            max-width: 700px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        h2 {
            margin-top: 0;
            color: #991b1b;
        }

        .subtitle {
            color: #777;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input,
        textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 7px;
            font-size: 14px;
        }

        textarea {
            height: 130px;
            resize: vertical;
        }

        input:focus,
        textarea:focus {
            outline: none;
            border-color: #b91c1c;
        }

        .buttons {
            display: flex;
            gap: 10px;
        }

        button,
        .back {
            padding: 12px 18px;
            border: none;
            border-radius: 7px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
        }

        button {
            background: #b91c1c;
            color: white;
        }

        button:hover {
            background: #991b1b;
        }

        .back {
            background: #e5e7eb;
            color: #333;
        }
    </style>
</head>

<body>

    <div class="navbar">
        Admin PPDB - SDN Kedung Dalam 1
    </div>

    <div class="container">

        <div class="card">

            <h2>Tambah Pengumuman</h2>

            <p class="subtitle">
                Isi informasi pengumuman PPDB di bawah ini.
            </p>

            <form action="/admin/pengumuman" method="POST">
             @csrf

                <label>Judul Pengumuman</label>
                <input
                    type="text"
                    name="judul"
                    placeholder="Masukkan judul pengumuman"
                >

                <label>Isi Pengumuman</label>
                <textarea
                    name="isi"
                    placeholder="Tuliskan isi pengumuman..."
                ></textarea>

                <label>Tanggal Pengumuman</label>
                <input type="date" name="tanggal">

                <div class="buttons">
                    <button type="submit">
                        Simpan Pengumuman
                    </button>

                    <a href="/admin/pengumuman" class="back">
                        Kembali
                    </a>
                </div>

            </form>

        </div>

    </div>

</body>
</html>