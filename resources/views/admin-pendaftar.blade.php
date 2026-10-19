
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Data Pendaftar - PPDB SDN Kedung Dalam 1</title>

    <style>
        body {
            background: #f7f8fa;
            color: #172033;
        }

        .page-header {
            background: #dc3545;
            color: white;
            padding: 18px 0;
        }

        .page-title {
            font-size: 30px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .applicant-card {
            background: white;
            border: 1px solid #eceef1;
            border-radius: 12px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, .04);
        }

        .filter-control {
            min-height: 43px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 9px 12px;
            width: 100%;
            background: white;
        }

        .table thead th {
            background: #fff0f1;
            color: #8e2330;
            font-size: 13px;
            white-space: nowrap;
            padding: 14px 12px;
            border-bottom: 1px solid #f1d5d8;
        }

        .table tbody td {
            padding: 14px 12px;
            font-size: 14px;
        }

        .table tbody tr:hover {
            background: #fffafa;
        }

        .status-badge {
            display: inline-block;
            border-radius: 20px;
            padding: 5px 10px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .status-lulus {
            background: #d1e7dd;
            color: #146c43;
        }

        .status-ditolak {
            background: #f8d7da;
            color: #b02a37;
        }

        .status-terverifikasi {
            background: #cfe2ff;
            color: #084298;
        }

        .status-menunggu {
            background: #fff3cd;
            color: #856404;
        }

        .detail-button {
            background: #dc3545;
            color: white;
            border-radius: 7px;
            padding: 7px 12px;
            font-size: 13px;
            text-decoration: none;
            white-space: nowrap;
        }

        .detail-button:hover {
            background: #bb2d3b;
            color: white;
        }

        @media (max-width: 576px) {
            .page-title {
                font-size: 24px;
            }

            .applicant-card {
                padding: 14px !important;
            }
        }
    </style>
</head>

<body>
    <nav class="page-header">
        <div class="container d-flex justify-content-between align-items-center gap-3">
            <a href="/admin/dashboard"
               class="navbar-brand text-white fw-bold mb-0">
                SDN Kedung Dalam 1
            </a>

            <a href="/admin/dashboard" class="btn btn-light btn-sm">
                Kembali
            </a>
        </div>
    </nav>

    <main class="container py-5">
        <div class="mb-4">
            <h1 class="page-title mb-2">Data Pendaftar</h1>
            <p class="text-secondary mb-0">
                Kelola dan pantau data calon siswa yang mendaftar PPDB.
            </p>
        </div>

        <section class="applicant-card p-4">
            <div class="row g-3 mb-4">
                <div class="col-12 col-md-7">
                    <label for="searchApplicant" class="form-label fw-semibold">
                        Cari Pendaftar
                    </label>
                    <input
                        type="search"
                        id="searchApplicant"
                        class="filter-control"
                        placeholder="Cari nama atau asal sekolah..."
                    >
                </div>

                <div class="col-12 col-md-5">
                    <label for="statusFilter" class="form-label fw-semibold">
                        Filter Status
                    </label>
                    <select id="statusFilter" class="filter-control">
                        <option value="">Semua Status</option>
                        <option value="menunggu">Menunggu Verifikasi</option>
                        <option value="terverifikasi">Terverifikasi</option>
                        <option value="lulus">Lulus</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered align-middle mb-0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Lengkap</th>
                            <th>Asal Sekolah</th>
                            <th>Tanggal Daftar</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="applicantTable">
                        @forelse ($pendaftarans as $pendaftaran)
                            @php
                                $status = strtolower($pendaftaran->status ?? '');
                                $statusClass = match ($status) {
                                    'lulus' => 'status-lulus',
                                    'ditolak' => 'status-ditolak',
                                    'terverifikasi' => 'status-terverifikasi',
                                    default => 'status-menunggu',
                                };
                            @endphp

                            <tr
                                data-search="{{ strtolower($pendaftaran->nama_lengkap . ' ' . $pendaftaran->asal_sekolah) }}"
                                data-status="{{ in_array($status, ['lulus', 'ditolak', 'terverifikasi']) ? $status : 'menunggu' }}"
                            >
                                <td>{{ $loop->iteration }}</td>
                                <td class="fw-semibold">
                                    {{ $pendaftaran->nama_lengkap }}
                                </td>
                                <td>{{ $pendaftaran->asal_sekolah ?: '-' }}</td>
                                <td>
                                    {{ $pendaftaran->created_at->format('d M Y, H:i') }}
                                </td>
                                <td>
                                    <span class="status-badge {{ $statusClass }}">
                                        {{ $pendaftaran->status ?: 'Menunggu Verifikasi' }}
                                    </span>
                                </td>
                                <td>
                                    <a
                                        href="/admin/pendaftar/{{ $pendaftaran->id }}"
                                        class="detail-button"
                                    >
                                        Lihat Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr id="emptyData">
                                <td colspan="6" class="text-center py-5 text-secondary">
                                    Belum ada data pendaftar.
                                </td>
                            </tr>
                        @endforelse

                        <tr id="noResults" style="display: none;">
                            <td colspan="6" class="text-center py-5 text-secondary">
                                Pendaftar tidak ditemukan.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <small class="text-secondary" id="resultCount">
                    Total pendaftar: {{ $pendaftarans->count() }}
                </small>

                <button type="button" class="btn btn-outline-danger btn-sm"
                        id="resetFilter">
                    Reset Filter
                </button>
            </div>
        </section>
    </main>

    <script>
        const searchInput = document.getElementById('searchApplicant');
        const statusFilter = document.getElementById('statusFilter');
        const resetButton = document.getElementById('resetFilter');
        const rows = [...document.querySelectorAll('#applicantTable tr[data-search]')];
        const noResults = document.getElementById('noResults');
        const resultCount = document.getElementById('resultCount');

        function filterApplicants() {
            const query = searchInput.value.trim().toLowerCase();
            const status = statusFilter.value;
            let visibleCount = 0;

            rows.forEach(row => {
                const matchesSearch = row.dataset.search.includes(query);
                const matchesStatus = !status || row.dataset.status === status;
                const visible = matchesSearch && matchesStatus;

                row.style.display = visible ? '' : 'none';

                if (visible) visibleCount++;
            });

            noResults.style.display =
                rows.length > 0 && visibleCount === 0 ? '' : 'none';

            resultCount.textContent =
                `Menampilkan ${visibleCount} dari ${rows.length} pendaftar`;
        }

        searchInput.addEventListener('input', filterApplicants);
        statusFilter.addEventListener('change', filterApplicants);

        resetButton.addEventListener('click', () => {
            searchInput.value = '';
            statusFilter.value = '';
            filterApplicants();
        });
    </script>
</body>
</html>
