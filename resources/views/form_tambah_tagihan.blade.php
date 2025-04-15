<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="images/logo-nb.png" type="image/x-icon">
    <title>Kelola Tagihan - Dashboard Admin BUMDes</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
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
            font-size: 14px;
            transition: margin 0.3s ease; 
            margin-left: 0; 
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
            display: flex;
            align-items: center; 
            gap: 10px;
            font-size: 14px;
        }

        .sidebar a:hover, .sidebar-link:hover, .sidebar-link.active,
        .dropdown-btn:hover,
        .sidebar .active {
            background: rgba(255, 255, 255, 0.2);
        }

        .sidebar a img, .sidebar-btn img {
            width: 20px;
            height: 20px;
            margin-right: -2px;
            vertical-align: middle;
        }

        .dropdown-content {
            display: none;
            flex-direction: column;
            background: #1565c0;
            margin-left: 35px;
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
        
        .top-navbar {
            height: 60px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 999;
            border-bottom: 1px solid #e0e0e0;
            box-shadow: none !important; 
            background-color: #fff;
        }
        .content {
            margin-left: 270px;
            padding: 20px;
            margin-top: 60px;
        }
        .sidebar.collapsed {
            margin-left: -250px;
            transition: margin 0.3s ease;
        }
        .content.shifted {
            margin-left: 20px;
            transition: margin 0.3s ease;
        }
        .top-navbar.shifted {
            left: 0 !important;
            transition: left 0.3s ease;
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
    <div class="sidebar" id="sidebar">
        <p style="text-align: center;"><img src="{{ asset('icons/Waterfall.svg') }}" width="20" height="20"> HALAMAN ADMIN</p>
        <hr>
        <a href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('icons/darhboard-light.svg') }}" width="20" height="20">Beranda</a>
        <button class="dropdown-btn">
            <img src="{{ asset('icons/Database_light.svg') }}" width="20" height="20"> Data Master ▼</button>
        <div class="dropdown-content">
            <a href="{{ route('data_kk') }}"> Data KK</a>
            <a href="{{ route('data_rt') }}"> Data RT</a>
            <a href="{{ route('data_rw') }}"> Data RW</a>
        </div>
        <button class="dropdown-btn">
            <img src="{{ asset('icons/Wallet_bold.svg') }}" width="20" height="20"><strong>Kelola Tagihan ▼</strong></button>
        <div class="dropdown-content">
            <a href="{{ route('tagihan.index') }}" class="active"> Tambah Tagihan</a>
            <a href="{{ route('konfirmasi.pembayaran') }}"> Konfirmasi Tagihan</a>
        </div>
        <a href="{{ route('laporan.iuran') }}">
            <img src="{{ asset('icons/File_dock_light.svg') }}" width="20" height="20">Laporan Iuran Sampah</a>
        <a href="{{ route('kelola.peran') }}">
            <img src="{{ asset('icons/Group_light.svg') }}" width="20" height="20"> Kelola Peran</a>
        <a href="{{ route('profil') }}">
            <img src="{{ asset('icons/User_cicrle_light.svg') }}" width="20" height="20">Profil</a>
        <form action="{{ route('logout.admin') }}" method="POST">
    @csrf
    <button type="submit" class="sidebar-link">
        <img src="{{ asset('icons/Sign_out_squre_light.svg') }}" width="20" height="20"> Keluar</button>
    </form>
    </div>

        <!-- Top Navbar -->
        <div class="top-navbar d-flex justify-content-between align-items-center px-4 py-2 bg-white shadow-sm">
    <div class="d-flex align-items-center">
    <img src="{{ asset('icons/menu.svg') }}" width="20" height="20" class="me-2" id="menu-toggle" style="cursor: pointer;">
    <img src="{{ asset('images/logo-nb.png') }}" alt="Logo" height="40" class="me-2">
        <div style="line-height: 1;">
            <span style="font-weight: 600; font-size: 14px;">Badan Usaha Milik Desa</span><br>
            <span style="font-size: 13px;">Spirit Mejabar</span>
        </div>
    </div>
    <div>
    <a href="{{ route('bukuManual') }}" class="btn btn-primary btn-sm me-3">
            Buku Manual
        </a>    
        <a href="{{ route('profil') }}">
            <img src="{{ asset('icons/User_cicrle_light.svg') }}" alt="Profil" width="32" height="32" style="border-radius: 50%; border: 2px solid #333; padding: 2px; cursor: pointer;">
        </a>
    </div>
</div>

    <div class="content">
        <div class="profile-container">
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
    document.getElementById("menu-toggle").addEventListener("click", function () {
        const sidebar = document.getElementById("sidebar");
        const content = document.querySelector(".content");
        const topNavbar = document.querySelector(".top-navbar");

        sidebar.classList.toggle("collapsed");
        content.classList.toggle("shifted");
        topNavbar.classList.toggle("shifted");
    });
    </script>
    
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