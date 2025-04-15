<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="shortcut icon" href="images/logo-nb.png" type="image/x-icon">
    <title>Kelola Peran - BUMDes Spirit Mejabar</title>
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
            display: flex;
            align-items: center; 
            gap: 10px;
            font-size: 14px;
        }

        .sidebar a:hover, .sidebar-link:hover, .sidebar-link.active,
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

        /* Konten Utama */
        .content {
            margin-left: 270px;
            padding: 20px;
            width: calc(100% - 270px);
        }

        h2 {
            color: #0d47a1;
            background: #e3f2fd;
            padding: 15px;
            border-radius: 5px;
        }

        /* Tabel */
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
    transition: margin-left 0.3s ease, width 0.3s ease;
}

.content.shifted {
    margin-left: 0;
    width: 100%;
}

        .sidebar.collapsed {
            margin-left: -250px;
            transition: margin 0.3s ease;
        }
        .top-navbar.shifted {
            left: 0 !important;
            transition: left 0.3s ease;
        }

        .content.shifted table {
            width: 100% !important;
            table-layout: auto;
        }

        .btn-edit {
            background: #198553;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .btn-delete {
            background: #DC3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .btn-edit:hover {
            background: #157347;
        }

        .btn-delete:hover {
            background: #BB2D3B;
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
        <a href="{{ route('laporan.iuran') }}">
            <img src="{{ asset('icons/File_dock_light.svg') }}" width="20" height="20">Laporan Iuran Sampah</a>
        <a href="{{ route('kelola.peran') }}" class="active">
            <img src="{{ asset('icons/Group_bold.svg') }}" width="20" height="20"><strong> Kelola Peran</strong></a>
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

    <!-- Konten Utama -->
    <div class="content">
    <form action="{{ route('kelola.peran') }}" method="GET" class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">

    <div class="d-flex align-items-center">
        <label for="perPage" class="me-2 mb-0">Tampilkan:</label>
        <select name="perPage" id="perPage" class="form-select form-select-sm" onchange="this.form.submit()">
            <option value="10" {{ request('perPage', 10) == 10 ? 'selected' : '' }}>10</option>
            <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20</option>
            <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
        </select>
    </div>

    <div class="input-group input-group-sm" style="max-width: 225px;">
        <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari Nama Pengurus" value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary btn-sm">Cari</button>
    </div>
</form>


        <div class ="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>Nomor HP</th>
                    <th>Peran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($warga as $index => $w)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $w->nama }}</td>
                    <td>{{ $w->nik }}</td>
                    <td>{{ $w->noTelepon }}</td>
                    <td>{{ $w->peranUser }}</td>
                    <td>
                    <button class="btn btn-success btn-sm edit-kk-btn"
                    data-id="{{ $w->idKK }}"
                            data-nik="{{ $w->nik }}"
                            data-pin="{{ $w->pin }}"
                            data-email="{{ $w->email }}"
                            data-nama="{{ $w->nama }}"
                            data-alamat="{{ $w->alamat }}"
                            data-notelepon="{{ $w->noTelepon }}"
                            data-peranuser="{{ $w->peranUser }}"
                            data-rtrw="{{ $w->RTRW }}"
                            data-idrt="{{ $w->idRT }}"
                            data-idrw="{{ $w->idRW }}">
    Ubah
</button>

<form action="{{ route('peran.destroy', $w->idKK) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus peran ini?')">
        Hapus
    </button>
</form>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4 d-flex justify-content-center align-items-center">
            <nav aria-label="Page navigation">
                <ul class="pagination pagination-sm">
                    {{ $warga->links('pagination::bootstrap-4') }}
                </ul>
            </nav>
        </div>

        <form id="perPageForm" action="{{ route('kelola.peran') }}" method="GET" style="display: none;">
            <input type="hidden" name="search" value="{{ request('search') }}">
            <input type="hidden" name="perPage" id="perPageInput">
        </form>
        </div>
    </div>


