<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>Data RW - Dashboard Admin BUMDes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        .sidebar a, .dropdown-btn {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            margin-bottom: 2px;
            border-radius: 5px;
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }
        .sidebar a:hover, .dropdown-btn:hover, .sidebar .active {
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
        .card .card-footer {
            background: #0d47a1;
            color: white;
            font-weight: bold;
            text-align: center;
        }
        .table th {
            background-color: #0d47a1;
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
        <a href="{{ route('data_rw') }}"class="active">📋 Data RW</a>
    </div>
    <button class="dropdown-btn">💰 Kelola Tagihan ▼</button>
    <div class="dropdown-content">
        <a href="{{ route('tagihan.index') }}">📋 Tambah Tagihan</a>
        <a href="{{ route('konfirmasi_tagihan') }}">📋 Konfirmasi Tagihan</a>
    </div>
    <a href="{{ route('laporan.iuran') }}">📊 Laporan Iuran Sampah</a>
    <a href="{{ route('kelola.peran') }}">🔑 Kelola Peran</a>
    <a href="{{ route('profil') }}">👤 Profil</a>
    <a href="{{ route('login.admin') }}">🚪 Keluar</a>
</div>

<div class="content">
    <h2 class="mb-4">Data RW</h2>
    
    <div class="mb-3">
        <a href="{{ route('tambah_rw') }}" class="btn btn-primary">Tambah Data</a>
        <a href="#" class="btn btn-secondary">Export Data</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>RW</th>
                <th>Jumlah KK</th>
                <th>Ketua RW</th>
                <th>Nominal Iuran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($data_rw as $index => $rw)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $rw->RW }}</td>
            <td>{{ $rw->JumlahKK }}</td>
            <td>{{ $rw->KetuaRW }}</td>
            <td>Rp{{ number_format($rw->Iuran, 0, ',', '.') }}</td>
            <td>

                        <!-- Tombol Edit (Memicu Modal Pop-up) -->
<button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editRWModal{{ $rw->idRW }}">
    Ubah
</button>

<!-- Modal Edit -->
<div class="modal fade" id="editRWModal{{ $rw->idRW }}" tabindex="-1" aria-labelledby="editRWModalLabel{{ $rw->idRW }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRWModalLabel{{ $rw->idRW }}">Edit Data RW</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('rw.update', $rw->idRW) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- RW -->
                    <div class="mb-3">
                        <label for="RW_{{ $rw->idRW }}" class="form-label">RW</label>
                        <input type="text" class="form-control" id="RW_{{ $rw->idRW }}" name="RW" value="{{ old('RW', $rw->RW) }}" required>
                    </div>

                    <!-- Jumlah KK -->
                    <div class="mb-3">
                        <label for="JumlahKK_{{ $rw->idRW }}" class="form-label">Jumlah KK</label>
                        <input type="number" class="form-control" id="JumlahKK_{{ $rw->idRW }}" name="JumlahKK" value="{{ old('JumlahKK', $rw->JumlahKK) }}" required>
                    </div>

                    <!-- Ketua RW -->
                    <div class="mb-3">
                        <label for="KetuaRW_{{ $rw->idRW }}" class="form-label">Ketua RW</label>
                        <input type="text" class="form-control" id="KetuaRW_{{ $rw->idRW }}" name="KetuaRW" value="{{ old('KetuaRW', $rw->KetuaRW) }}" required>
                    </div>

                    <!-- Iuran -->
                    <div class="mb-3">
                        <label for="Iuran_{{ $rw->idRW }}" class="form-label">Iuran</label>
                        <input type="number" class="form-control" id="Iuran_{{ $rw->idRW }}" name="Iuran" value="{{ old('Iuran', $rw->Iuran) }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Tombol Hapus -->
<form action="{{ route('rw.destroy', $rw->idRW) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
</form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let dropdownButtons = document.querySelectorAll(".dropdown-btn");

        dropdownButtons.forEach(function (btn) {
            let dropdownContent = btn.nextElementSibling;
            let menuKey = btn.innerText.trim(); // Nama unik berdasarkan teks tombol

            // Cek jika sebelumnya terbuka
            if (sessionStorage.getItem(menuKey) === "open") {
                dropdownContent.style.display = "block";
            }

            btn.addEventListener("click", function () {
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
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const editButtons = document.querySelectorAll(".btn-edit");
        
        editButtons.forEach(button => {
            button.addEventListener("click", function () {
                const id = this.getAttribute("data-id");
                const rw = this.getAttribute("data-rw");
                const jumlahkk = this.getAttribute("data-jumlahkk");
                const ketuarw = this.getAttribute("data-ketuarw");
                const iuran = this.getAttribute("data-iuran");

                document.getElementById("editRWID").value = id;
                document.getElementById("editRW").value = rw;
                document.getElementById("editJumlahKK").value = jumlahkk;
                document.getElementById("editKetuaRW").value = ketuarw;
                document.getElementById("editIuran").value = iuran;

                document.getElementById("editRWForm").action = "/rw/" + id + "/update";
            });
        });
    });
</script>

</body>
</html>
