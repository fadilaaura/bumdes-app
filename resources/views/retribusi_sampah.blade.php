<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/logo-nb.png" type="image/x-icon">
    <title>Pembayaran Iuran Sampah - BUMDes Spirit Mejabar</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
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
            top: 60px;
            padding: 20px;
            font-size: 14px;
            transition: margin 0.3s ease; 
            margin-left: 0; 
        }
        .sidebar a, .sidebar-link, .sidebar button {
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
        .sidebar a:hover, .sidebar-link:hover, .sidebar-link.active, .sidebar button:hover, .sidebar .active {
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
            width: calc(100% - 0px);
        }
        .profile-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 100%;
            margin: auto;
        }
        h2 {
            color: #0d47a1;
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
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
        .main-inner {
    width: 100%;
}
        .top-navbar.shifted {
            left: 0 !important;
            transition: left 0.3s ease;
        }
        .button-container {
            display: flex;
            justify-content: center; 
            margin-top: 15px;
            gap: 10px;
        }
        .button-container button {
            width: 150px; 
            font-size: 14px; 
            padding: 6px;
        }
        button {
            padding: 8px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 200px;
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
            background-color: #0d47a1;
            width: 200px;
            color: #f4f6f9;
            border-color: #0d47a1;
        }
        .btn-sm:hover {
            color: #f4f6f9;
            border-color: #0d47a1;
        }
        .btn-primary.btn-sm{
            width: 200px;
            color: white;
        }
        .button-container-top {
            display: flex;
            margin-bottom: 15px;
        }
        .button-container-top button {
            margin-right: 10px;
        }
        .custom-btn {
            background-color: #0d47a1; 
            color: #f4f6f9;
            border: 1px solid #0d47a1; 
            padding: 0.25rem 0.5rem; 
            font-size: 0.875rem; 
            text-decoration: none;
            border-radius: 0.25rem;
            display: inline-block; 
        }

        .custom-btn:hover {
            color: #f4f6f9; 
            border-color: #0d47a1; 
            background-color: #1565c0;
        }

    </style>
</head>
<body>

<div class="sidebar" id="sidebar">
    <p style="text-align: center;"><img src="{{ asset('icons/Waterfall.svg') }}" width="20" height="20"> HALAMAN WARGA</p>
    <hr>
    <a href="{{ route('dashboard.warga') }}">
        <img src="{{ asset('icons/darhboard-light.svg') }}" width="20" height="20">Beranda</a>
    <a href="{{ route('retribusi.sampah') }}"class="active">
        <img src="{{ asset('icons/Wallet_bold.svg') }}" width="20" height="20"><strong>Retribusi Sampah</strong></a>
    <a href="{{ route('riwayat.pembayaran.warga') }}" >
        <img src="{{ asset('icons/File_dock_light.svg') }}" width="20" height="20">Riwayat Pembayaran</a>
    <a href="{{ route('profil_warga') }}">
        <img src="{{ asset('icons/User_cicrle_light.svg') }}" width="20" height="20">Profil</a>
    <form action="{{ route('warga.logout') }}" method="POST" >
    @csrf
    <button type="submit" class="sidebar-link">
        <img src="{{ asset('icons/Sign_out_squre_light.svg') }}" width="20" height="20">Keluar</button>
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
        <a href="{{ route('bukuManual.warga') }}" class="custom-btn me-3">
            Buku Manual
        </a>    
        <a href="{{ route('profil_warga') }}">
            <img src="{{ asset('icons/User_cicrle_light.svg') }}" alt="Profil" width="32" height="32" style="border-radius: 50%; border: 2px solid #333; padding: 2px; cursor: pointer;">
        </a>
    </div>
</div>

    <div class="content">
    <div class="main-inner">
    <div class="button-container-top">
            <button onclick="window.location.href='{{ route('kepala_keluarga.create') }}'" class="btn btn-primary btn-sm">
                Tata Cara Pembayaran
            </button>
            <button class="btn btn-success btn-sm" onclick="window.location.href='{{ route('export.kepala.keluarga') }}'">
                Lihat QR Code
            </button>
        </div>

        <div class="profile-container">
            <h2>Pembayaran Iuran Sampah</h2>

            <label for="nik">Masukkan NIK Untuk Cek Tagihan Anda!</label>
            <input type="text" id="nik" name="nik" class="form-control" value="{{ old('nik') }}" required>
            <button type="button" id="cekTagihan" class="btn btn-primary btn-sm mt-2">Cek Tagihan</button>

            <hr> <!-- Garis pemisah antara input dan hasil tagihan -->

        <div id="infoTagihan">
            <p class="text-muted">Silakan masukkan NIK Anda untuk melihat tagihan.</p>
        </div>

        <form id="formPembayaran" action="{{ route('retribusi.sampah.store') }}" method="POST" enctype="multipart/form-data" style="display: none;">
            @csrf
            <input type="hidden" name="nama" id="nama" value="{{ old('nama') }}">
            <input type="hidden" name="nomor_hp" id="nomor_hp" value="{{ old('nomor_hp') }}">
            <input type="hidden" name="rt_rw" id="rt_rw" value="{{ old('rt_rw') }}">
            <input type="hidden" name="nik" id="nik_pembayaran" value="{{ old('nik') }}">
            <input type="hidden" name="tanggalJatuhTempo" id="tanggalJatuhTempo" value="{{ old('tanggalJatuhTempo') }}">

            <label for="jumlah">Jumlah</label>
            <input type="number" id="jumlah" name="jumlah" class="form-control" required>

            <label for="buktiPembayaran">Upload Bukti Pembayaran</label>
            <input type="file" id="buktiPembayaran" name="buktiPembayaran" class="form-control" required>

            <div class="button-container">
                <button type="reset" class="btn-cancel">Batal</button>
                <button type="submit" class="btn-save">Bayar</button>
            </div>
    </form>

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
        document.getElementById('cekTagihan').addEventListener('click', function () {
    var nik = document.getElementById('nik').value.trim();

    if (!nik) {
        alert("Silakan masukkan NIK terlebih dahulu.");
        return;
    }

    fetch('/cek-tagihan/' + nik)
        .then(response => response.json())
        .then(data => {
            console.log(data); // Tambahkan ini untuk melihat isi response

            if (data.success) {
                document.getElementById('infoTagihan').innerHTML = `
                    <p><strong>Nama:</strong> ${data.tagihan.nama}</p>
                    <p><strong>NIK:</strong> ${data.tagihan.nik}</p>
                    <p><strong>RT/RW:</strong> ${data.tagihan.rt_rw}</p>
                    <p><strong>Nomor HP:</strong> ${data.tagihan.nomor_hp}</p>
                    <p><strong>Jumlah Tagihan:</strong> Rp ${data.tagihan.jumlah}</p>
                    <p><strong>Tanggal Jatuh Tempo:</strong> ${data.tagihan.tanggalJatuhTempo}</p>
                `;

                document.getElementById('nama').value = data.tagihan.nama;
                document.getElementById('nik_pembayaran').value = data.tagihan.nik;
                document.getElementById('rt_rw').value = data.tagihan.rt_rw;
                document.getElementById('nomor_hp').value = data.tagihan.nomor_hp;
                document.getElementById('jumlah').value = data.tagihan.jumlah;
                document.getElementById('tanggalJatuhTempo').value = data.tagihan.tanggalJatuhTempo;

                document.getElementById('formPembayaran').style.display = 'block';
            } else {
                document.getElementById('infoTagihan').innerHTML = `<p style="color:red;">${data.message}</p>`;
                document.getElementById('formPembayaran').style.display = 'none';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('infoTagihan').innerHTML = '<p style="color:red;">Terjadi kesalahan, coba lagi.</p>';
        });
});

    </script>
</body>
</html>
