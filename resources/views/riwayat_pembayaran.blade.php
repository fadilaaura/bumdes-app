<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/logo-nb.png" type="image/x-icon">
    <title>Pembayaran Iuran Sampah - BUMDes Spirit Mejabar</title>
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
        }
        .sidebar a:hover, .sidebar-link:hover, .sidebar-link.active, .dropdown-btn:hover, .sidebar .active{
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
        .table {
            background: white;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .table th {
            background: #0d47a1;
            color: white;
        }

        .table tr:hover {
            background: #f1f1f1;
        }
        .badge-custom {
            padding: 0.5rem 0.75rem; 
            font-size: 0.85rem; 
            border-radius: 0.25rem;
            font-weight: 400; 
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h4>Badan Usaha Milik Desa</h4>
    <h5>Spirit Mejabar</h5>
    <hr>
    <a href="{{ route('dashboard.warga') }}">🏠 Beranda</a>
    <a href="{{ route('retribusi.sampah') }}">💷 Retribusi Sampah</a>
    <a href="{{ route('riwayat.pembayaran.warga') }}" class="active">📑 Riwayat Pembayaran</a>
    <a href="{{ route('profil_warga') }}">👤 Profil</a>
    <form action="{{ route('warga.logout') }}" method="POST" >
    @csrf
    <button type="submit" class="sidebar-link">🚪 Keluar</button>
</form></div>
<div class="content">
<div class="container">
    <h2>Riwayat Pembayaran</h2>
    @if(isset($kk))
    <div class="p-3 mb-2 border rounded" style="font-family: 'Poppins', sans-serif; width: 100%;">
        <h5 class="fw-bold">Data Warga:</h5>
        <div style="font-size: 14px; line-height: 1.5;">
            <table>
                <tr>
                    <td style="width: 120px;"><strong>NIK</strong></td>
                    <td>: {{ $kk->nik }}</td>
                </tr>
                <tr>
                    <td><strong>Nama Lengkap</strong></td>
                    <td>: {{ $kk->nama }}</td>
                </tr>
                <tr>
                    <td><strong>RT/RW</strong></td>
                    <td>: {{ $kk->RTRW }}</td>
                </tr>
                <tr>
                    <td><strong>Nomor HP</strong></td>
                    <td>: {{ $kk->noTelepon }}</td>
                </tr>
                <tr>
                    <td><strong>Peran</strong></td>
                    <td>: {{ $kk->peranUser }}</td>
                </tr>
            </table>
        </div>
    </div>
@else
    <p class="text-danger small" style="font-family: 'Poppins', sans-serif;">Data warga tidak ditemukan.</p>
@endif



    <table class="table table-bordered mt-2">
        <thead>
            <tr>
                <th>No.</th>
                <th>NIK</th>
                <th>Tanggal Jatuh Tempo</th>
                <th>Tanggal Pembayaran</th>
                <th>Nominal Iuran</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tagihan as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->nik }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggalJatuhTempo)->format('d-m-Y') }}</td>
                <td>
                    {{ $item->pembayaran ? \Carbon\Carbon::parse($item->pembayaran->created_at)->format('d-m-Y') : '-' }}
                </td>
                <td>Rp{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                <td>
                    @if($item->statusTagihan == 'Belum Dibayar')
                        <a href="{{ route('retribusi.sampah') }}" class="btn btn-danger btn-sm">Bayar Sekarang</a>
                    @elseif($item->statusTagihan == 'Menunggu Konfirmasi')
                        <span class="badge bg-primary text-white badge-custom">Menunggu Konfirmasi</span>
                    @elseif($item->statusTagihan == 'Lunas')
                        <span class="badge bg-success text-white badge-custom">Lunas</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
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