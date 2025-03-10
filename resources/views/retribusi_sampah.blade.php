<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Iuran Sampah - BUMDes Spirit Mejabar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            display: flex;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background: #0d47a1;
            color: white;
            position: fixed;
            padding: 20px;
        }
        .sidebar a, .sidebar-link, .sidebar button {
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
        .sidebar a:hover, .sidebar-link:hover, .sidebar-link.active, .sidebar button:hover, .sidebar .active {
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
            width: calc(100% - 270px);
        }
        .profile-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 950px;
            margin: auto;
        }
        h2 {
            color: #0d47a1;
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        .button-container {
            display: flex;
            justify-content: center; /* Mengatur tombol ke tengah */
            margin-top: 15px;
        }
        button {
            padding: 8px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 200px;
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
        .btn-primary{
            background-color: #0d47a1;
            width: 200px;
            color: #f4f6f9;
            border-color: #0d47a1;
        }
        .btn-sm:hover {
            color: #f4f6f9;
            border-color: #0d47a1;
        }
        .btn-primary.btn-sm{
            width: 200px;
            color: white;
        }
        .button-container-top {
            display: flex;
            margin-bottom: 15px;
        }
        .button-container-top button {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4>Badan Usaha Milik Desa</h4>
        <h5>Spirit Mejabar</h5>
        <hr>
        <a href="{{ route('dashboard.warga') }}">🏠 Beranda</a>
        <a href="{{ route('retribusi.sampah') }}" class="active">💷 Retribusi Sampah</a>
        <a href="{{ route('riwayat.pembayaran.warga') }}">📑 Riwayat Pembayaran</a>
        <a href="{{ route('profil_warga') }}">👤 Profil</a>
        <form action="{{ route('warga.logout') }}" method="POST">
            @csrf
            <button type="submit" class="sidebar-link">🚪 Keluar</button>
        </form>
    </div>
    <div class="content">
        <div class="button-container-top">
            <button onclick="window.location.href='{{ route('kepala_keluarga.create') }}'" class="btn btn-primary btn-sm">
                Tata Cara Pembayaran
            </button>
            <button class="btn btn-success btn-sm" onclick="window.location.href='{{ route('export.kepala.keluarga') }}'">
                Lihat QR Code
            </button>
        </div>
        <div class="profile-container">
            <h2>Pembayaran Iuran Sampah</h2>
            <form action="{{ route('retribusi.sampah.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="nama">Masukkan Nama</label>
                <input type="text" id="nama" name="nama" required>
                <label for="nik">Masukkan NIK</label>
                <input type="text" id="nik" name="nik" required>
                <label for="nomor_hp">Nomor HP</label>
                <input type="tel" id="nomor_hp" name="nomor_hp" required>
                <label for="jenis_pembayaran">Jenis Pembayaran</label>
                <select id="jenis_pembayaran" name="jenis_pembayaran" required>
                    <option value="">Pilih Jenis Pembayaran</option>
                    <option value="bulanan">Bulanan</option>
                    <option value="tahunan">Tahunan</option>
                </select>
                <div class="mb-3">
                    <label for="rt_rw" class="form-label">RT/RW</label>
                    <input type="text" name="rt_rw" class="form-control" required>
                </div>
                <label for="jumlah">Jumlah</label>
                <input type="number" id="jumlah" name="jumlah" required>
                <label for="buktiPembayaran">Upload Bukti Pembayaran</label>
                <input type="file" id="buktiPembayaran" name="buktiPembayaran" required>
                <div class="button-container">
                    <button type="reset" class="btn-cancel">Batal</button>
                    <button type="submit" class="btn-save">Bayar</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let dropdownButtons = document.querySelectorAll(".dropdown-btn");
            dropdownButtons.forEach(function(btn) {
                let dropdownContent = btn.nextElementSibling;
                let menuKey = btn.innerText.trim();
                if (sessionStorage.getItem(menuKey) === "open") {
                    dropdownContent.style.display = "block";
                }
                btn.addEventListener("click", function() {
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
</body>
</html>