<!-- Modal Edit KK -->
<div class="modal fade" id="editKKModal" tabindex="-1" aria-labelledby="editKKModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKKModalLabel">Edit Data Peran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editKKForm" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="edit_nik" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="edit_nik" name="nik" required>
                    </div>

                    <div class="mb-3">
                            <label for="edit_pin" class="form-label">PIN</label>
                            <input type="text" class="form-control" id="edit_pin" name="pin" disabled>
                        </div>

                    <div class="mb-3">
                        <label for="edit_email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="edit_email" name="email" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="edit_nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="edit_nama" name="nama" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="edit_alamat" name="alamat" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="edit_noTelepon" class="form-label">No. Telepon</label>
                        <input type="text" class="form-control" id="edit_noTelepon" name="noTelepon" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_peranUser" class="form-label">Peran User</label>
                        <select class="form-control" id="edit_peranUser" name="peranUser" required>
                            <option value="">-- Pilih Peran --</option>
                            <option value="Warga">Warga</option>
                            <option value="Pengurus RW">Pengurus RW</option>
                            <option value="Pengurus RT">Pengurus RT</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_rtrw" class="form-label">RT/RW</label>
                        <input type="text" class="form-control" id="edit_rtrw" name="RTRW" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="edit_idRW" class="form-label">ID RW</label>
                        <input type="text" class="form-control" id="edit_idRW" name="idRW" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="edit_idRT" class="form-label">ID RT</label>
                        <input type="text" class="form-control" id="edit_idRT" name="idRT" disabled>
                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary flex-fill mx-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary flex-fill mx-2">Simpan</button>
                    </div>
                </form>
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
        document.addEventListener("DOMContentLoaded", function() {
            let dropdownButtons = document.querySelectorAll(".dropdown-btn");

            dropdownButtons.forEach(function(btn) {
                let dropdownContent = btn.nextElementSibling;
                let menuKey = btn.innerText.trim(); // Nama unik berdasarkan teks tombol

                // Cek jika sebelumnya terbuka
                if (sessionStorage.getItem(menuKey) === "open") {
                    dropdownContent.style.display = "block";
                }

                btn.addEventListener("click", function() {
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

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".edit-kk-btn").forEach(button => {
        button.addEventListener("click", function() {
            // Isi form dengan data dari tombol
            document.getElementById("edit_nik").value = this.dataset.nik;
            document.getElementById("edit_pin").value = this.dataset.pin;
            document.getElementById("edit_email").value = this.dataset.email;
            document.getElementById("edit_nama").value = this.dataset.nama;
            document.getElementById("edit_alamat").value = this.dataset.alamat;
            document.getElementById("edit_noTelepon").value = this.dataset.notelepon;
            document.getElementById("edit_peranUser").value = this.dataset.peranuser;
            document.getElementById("edit_rtrw").value = this.dataset.rtrw;
            document.getElementById("edit_idRT").value = this.dataset.idrt;
            document.getElementById("edit_idRW").value = this.dataset.idrw;

            // Set action form dengan route yang benar
            let idKK = this.dataset.id;
            document.getElementById("editKKForm").action = `/kelola-peran/${idKK}/update`;

            // Tampilkan modal
            var editKKModal = new bootstrap.Modal(document.getElementById("editKKModal"));
            editKKModal.show();
        });
    });
    document.getElementById("editKKForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Mencegah reload halaman

    const form = this;
    const formData = new FormData(form);

    // Tambahkan _method: PUT ke formData
    formData.append("_method", "PUT");

    fetch(form.action, {
        method: "POST", // Tetap gunakan POST
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
            "X-Requested-With": "XMLHttpRequest",
            "Accept": "application/json"
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        location.reload(); // Reload halaman setelah sukses
    })
    .catch(error => console.error("Error:", error));
});
});



        // Fungsi untuk hapus data dengan konfirmasi
        function hapusData(idKK) {
            if (confirm('Yakin ingin menghapus data ini?')) {
                fetch(`/kepala-keluarga/${idKK}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.message);
                        // Menghapus baris dari tabel
                        let row = document.querySelector(`[data-id="${idKK}"]`);
                        if (row) row.remove();
                    })
                    .catch(error => console.error('Error:', error));
            }
        }
</script>

<script>
        document.getElementById('perPage').addEventListener('change', function() {
            document.getElementById('perPageInput').value = this.value;
            document.getElementById('perPageForm').submit();
        });
    </script>
    
</body>

</html>