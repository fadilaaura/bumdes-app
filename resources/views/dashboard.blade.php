<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/logo-nb.png" type="image/x-icon">
    <title>Dashboard Admin - BUMDes Spirit Mejabar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    <a href="{{ route('admin.dashboard') }}" class="active">
        <img src="{{ asset('icons/darhboard.png') }}" width="20" height="20"> Beranda</a>
    <button class="dropdown-btn">
        <img src="{{ asset('icons/Database_light.svg') }}" width="20" height="20">Data Master ▼</button>
    <div class="dropdown-content">
        <a href="{{ route('data_kk') }}">
            <img src="{{ asset('icons/Database_light.svg') }}" width="20" height="20">Data KK</a>
        <a href="{{ route('data_rt') }}">📋 Data RT</a>
        <a href="{{ route('data_rw') }}">📋 Data RW</a>
    </div>
    <button class="dropdown-btn">
        <img src="{{ asset('icons/Wallet_light.svg') }}" width="20" height="20">Kelola Tagihan ▼</button>
    <div class="dropdown-content">
        <a href="{{ route('tagihan.index') }}">📋 Tambah Tagihan</a>
        <a href="{{ route('konfirmasi.pembayaran') }}">📋 Konfirmasi Tagihan</a>
    </div>
    <a href="{{ route('laporan.iuran') }}">
        <img src="{{ asset('icons/File_dock_light.png') }}" width="20" height="20">Laporan Iuran Sampah</a>
    <a href="{{ route('kelola.peran') }}">
        <img src="{{ asset('icons/Group_light.png') }}" width="20" height="20"> Kelola Peran</a>
    <a href="{{ route('profil') }}">
        <img src="{{ asset('icons/User_cicrle_light.png') }}" width="20" height="20">Profil</a>
    <form action="{{ route('logout.admin') }}" method="POST">
    @csrf
    <button type="submit" class="sidebar-link">
        <img src="{{ asset('icons/Sign_out_squre_light.png') }}" width="20" height="20"> Keluar</button>
</form>
</div>


<div class="content">
    <h3>Dashboard Admin</h3>
    <div class="row mt-3">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5>Rp {{ number_format($data['total_iuran'], 0, ',', '.') }}</h5>
                    <p>Total Iuran Sampah</p>
                </div>
                <div class="card-footer">Total Iuran</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5>{{ $data['sudah_bayar'] }}</h5>
                    <p>Sudah Bayar</p>
                </div>
                <div class="card-footer">Sudah Bayar</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5>{{ $data['belum_bayar'] }}</h5>
                    <p>Belum Bayar</p>
                </div>
                <div class="card-footer">Belum Bayar</div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5>{{ $data['jumlah_kk'] }}</h5>
                    <p>Jumlah KK</p>
                </div>
                <div class="card-footer">Jumlah KK</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5>{{ $data['jumlah_rt'] }}</h5>
                    <p>Jumlah RT</p>
                </div>
                <div class="card-footer">Jumlah RT</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5>{{ $data['jumlah_rw'] }}</h5>
                    <p>Jumlah RW</p>
                </div>
                <div class="card-footer">Jumlah RW</div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <canvas id="chartIuran"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="chartTotal"></canvas>
        </div>
    </div>
</div>

<script>
    const ctx1 = document.getElementById('chartIuran').getContext('2d');
    const chartIuran = new Chart(ctx1, {
        type: 'doughnut',
        data: {
            labels: ['Sudah Bayar', 'Belum Bayar'],
            datasets: [{
                data: [{{ $data['sudah_bayar'] }}, {{ $data['belum_bayar'] }}],
                backgroundColor: ['#1565c0', '#90a4ae']
            }]
        }
    });

    const ctx2 = document.getElementById('chartTotal').getContext('2d');
    const chartTotal = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'],
            datasets: [
                {
                    label: 'Sudah Bayar',
                    data: [30, 50, 45, 60, 70, 90, 85, 75, 95, 80, 60, 50],
                    backgroundColor: '#1565c0'
                },
                {
                    label: 'Belum Bayar',
                    data: [70, 50, 55, 40, 30, 10, 15, 25, 5, 20, 40, 50],
                    backgroundColor: '#90a4ae'
                }
            ]
        }
    });
</script>

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


</body>
</html>
