<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BUMDes Spirit Mejabar</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: white;
            font-size: 14px;
        }
        .navbar {
            position: sticky;
            top: 0;
            width: 100%;
            z-index: 1000;
            background-color: white;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            font-size: 14px;
        }
        .navbar-nav .nav-link {
            font-size: 14px;
            font-weight: normal;
            color: black;
            transition: all 0.3s ease-in-out;
        }
        .navbar-nav .nav-link:hover {
            color: black;
        }

        .navbar-nav .nav-link.active {
            font-weight: bold; 
            color: black !important; 
        }

        .hero {
            display: flex;
            justify-content: center; 
            align-items: center;
        }
        .hero img {
            width: 80%; 
            max-width: 500px; 
            max-height: 350px; 
            object-fit: cover; 
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
        .hero img {
            width: 90%; 
            max-height: 200px;
        }
    }
        .section-container {
            background: #f8f9fa;
            padding: 40px;
            border-radius: 5px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            position: relative;
            font-size: 14px;
        }
        .card-custom {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
            position: relative;
            font-size: 14px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding-top: 30px;
        }
        .card-title {
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            background: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 7px;
            font-weight: bold;
            width: 25%;
            text-align: center;
        }
        .footer {
            background-color: #007bff;
            color: white;
            padding: 20px 0;
        }
        .card-custom ul li {
            font-size: 14px;
            text-align: left;
            width: 80%;
        }
        .card-custom p {
            width: 80%;
        }
        .footer p, .footer ul li {
            font-size: 14px;
        }

        h1 {
            font-size: 24px;
        }
        h2 {
            font-size: 20px;
        }
        h3 {
            font-size: 18px;
        }
        h4 {
            font-size: 16px;
        }
        h5, h6 {
            font-size: 15px;
        }
        .text-navbar {
            display: flex;
            flex-direction: column; 
            line-height: 0.75;
        }

        .small-text {
            font-size: 14px;
            font-weight: normal;
            color: black;
            font-weight: bold; 
            margin-bottom: -3px;
        }

        .big-text {
            font-size: 16px;
            font-weight: bold; 
            color: black;     
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand text-primary fw-bold d-flex align-items-center" href="{{ route('beranda') }}">
        <img src="{{ asset('images/logo-nb.png') }}" alt="Logo BUMDes" width="60" height="60" class="me-2">
        <div class="text-navbar">
            <span class="small-text">Badan Usaha Milik Desa</span><br>
            <span class="big-text">Spirit Mejabar</span>
            </div>
        </a>        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item px-3">
                <a class="nav-link small-text {{ request()->is('/') ? 'active' : '' }}" href="{{ route('beranda') }}">Beranda</a>
            </li>
            <li class="nav-item px-3">
                <a class="nav-link small-text {{ request()->is('layanan-bumdes') ? 'active' : '' }}" href="{{ route('layanan.bumdes') }}">Layanan BUMDes</a>
            </li>
            <li class="nav-item px-3">
                <a class="nav-link small-text {{ request()->is('berita') ? 'active' : '' }}" href="{{ route('berita') }}">Berita</a>
            </li>
            <li class="nav-item px-3">
                <a class="nav-link small-text {{ request()->is('tentang-kami') ? 'active' : '' }}" href="{{ route('tentang.kami') }}">Tentang Kami</a>
            </li>
            <li class="nav-item px-3">
                <a class="nav-link small-text {{ request()->is('promosi-umkm') ? 'active' : '' }}" href="{{ route('promosi.umkm') }}">Promosi UMKM</a>
            </li>
        </ul>
            <a class="btn btn-primary btn-sm text-white px-3 py-1" href="{{ route('login.admin') }}">Masuk</a> <!-- Mengecilkan tombol -->
        </div>
    </div>
</nav>

<div class="container mt-4">
        <div class="hero">
                <img src="{{ asset('images/fotobumdes.jpg') }}" class="img-fluid rounded shadow" alt="BUMDes Spirit Mejabar">
        </div>

    <div class="container mt-5 section-container">
    <div class="card-title">BUMDES Spirit Mejabar</div>
            <p>Badan Usaha Milik Desa (BUMDes) Spirit Mejabar adalah lembaga ekonomi yang dikelola oleh masyarakat Desa Mejasem Barat untuk meningkatkan kesejahteraan dan kemandirian desa. Sebagai wadah inovasi dan pengelolaan potensi lokal, BUMDes Spirit Mejabar menyediakan berbagai layanan yang mendukung kebutuhan warga, termasuk pengelolaan iuran sampah, usaha produktif, serta pengembangan ekonomi berbasis komunitas. Dengan semangat kebersamaan dan transparansi, BUMDes Spirit Mejabar terus berupaya memberikan kontribusi positif bagi desa, menciptakan layanan yang modern, efisien, dan ramah pengguna.</p>
    </div>

    <!-- Visi & Misi -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card-custom text-center">
                    <div class="card-title">Visi</div>
                    <p>Menjadi BUM Desa <strong>SPIRIT MEJABAR</strong> yang mempunyai kreativitas, unggul, dan profesional.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card-custom text-center">
                    <div class="card-title">Misi</div>
                    <ul class="text-start">
                        <li>Mewujudkan pemerintahan desa yang dekoratif, partisipatif, responsif, dan transparan.</li>
                        <li>Mengaktifkan serta memajukan BUM Desa dan UMKM sebagai pilar ekonomi desa.</li>
                        <li>Meningkatkan Pendapatan Asli Desa dan pengelolaan secara profesional.</li>
                        <li>Menggali potensi desa untuk didayagunakan.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Layanan BUMDes -->
    <h3 class="text-center mt-5 text-primary">Layanan BUMDes Spirit Mejabar</h3>
    <div class="row text-center">
        <div class="col-md-3">
            <div class="card-custom p-3 shadow">
                <img src="{{ asset('icons/wallet-fill.png') }}" width="50" alt="Sampah">
                <p>Pengelolaan</p>
                <p>Sampah</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-custom p-3 shadow">
                <img src="{{ asset('icons/people-fill.png') }}" width="50" alt="Pinjaman">
                <p>Simpan Pinjam</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-custom p-3 shadow">
                <img src="{{ asset('icons/police-badge.png') }}" width="50" alt="Samsat">
                <p>Samsat Budiman</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-custom p-3 shadow">
                <img src="{{ asset('icons/charity.png') }}" width="50" alt="PPOB">
                <p>PPOB (Payment Point Online Bank)</p>
            </div>
        </div>
    </div>

    <!-- Berita / Kegiatan -->
    <h3 class="text-center mt-5 text-primary">Berita & Kegiatan</h3>
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow p-3">
                <img src="{{ asset('images/rapat.jpg') }}" class="img-fluid rounded">
                <h5 class="mt-2">Rapat Koordinasi Kegiatan BUMDes</h5>
                <p>16 Januari 2025 - Rapat koordinasi kegiatan BUMDes Mejabar untuk tahun 2025 di Balai Desa.</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow p-3">
                <img src="{{ asset('images/studi_banding.jpg') }}" class="img-fluid rounded">
                <h5 class="mt-2">Kegiatan Studi Banding</h5>
                <p>4 Oktober 2024 - Studi banding BUMDes Spirit Mejabar ke BUMDes Karya Makmur Sikunco, Cilacap.</p>
            </div>
        </div>
    </div>
</div>
<body>

<!-- Footer Section -->
<footer class="bg-primary text-white mt-5 py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5>BUMDes Spirit Mejabar</h5>
                <p>Griya Mejasem Baru, Mejassem Bar., Kec. Kramat, Kabupaten Tegal, Jawa Tengah</p>
            </div>
            <div class="col-md-4">
                <h5>Menu</h5>
                <ul class="list-unstyled">
                    <li><a href=" " class="text-white">Beranda</a></li>
                    <li><a href=" " class="text-white">Layanan BUMDes</a></li>
                    <li><a href=" " class="text-white">Berita</a></li>
                    <li><a href=" " class="text-white">Tentang Kami</a></li>
                    <li><a href=" " class="text-white">Promosi UMKM</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Hubungi Kami</h5>
                <p>(021) 6510300</p>
                <p><a href="https://instagram.com" class="text-white">Instagram</a></p>
                <p><a href="https://facebook.com" class="text-white">Facebook</a></p>
                <p>Email: spiritmejabar@gmail.com</p>
            </div>
        </div>
    </div>
</footer>
