<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Tagihan - Dashboard Admin BUMDes</title>
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

        .profile-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 500px;
            margin: auto;
        }

        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .table th {
            background-color: #0d47a1;
            color: white;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }

        button {
            padding: 8px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 48%;
        }

        .btn-cancel {
            background: #b0bec5;
            color: black;
        }

        .btn-save {
            background: #0d47a1;
            color: white;
        }

        button:hover {
            opacity: 0.8;
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
            <a href="{{ route('konfirmasi_tagihan') }}">📋 Konfirmasi Tagihan</a>
        </div>
        <a href="{{ route('laporan.iuran') }}">📊 Laporan Iuran Sampah</a>
        <a href="{{ route('kelola.peran') }}">🔑 Kelola Peran</a>
        <a href="{{ route('profil') }}">👤 Profil</a>
        <form action="{{ route('logout.admin') }}" method="POST">
    @csrf
    <button type="submit" class="sidebar-link">🚪 Keluar</button>
</form>
    </div>

    <div class="content">
        <div class="profile-container">
            <h2>Tambah Tagihan</h2>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('tagihan.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="text" id="nik" name="nik" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" id="nama" name="nama" class="form-control" required readonly>
                </div>
                <div class="mb-3">
                    <label for="nomor_hp" class="form-label">Nomor HP</label>
                    <input type="text" id="nomor_hp" name="nomor_hp" class="form-control" required readonly>
                </div>
                <div class="mb-3">
                    <label for="rt_rw" class="form-label">RT/RW</label>
                    <input type="text" id="rt_rw" name="rt_rw" class="form-control" required readonly>
                </div>
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah Tagihan</label>
                    <input type="number" name="jumlah" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="statusTagihan" class="form-label">Status</label>
                    <select name="statusTagihan" class="form-control">
                        <option value="Belum Dibayar">Belum Dibayar</option>
                        <option value="Lunas">Lunas</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tanggalPembuatan" class="form-label">Tanggal Pembuatan</label>
                    <input type="date" name="tanggalPembuatan" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="tanggalJatuhTempo" class="form-label">Tanggal Jatuh Tempo</label>
                    <input type="date" name="tanggalJatuhTempo" class="form-control" required>
                </div>

                <div class="button-container">
                    <button onclick="window.location.href='{{ route('tagihan.index') }}'" type="reset" class="btn-cancel">Batal</button>
                    <button type="submit" class="btn-save">Simpan</button>
                    <div>
            </form>
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
    </script>

<script>
    document.getElementById('nik').addEventListener('input', function() {
        var nik = this.value;

        if (nik.length >= 16) { // NIK biasanya 16 digit
            fetch('/get-data-warga/' + nik)
                .then(response => response.json())
                .then(data => {
                    if (data.nama) {
                        document.getElementById('nama').value = data.nama;
                        document.getElementById('nomor_hp').value = data.nomor_hp;
                        document.getElementById('rt_rw').value = data.rt_rw;
                    } else {
                        document.getElementById('nama').value = '';
                        document.getElementById('nomor_hp').value = '';
                        document.getElementById('rt_rw').value = '';
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    });
</script>


</body>

</html>