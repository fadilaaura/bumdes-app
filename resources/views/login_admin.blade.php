<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/logo-nb.png" type="image/x-icon">
    <title>Login Admin - BUMDes Spirit Mejabar</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
body {
            font-family: 'Poppins', sans-serif;
            background: url('/images/f.jpg') no-repeat center center;
            background-size: cover;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding-top: 70px;
        }
        
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            background-color: white;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            font-size: 14px;
            padding: 10px 0;
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

        .login-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            padding: 25px;
            position: center;
            left: 50%;
            margin-top: -40px;
        }

        .form-control {
            height: 45px;
            font-size: 16px;
        }

        .btn-primary {
            width: 100%;
            font-size: 18px;
        }

        .text-link {
            text-decoration: none;
            color: #007bff;
        }

        .text-link:hover {
            text-decoration: underline;
        }

        .notification {
            background: #0056b3;
            color: white;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 15px;
            font-size: 14px;
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
            font-weight: bold; 
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
        .navbar .btn-primary {
            width: auto;
            white-space: nowrap; 
            padding: 4px 15px;
            font-size: 14px;
        }
        .login-container {
            font-size: 14px;
        }
        .login-container h3 {
            font-size: 16px;
        }
        .login-container label {
            font-size: 14px; 
        }
        .login-container .form-control {
            font-size: 14px;
        }
        .login-container .btn-primary {
            font-size: 14px;
        }
        .footer {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 10px 0;
            font-size: 14px;
            
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
        <a class="btn btn-primary btn-sm text-white d-inline-block" href="{{ route('login.admin') }}">Masuk</a>

    </div>
    </div>
</nav>
    <div class="login-container">
        @if (session('success'))
            <div class="alert alert-success text-center" style="margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <h3 class="text-center mb-3"><strong>MASUK</strong></h3>
        <form action="{{ route('login.admin') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Masukkan Email Anda" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan Password Anda" required>
            </div>
            <div class="d-flex justify-content-between">
                <a href="#" class="text-link">Lupa Password?</a>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Masuk</button>
        </form>
        <div class="text-center mt-3">
            <small>Bukan Pengurus? <a href="{{ route('warga.login') }}" class="text-link"><strong>Masuk Sebagai Warga</strong></a></small>
        </div>
    </div>

</body>
<!-- Footer -->
<footer class="footer bg-primary text-white text-center py-3 mt-5">
    <div class="container">
        <p class="mb-1">© 2025 BUMDes Spirit Mejabar. Semua Hak Dilindungi.</p>
    </div>
</footer>

</html>