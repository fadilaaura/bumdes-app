<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="shortcut icon" href="images/logo-nb.png" type="image/x-icon">
    <title>Laporan Iuran Sampah - Dashboard Admin BUMDes</title>
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

        .sidebar a,
        .sidebar button {
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

        .sidebar a:hover,
        .sidebar button:hover,
        .sidebar .active {
            background: rgba(255, 255, 255, 0.2);
        }

        .sidebar form {
            margin: 0;
            padding: 0;
        }

        .sidebar form button {
            color: white;
            background: none;
            border: none;
            text-align: left;
            display: block;
            padding: 10px;
            margin-bottom: 2px;
            border-radius: 5px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
        }

        .sidebar form button:hover, .sidebar form button:focus {
            background: rgba(255, 255, 255, 0.2);
            outline: none;
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

        h2 {
            color: #0d47a1;
            background: #e3f2fd;
            padding: 15px;
            border-radius: 5px;
        }


        /* Form */
        form {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
        }

        input,
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .btn-cetak {
            background: #0d47a1;
            color: white;
            font-size: 16px;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin-top: 15px;
        }

        .btn-cetak:hover {
            background: #1565c0;
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
            <a href="{{ route('tagihan.index') }}">📋 Tambah Tagihan</a>
            <a href="{{ route('konfirmasi.pembayaran') }}">📋 Konfirmasi Tagihan</a>
        </div>
        <a href="{{ route('laporan.iuran') }}" class="active">📊 Laporan Iuran Sampah</a>
        <a href="{{ route('kelola.peran') }}">🔑 Kelola Peran</a>
        <a href="{{ route('profil') }}">👤 Profil</a>
        <a href="{{ route('logout.admin') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            🚪 Keluar
        </a>
        <form id="logout-form" action="{{ route('logout.admin') }}" method="POST" style="display: none;">
            @csrf
        </form>
   
</div>

    <div class="content">
        <h2>Cetak Laporan Iuran Sampah</h2>
        <form action="laporan.php" method="POST">
            <div class="row">
                <div class="col-md-5">
                    <label for="rentang-waktu-awal">Tanggal Awal:</label>
                    <input type="date" id="rentang-waktu-awal" name="rentang_waktu_awal" class="form-control">
                </div>
                <div class="col-md-1 text-center align-self-end">
                    <strong>s/d</strong>
                </div>
                <div class="col-md-5">
                    <label for="rentang-waktu-akhir">Tanggal Akhir:</label>
                    <input type="date" id="rentang-waktu-akhir" name="rentang_waktu_akhir" class="form-control">
                </div>
            </div>
            <label for="pilihan-data">Pilihan Data:</label>
            <select id="pilihan-data" name="pilihan_data">
                <option value="">Pilih Data</option>
                <option value="lunas">Lunas</option>
                <option value="belum-lunas">Belum Dibayar</option>
            </select>
            <label for="rw">RW:</label>
            <select id="rw" name="rw">
                <option value="">Pilih Data</option>
                <option value="01">RW 01</option>
                <option value="02">RW 02</option>
            </select>
            <label for="rt">RT:</label>
            <select id="rt" name="rt">
                <option value="">Pilih Data</option>
                <option value="001">RT 001</option>
                <option value="002">RT 002</option>
            </select>
            <button type="submit" class="btn-cetak">Cetak</button>
        </form>
    </div>

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