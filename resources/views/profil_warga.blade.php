<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/logo-nb.png" type="image/x-icon">
    <title>Profil Pengguna - BUMDes Spirit Mejabar</title>
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
            padding: 20px;
        }

        .sidebar a, .sidebar-link,
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
        }

        .sidebar a:hover, .sidebar-link:hover, .sidebar-link.active,
        .sidebar form:hover,
        .sidebar button:hover,
        .sidebar .active {
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
            width: calc(100% - 270px);
        }

        .profile-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 500px;
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

        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
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
    </style>
</head>

<body>
<div class="sidebar">
    <h4>Badan Usaha Milik Desa</h4>
    <h5>Spirit Mejabar</h5>
    <hr>
    <a href="{{ route('dashboard.warga') }}" >🏠 Beranda</a>
    <a href="{{ route('retribusi.sampah') }}">💷 Retribusi Sampah</a>
    <a href="{{ route('riwayat.pembayaran.warga') }}">📑 Riwayat Pembayaran</a>
    <a href="{{ route('profil_warga') }}" class="active">👤 Profil</a>
    <form action="{{ route('warga.logout') }}" method="POST" >
    @csrf
    <button type="submit" class="sidebar-link">🚪 Keluar</button>
</form></div>

    <div class="content">
        <div class="profile-container">
            <h2>Profil Pengguna</h2>
            <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" value="{{ $user->nama }}" required>

                <label for="email">email</label>
                <input type="text" id="email" name="email" value="{{ $user->email }}" required>

                <label for="pin">Password (kosongkan jika tidak diubah)</label>
                <input type="pin" id="pin" name="pin" placeholder="Masukkan pin baru">
                <div class="text-center mt-3">
                    <div class="border rounded" style="width: 150px; height: 150px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                        <img id="previewFoto" src="{{ $user->foto ? asset('storage/foto/' . $user->foto) : asset('default-avatar.png') }}" 
                            alt="Foto Profil" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                </div>
                <label for="foto">Foto Profil (Opsional)</label>
                <input type="file" id="foto" name="foto" onchange="previewImage(event)">

                <div class="button-container">
                    <button type="reset" class="btn-cancel">Batal</button>
                    <button type="submit" class="btn-save">Simpan</button>
                </div>
            </form>
        </div>
    </div>

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
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function () {
            var output = document.getElementById('previewFoto');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

</body>

</html>