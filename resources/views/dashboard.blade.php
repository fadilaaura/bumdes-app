<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/logo-nb.png" type="image/x-icon">
    <title>Dashboard Admin - BUMDes Spirit Mejabar</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
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
    margin-top: -10px; /* angkat keseluruhan */
}

.chart-wrapper canvas {
    margin-top: -20px; /* geser pie chart lebih naik */
}
.legend-custom {
    margin-top: 0; /* Tambahan kalau mau atur lagi jarak legend */
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
    <a href="{{ route('admin.dashboard') }}" class="active">
        <img src="{{ asset('icons/darhboard.svg') }}" width="20" height="20"> <strong>Beranda</strong></a>
    <button class="dropdown-btn">
        <img src="{{ asset('icons/Database_light.svg') }}" width="20" height="20">Data Master ▼</button>
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
        <div class="chart-card p-4 text-center">
            <canvas id="chartIuran" width="130" height="130"></canvas>
            <div id="legendIuran" class="legend-custom"></div>
        </div>
    </div>
        <div class="col-md-6">
            <div class="chart-card p-4 text-center">
                <canvas id="chartTotal"></canvas>
            </div>
        </div>
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
const ctx1 = document.getElementById('chartIuran').getContext('2d');
const chartIuran = new Chart(ctx1, {
    type: 'doughnut',
    data: {
        labels: ['Sudah Bayar', 'Belum Bayar'],
        datasets: [{
            data: [{{ $data['sudah_bayar'] }}, {{ $data['belum_bayar'] }}],
            backgroundColor: ['#3b5bdb', '#cfdafe'],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        cutout: '70%',
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    usePointStyle: true,
                    pointStyle: 'circle',
                    color: '#000',
                    font: {
                        family: 'Poppins',
                        size: 14
                    }
                }
            },
            title: {
                display: true,
                text: 'Grafik Data Iuran Sampah',
                font: {
                    family: 'Poppins',
                    size: 16,
                    weight: '600'
                },
                color: '#111',
                padding: {
                    top: 0,
                    bottom: 10
                }
            },
            tooltip: {
                callbacks: {
                    label: context => {
                        const label = context.label || '';
                        const value = context.parsed;
                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                        const percent = ((value / total) * 100).toFixed(2);
                        return `${label}: ${value} KK (${percent}%)`;
                    }
                },
                backgroundColor: '#1c204b',
                titleFont: { family: 'Poppins', weight: 'bold' },
                bodyFont: { family: 'Poppins' },
                padding: 10
            }
        }
    }
});
</script>


<script>
    const ctx2 = document.getElementById('chartTotal').getContext('2d');
const chartTotal = new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'],
        datasets: [
            {
                label: 'Sudah Bayar',
                data: [30, 50, 45, 60, 70, 90, 85, 75, 95, 80, 60, 50],
                backgroundColor: '#3b5bdb',
                borderRadius: 6,
                barThickness: 14
            },
            {
                label: 'Belum Bayar',
                data: [70, 50, 55, 40, 30, 10, 15, 25, 5, 20, 40, 50],
                backgroundColor: '#dcdde1',
                borderRadius: 6,
                barThickness: 14
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    usePointStyle: true,
                    pointStyle: 'circle',
                    font: {
                        family: 'Poppins',
                        size: 14
                    },
                    color: '#000'
                }
            },
            title: {
                display: true,
                text: 'Grafik Total Iuran Sampah',
                font: {
                    family: 'Poppins',
                    size: 16,
                    weight: 'bold'
                },
                color: '#111',
                padding: {
                    bottom: 5
                }
            }
        },
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Tahun 2023',
                    font: {
                        family: 'Poppins',
                        weight: 'bold'
                    }
                },
                ticks: {
                    font: {
                        family: 'Poppins'
                    }
                },
                grid: {
                    display: false
                }
            },
            y: {
                display: false
            }
        }
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
