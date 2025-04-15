<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="shortcut icon" href="images/logo-nb.png" type="image/x-icon">
    <title>Buku Panduan Penggunaan Warga - Dashboard Admin BUMDes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
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
        .sidebar a, .sidebar-link, .dropdown-btn {
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
        .sidebar a:hover, .sidebar-link:hover, .sidebar-link.active, .dropdown-btn:hover, .sidebar .active{
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
        .chart-card {
    background: #ffffff;
    border-radius: 16px;
    box-shadow: none;
    padding: 30px 20px;
}
canvas#chartIuran {
    margin-top: -10px;
    height: 300px !important;
    width: 300px !important;
    display: block;
    margin-left: auto;
    margin-right: auto;
}

    .chart-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding-top: 5px;
        padding-bottom: 0;
        margin-top: -10px;
    }

    .chart-wrapper canvas {
        margin-top: -20px;
    }
    .legend-custom {
        margin-top: 0; 
    }
    .btn-primary{
        background-color: #0d47a1; 
        color: #f4f6f9;
        border-color: #0d47a1;
    }
    
        .btn-sm:hover {
        color: #f4f6f9; 
        border-color: #0d47a1;
    }
    
        .btn-primary.btn-sm{
        color: white;
    }
    </style>
</head>

<body>
    <div class="sidebar" id="sidebar">
    <p style="text-align: center;"><img src="{{ asset('icons/Waterfall.svg') }}" width="20" height="20"> HALAMAN WARGA</p>
    <hr>
    <a href="{{ route('dashboard.warga') }}">
        <img src="{{ asset('icons/darhboard-light.svg') }}" width="20" height="20">Beranda</a>
    <a href="{{ route('retribusi.sampah') }}">
        <img src="{{ asset('icons/Wallet_light.svg') }}" width="20" height="20">Retribusi Sampah</a>
    <a href="{{ route('riwayat.pembayaran.warga') }}">
        <img src="{{ asset('icons/File_dock_light.svg') }}" width="20" height="20">Riwayat Pembayaran</a>
    <a href="{{ route('profil_warga') }}">
        <img src="{{ asset('icons/User_cicrle_light.svg') }}" width="20" height="20">Profil</a>
    <form action="{{ route('warga.logout') }}" method="POST" >
    @csrf
    <button type="submit" class="sidebar-link">
        <img src="{{ asset('icons/Sign_out_squre_light.svg') }}" width="20" height="20">Keluar
    </button>
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
        <a href="{{ route('bukuManual.warga') }}" class="btn btn-primary btn-sm me-3">
            Buku Manual
        </a>    
        <a href="{{ route('profil_warga') }}">
            <img src="{{ asset('icons/User_cicrle_light.svg') }}" alt="Profil" width="32" height="32" style="border-radius: 50%; border: 2px solid #333; padding: 2px; cursor: pointer;">
        </a>
    </div>
</div>

    <div class="content">
    <div class="pdf-viewer-container">
        <h3>PDF Buku Manual</h3>
        <p>Di bawah ini adalah buku manual pengguna dalam format PDF. Anda dapat membaca langsung atau mengunduh file PDF tersebut.</p>
        <embed src="{{ asset('pdf/manual-buku-warga.pdf') }}" type="application/pdf" width="100%" height="600px">
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