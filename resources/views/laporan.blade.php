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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
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
            top: 60px;
            padding: 20px;
            font-size: 14px;
            transition: margin 0.3s ease; 
            margin-left: 0; 
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
            display: flex;
            align-items: center; 
            gap: 10px;
            font-size: 14px;
        }

        .sidebar a:hover,
        .sidebar button:hover,
        .sidebar .active {
            background: rgba(255, 255, 255, 0.2);
        }

        .sidebar a img, .sidebar-btn img {
            width: 20px;
            height: 20px;
            margin-right: -2px;
            vertical-align: middle;
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
            width: calc(100% - 270px);
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
        .top-navbar.shifted {
            left: 0 !important;
            transition: left 0.3s ease;
        }
        .content.shifted {
            margin-left: 0 !important;
            width: 100% !important;
            transition: margin 0.3s ease;
            padding-left: 20px;
            padding-right: 20px;
        }    
        .content.shifted form {
            max-width: 1000px;
            margin: 0 auto;
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
            <img src="{{ asset('icons/Wallet_light.svg') }}" width="20" height="20">Kelola Tagihan ▼</button>
        <div class="dropdown-content">
            <a href="{{ route('tagihan.index') }}"> Tambah Tagihan</a>
            <a href="{{ route('konfirmasi.pembayaran') }}"> Konfirmasi Tagihan</a>
        </div>
        <a href="{{ route('laporan.iuran') }}" class="active">
            <img src="{{ asset('icons/File_dock_bold.svg') }}" width="20" height="20">Laporan Iuran Sampah</a>
        <a href="{{ route('kelola.peran') }}">
            <img src="{{ asset('icons/Group_light.svg') }}" width="20" height="20"> Kelola Peran</a>
        <a href="{{ route('profil') }}">
            <img src="{{ asset('icons/User_cicrle_light.svg') }}" width="20" height="20">Profil</a>
        <a href="{{ route('logout.admin') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <img src="{{ asset('icons/Sign_out_squre_light.svg') }}" width="20" height="20"> Keluar
        </a>
        <form id="logout-form" action="{{ route('logout.admin') }}" method="POST" style="display: none;">
            @csrf
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
    <form action="{{ route('laporan.export') }}" method="POST">
    @csrf
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
    <select id="pilihan-data" name="pilihan_data" class="form-control">
        <option value="">Pilih Data</option>
        <option value="kk">Semua</option>
        <option value="rw">RW</option>
        <option value="rt">RT</option>
    </select>
    <label for="rw">RW:</label>
    <select id="rw" name="rw" class="form-control">
        <option value="">Pilih RW</option>
        <option value="01">RW 01</option>
        <option value="02">RW 02</option>
        <option value="03">RW 03</option>
        <option value="04">RW 04</option>
        <option value="05">RW 05</option>
        <option value="06">RW 06</option>
        <option value="07">RW 07</option>
        <option value="08">RW 08</option>
        <option value="09">RW 09</option>
        <option value="10">RW 10</option>
    </select>
    <label for="rt">RT:</label>
    <select id="rt" name="rt" class="form-control">
        <option value="">Pilih RT</option>
        <option value="001">RT 001</option>
        <option value="002">RT 002</option>
    </select>
    <div class="text-center">
    <button type="submit" class="btn btn-success mt-3 px-3">Cetak Laporan</button>
</div></form>


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

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const pilihanData = document.getElementById("pilihan-data");
        const rtSelect = document.getElementById("rt");
        const rwSelect = document.getElementById("rw");

        function handleDropdownState() {
            const value = pilihanData.value;

            if (value === "kk") {
                rtSelect.disabled = true;
                rwSelect.disabled = true;
            } else if (value === "rw") {
                rwSelect.disabled = false;
                rtSelect.disabled = true;
            } else if (value === "rt") {
                rwSelect.disabled = false;
                rtSelect.disabled = false;
            } else {
                // default jika kosong
                rtSelect.disabled = true;
                rwSelect.disabled = true;
            }
        }

        // Jalankan saat halaman dimuat
        handleDropdownState();

        // Jalankan ketika dropdown pilihan data berubah
        pilihanData.addEventListener("change", handleDropdownState);
    });
</script>



</body>

</html>