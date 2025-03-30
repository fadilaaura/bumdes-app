<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/logo-nb.png" type="image/x-icon">
    <title>Kelola Tagihan - Dashboard Admin BUMDes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background: #0d47a1;
            position: fixed;
            color: white;
            padding: 20px;
        }

        .sidebar a, .sidebar-link,
        .dropdown-btn {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            margin-bottom: 2px;
            border-radius: 5px;
            background: none;
            border: none;
            text-align: left;
            cursor: pointer;
            width: 100%;
        }

        .sidebar a:hover, .sidebar-link:hover, .sidebar-link.active,
        .dropdown-btn:hover,
        .sidebar .active {
            background: rgba(255, 255, 255, 0.2);
        }

        .dropdown-content {
            display: none;
            flex-direction: column;
            background: #1565c0;
            margin-left: 10px;
            border-radius: 5px;
        }

        .dropdown-content a {
            padding: 10px;
            color: white;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .content {
            margin-left: 270px;
            padding: 20px;
        }

        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Tabel */
        .table {
            background: white;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .table th {
            background: #0d47a1;
            color: white;
        }

        .table tr:hover {
            background: #f1f1f1;
        }
                        
        .btn-primary{
        background-color: #0d47a1; /* Warna background halaman */
        color: #f4f6f9; /* Warna teks saat hover */
        border-color: #0d47a1;
    }
    
        .btn-sm:hover {
        color: #f4f6f9; /* Warna teks saat hover */
        border-color: #0d47a1;
    }
    
        .btn-primary.btn-sm{
        color: white;
    }
    </style>
</head>

<body>

    <div class="sidebar">
        <h4>Badan Usaha Milik Desa</h4>
        <h5>Spirit Mejabar</h5>
        <hr>
        <a href="{{ route('admin.dashboard') }}">🏠 Beranda</a>
        <button class="dropdown-btn">📂 Data Master ▼</button>
        <div class="dropdown-content">
            <a href="{{ route('data_kk') }}">📋 Data KK</a>
            <a href="{{ route('data_rt') }}">📋 Data RT</a>
            <a href="{{ route('data_rw') }}">📋 Data RW</a>
        </div>
        <button class="dropdown-btn">💰 Kelola Tagihan ▼</button>
        <div class="dropdown-content">
            <a href="{{ route('tagihan.index') }}" class="active">📋 Tambah Tagihan</a>
            <a href="{{ route('konfirmasi.pembayaran') }}">📋 Konfirmasi Tagihan</a>
        </div>
        <a href="{{ route('laporan.iuran') }}">📊 Laporan Iuran Sampah</a>
        <a href="{{ route('kelola.peran') }}">🔑 Kelola Peran</a>
        <a href="{{ route('profil') }}">👤 Profil</a>
        <form action="{{ route('logout.admin') }}" method="POST">
    @csrf
    <button type="submit" class="sidebar-link">🚪 Keluar</button>
</form>    </div>

    <div class="content">
        <h2>Kelola Tagihan</h2>
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <div>
                <a href="{{ route('tagihan.create') }}" class="btn btn-primary btn-sm">Tambah Tagihan</a>
                <button class="btn btn-success btn-sm" onclick="window.location.href='{{ route('export.tagihan') }}'">
                    Export Data
                </button>
            </div>
            <form action="{{ route('tagihan.index') }}" method="GET" class="d-flex align-items-center gap-2">
            <div class="input-group input-group-sm">
                    <input type="text" name="search" class="form-control form-control-sm" style="width: 270px;" placeholder="Cari Nama, NIK, No. HP, atau RT/RW">
                    <select name="status" class="form-select form-select-sm" style="width: 150px;">
    <option value="">Semua Status</option>
    <option value="Lunas" {{ request('status') == 'Lunas' ? 'selected' : '' }}>Lunas</option>
    <option value="Belum Dibayar" {{ request('status') == 'Belum Dibayar' ? 'selected' : '' }}>Belum Dibayar</option>
</select>

                    <button type="submit" class="btn btn-primary btn-sm">Cari</button>
                </div>
            </form>
        </div>

        <div class="d-flex align-items-center mt-2">
            <label for="perPage" class="me-2">Tampilkan:</label>
            <select name="perPage" id="perPage" class="form-select form-select-sm" style="width: 65px;" onchange="this.form.submit()">
                <option value="10" {{ request('perPage', 10) == 10 ? 'selected' : '' }}>10</option>
                <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20</option>
                <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
            </select>
        </div>

        @php
        $tagihans = $tagihans ?? collect(); // Kalau belum ada, isi dengan koleksi kosong
        @endphp

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <table class="table table-bordered mt-2">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>Nomor HP</th>
                    <th>RT/RW</th>
                    <th>Jumlah</th>
                    <th>Tanggal Jatuh Tempo</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tagihans as $tagihan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $tagihan->nama }}</td>
                    <td>{{ $tagihan->nik }}</td>
                    <td>{{ $tagihan->nomor_hp }}</td>
                    <td>{{ $tagihan->rt_rw }}</td>
                    <td>{{ $tagihan->jumlah }}</td>
                    <td>{{ $tagihan->tanggalJatuhTempo}}</td>
                    <td>{{ $tagihan->statusTagihan }}</td>
                    <td>
                        @php
                            $nomorWa = ltrim($tagihan->nomor_hp, '0');
                            $nomorWa = '62' . $nomorWa;
                    
                            $pesan = "Halo {$tagihan->nama},%0A"
                            . "Kami dari BUMDes Spirit Mejabar ingin menginformasikan bahwa Anda memiliki tagihan iuran sampah sebesar: *Rp " . number_format($tagihan->jumlah, 0, ',', '.') . "*.%0A"
                            . "Jatuh tempo pembayaran: *" . \Carbon\Carbon::parse($tagihan->tanggalJatuhTempo)->translatedFormat('d F Y') . "*.%0A%0A"
                            . "Mohon untuk melakukan pembayaran sebelum tanggal tersebut. Terima kasih atas perhatian dan kerja samanya 🙏";
                        @endphp
                        <a href="https://wa.me/{{ $nomorWa }}?text={{ $pesan }}"
                            target="_blank" class="btn btn-success btn-sm">
                            Kirim WhatsApp
                        </a>

                        <button class="btn btn-primary btn-sm edit-btn"
                            data-id="{{ $tagihan->idTagihan }}"
                            data-nama="{{ $tagihan->nama }}"
                            data-nik="{{ $tagihan->nik }}"
                            data-nomor_hp="{{ $tagihan->nomor_hp }}"
                            data-rt_rw="{{ $tagihan->rt_rw }}"
                            data-jumlah="{{ $tagihan->jumlah }}"
                            data-status="{{ $tagihan->statusTagihan }}"
                            data-tanggal_pembuatan="{{ $tagihan->tanggalPembuatan }}"
                            data-tanggal_jatuh_tempo="{{ $tagihan->tanggalJatuhTempo }}">
                            Ubah
                        </button>

                        <form action="{{ route('tagihan.destroy', $tagihan->idTagihan) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm mt-2" onclick="return confirm('Yakin ingin menghapus tagihan ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4 d-flex justify-content-center align-items-center">
            <nav aria-label="Page navigation">
                <ul class="pagination pagination-sm">
                    {{ $tagihans->links('pagination::bootstrap-4') }}
                </ul>
            </nav>
        </div>

        <form id="perPageForm" action="{{ route('tagihan.index') }}" method="GET" style="display: none;">
            <input type="hidden" name="search" value="{{ request('search') }}">
            <input type="hidden" name="status" value="{{ request('status') }}">
            <input type="hidden" name="perPage" id="perPageInput">
        </form>

    </div>

    <!-- Modal Edit Tagihan -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Tagihan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="edit_nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="edit_nama" name="nama" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit_nik" class="form-label">NIK</label>
                            <input type="text" class="form-control" id="edit_nik" name="nik" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit_nomor_hp" class="form-label">Nomor HP</label>
                            <input type="text" class="form-control" id="edit_nomor_hp" name="nomor_hp" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit_rt_rw" class="form-label">RT/RW</label>
                            <input type="text" class="form-control" id="edit_rt_rw" name="rt_rw" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit_jumlah" class="form-label">Jumlah Tagihan</label>
                            <input type="number" class="form-control" id="edit_jumlah" name="jumlah" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit_statusTagihan" class="form-label">Status</label>
                            <select class="form-control" id="edit_statusTagihan" name="statusTagihan">
                                <option value="Belum Dibayar">Belum Dibayar</option>
                                <option value="Lunas">Lunas</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="edit_tanggalPembuatan" class="form-label">Tanggal Pembuatan</label>
                            <input type="date" class="form-control" id="edit_tanggalPembuatan" name="tanggalPembuatan" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit_tanggalJatuhTempo" class="form-label">Tanggal Jatuh Tempo</label>
                            <input type="date" class="form-control" id="edit_tanggalJatuhTempo" name="tanggalJatuhTempo" required>
                        </div>

                        <div class="modal-footer d-flex justify-content-center w-100">
                            <button type="button" class="btn btn-secondary flex-fill mx-2" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary flex-fill mx-2">Simpan</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let dropdownButtons = document.querySelectorAll(".dropdown-btn");

            dropdownButtons.forEach(function(btn) {
                let dropdownContent = btn.nextElementSibling;
                let menuKey = btn.innerText.trim(); // Nama unik berdasarkan teks tombol

                // Cek jika sebelumnya terbuka
                if (sessionStorage.getItem(menuKey) === "open") {
                    dropdownContent.style.display = "block";
                }

                btn.addEventListener("click", function() {
                    // Toggle dropdown
                    if (dropdownContent.style.display === "block") {
                        dropdownContent.style.display = "none";
                        sessionStorage.setItem(menuKey, "closed");
                    } else {
                        dropdownContent.style.display = "block";
                        sessionStorage.setItem(menuKey, "open");
                    }
                });
            });
        });


        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById('edit_nama').value = this.dataset.nama;
                document.getElementById('edit_nik').value = this.dataset.nik;
                document.getElementById('edit_nomor_hp').value = this.dataset.nomor_hp;
                document.getElementById('edit_rt_rw').value = this.dataset.rt_rw;
                document.getElementById('edit_jumlah').value = this.dataset.jumlah;
                document.getElementById('edit_statusTagihan').value = this.dataset.status;
                document.getElementById('edit_tanggalPembuatan').value = this.dataset.tanggal_pembuatan;
                document.getElementById('edit_tanggalJatuhTempo').value = this.dataset.tanggal_jatuh_tempo;

                document.getElementById('editForm').action = "/admin/tagihan/update/" + button.dataset.id;


                var editModal = new bootstrap.Modal(document.getElementById('editModal'));
                editModal.show();
            });
        });
    </script>

<script>
        document.getElementById('perPage').addEventListener('change', function() {
            document.getElementById('perPageInput').value = this.value;
            document.getElementById('perPageForm').submit();
        });
    </script>

</body>

</html>