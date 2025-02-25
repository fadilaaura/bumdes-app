<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data RT - Dashboard Admin BUMDes</title>
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
        .sidebar a, .dropdown-btn {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            margin-bottom: 2px;
            border-radius: 5px;
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }
        .sidebar a:hover, .dropdown-btn:hover, .sidebar .active {
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
        <a href="{{ route('data_rt') }}" class="active">📋 Data RT</a>
        <a href="{{ route('data_rw') }}">📋 Data RW</a>
    </div>
    <button class="dropdown-btn">💰 Kelola Tagihan ▼</button>
    <div class="dropdown-content">
        <a href="{{ route('tambah_tagihan') }}">📋 Tambah Tagihan</a>
        <a href="{{ route('konfirmasi_tagihan') }}">📋 Konfirmasi Tagihan</a>
    </div>
    <a href="{{ route('laporan.iuran') }}">📊 Laporan Iuran Sampah</a>
    <a href="{{ route('kelola.peran') }}">🔑 Kelola Peran</a>
    <a href="{{ route('profil') }}">👤 Profil</a>
    <a href="{{ route('login.admin') }}">🚪 Keluar</a>
</div>

<div class="content">
    <h2 class="mb-4">Data RT</h2>
    
    <div class="mb-3">
        <a href="{{ route('rt.create') }}" class="btn btn-primary">Tambah Data</a>
        <a href="#" class="btn btn-secondary">Export Data</a>
    </div>

    <table class="table table-bordered">
        <thead class="table-primary">
            <tr>
                <th>No.</th>
                <th>RT/RW</th>
                <th>Jumlah KK</th>
                <th>Ketua RT</th>
                <th>Nominal Iuran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $data = [
                    ['rt_rw' => '001/01', 'jumlah_kk' => 77, 'ketua_rt' => 'Subadri', 'nominal' => 'Rp1.540.000'],
                    ['rt_rw' => '002/01', 'jumlah_kk' => 99, 'ketua_rt' => 'Heri Susanto', 'nominal' => 'Rp1.980.000'],
                    ['rt_rw' => '003/01', 'jumlah_kk' => 117, 'ketua_rt' => 'Sutarno', 'nominal' => 'Rp2.340.000'],
                    ['rt_rw' => '004/01', 'jumlah_kk' => 165, 'ketua_rt' => 'Endang', 'nominal' => 'Rp3.300.000'],
                    ['rt_rw' => '005/01', 'jumlah_kk' => 113, 'ketua_rt' => 'Luis', 'nominal' => 'Rp2.260.000'],
                    ['rt_rw' => '006/01', 'jumlah_kk' => 99, 'ketua_rt' => 'Heri Susanto', 'nominal' => 'Rp1.980.000'],
                    ['rt_rw' => '007/01', 'jumlah_kk' => 117, 'ketua_rt' => 'Sutarno', 'nominal' => 'Rp2.340.000'],
                    ['rt_rw' => '008/01', 'jumlah_kk' => 165, 'ketua_rt' => 'Endang', 'nominal' => 'Rp3.300.000'],
                    ['rt_rw' => '009/01', 'jumlah_kk' => 113, 'ketua_rt' => 'Luis', 'nominal' => 'Rp2.260.000'],
                ];
            @endphp
            
            @foreach ($data as $index => $rt)
                <tr class="{{ $index % 2 == 0 ? 'table-light' : 'table-info' }}">
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $rt['rt_rw'] }}</td>
                    <td>{{ $rt['jumlah_kk'] }}</td>
                    <td>{{ $rt['ketua_rt'] }}</td>
                    <td>{{ $rt['nominal'] }}</td>
                    <td>
                        <a href="#" class="btn btn-success">Ubah</a>
                        <a href="#" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

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
