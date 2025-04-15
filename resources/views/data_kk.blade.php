<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="images/logo-nb.png" type="image/x-icon">
    <title>Data KK - Dashboard Admin BUMDes</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
            font-size: 14px;
            transition: margin 0.3s ease; 
            margin-left: 0; 
        }

        .sidebar a, .sidebar-link,
        .dropdown-btn {
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
        .dropdown-btn:hover,
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

        .content {
            margin-left: 270px;
            padding: 20px;
        }

        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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

        .table tr:hover {
            background: #f1f1f1;
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
            <img src="{{ asset('icons/Database_bold.svg') }}" width="20" height="20"> <strong>Data Master ▼</strong></button>
        <div class="dropdown-content">
            <a href="{{ route('data_kk') }}" class="active"> Data KK</a>
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
        <div class="mb-3 d-flex justify-content-between align-items-center">
    <div>
        <button onclick="window.location.href='{{ route('kepala_keluarga.create') }}'" class="btn btn-primary btn-sm">
            Tambah Data
        </button>
        <button class="btn btn-success btn-sm" onclick="window.location.href='{{ route('export.kepala.keluarga') }}'">
            Export Data
        </button>
    </div>
    <form action="{{ route('data_kk') }}" method="GET" class="d-flex align-items-center">
        <div class="input-group input-group-sm">
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari Nama atau NIK">
            <button type="submit" class="btn btn-primary btn-sm">
                Cari
            </button>
        </div>
    </form>
</div>

<div class="d-flex align-items-center mt-2">
    <label for="perPage" class="me-2">Tampilkan:</label>
    <select name="perPage" id="perPage" class="form-select form-select-sm" style="width: 65px;" onchange="this.form.submit()">
        <option value="10" {{ request('perPage', 10) == 10 ? 'selected' : '' }}>10</option>
        <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20</option>
        <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
    </select>
</div>

    <table class="table table-bordered mt-2">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>Nomor HP</th>
                    <th>RT/RW</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kepala_keluarga as $kk)
                <tr data-id="{{ $kk->idKK }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $kk->nama }}</td>
                    <td>{{ $kk->nik }}</td>
                    <td>{{ $kk->noTelepon }}</td>
                    <td>{{ $kk->RTRW }}</td>
                    <td>
                        <!-- Tombol Edit -->
                        <button class="btn btn-success btn-sm edit-kk-btn"
                            data-id="{{ $kk->idKK }}"
                            data-nik="{{ $kk->nik }}"
                            data-pin="{{ $kk->pin }}"
                            data-email="{{ $kk->email }}"
                            data-nama="{{ $kk->nama }}"
                            data-alamat="{{ $kk->alamat }}"
                            data-notelepon="{{ $kk->noTelepon }}"
                            data-peranuser="{{ $kk->peranUser }}"
                            data-rtrw="{{ $kk->RTRW }}"
                            data-idrt="{{ $kk->idRT }}"
                            data-idrw="{{ $kk->idRW }}">
                            Ubah
                        </button>

                        <!-- Tombol Hapus -->
                        <form action="{{ route('kepala-keluarga.destroy', $kk->idKK) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>

        <div class="mt-4 d-flex justify-content-center align-items-center">
            <nav aria-label="Page navigation">
                <ul class="pagination pagination-sm">
                    {{ $kepala_keluarga->links('pagination::bootstrap-4') }}
                </ul>
            </nav>
        </div>

    <!-- Modal Edit KK -->
    <div class="modal fade" id="editKKModal" tabindex="-1" aria-labelledby="editKKModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editKKModalLabel">Edit Data KK</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editKKForm" method="POST">
                        @csrf
                        @method('PUT') <!-- Method PUT untuk update -->
                        <div class="mb-3">
                            <label for="edit_nik" class="form-label">NIK</label>
                            <input type="text" class="form-control" id="edit_nik" name="nik" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_pin" class="form-label">PIN</label>
                            <input type="text" class="form-control" id="edit_pin" name="pin" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="edit_email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="edit_nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="edit_nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="edit_alamat" name="alamat" required></textarea>
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
                            <label for="edit_rt_rw" class="form-label">RT/RW</label>
                            <input type="text" class="form-control" id="edit_rt_rw" name="RTRW" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_idRT" class="form-label">ID RT</label>
                            <input type="number" class="form-control" id="edit_idRT" name="idRT" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_idRW" class="form-label">ID RW</label>
                            <input type="number" class="form-control" id="edit_idRW" name="idRW" required>
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

    <form id="perPageForm" action="{{ route('data_kk') }}" method="GET" style="display: none;">
    <input type="hidden" name="search" value="{{ request('search') }}">
    <input type="hidden" name="perPage" id="perPageInput">
    </form>
    
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
            document.getElementById("editKKForm").addEventListener("submit", function(event) {
                event.preventDefault(); // Mencegah reload halaman

                let form = this;
                let formData = new FormData(form);
                let idKK = form.getAttribute("data-id"); // Ambil ID KK dari form

                fetch(`/kepala-keluarga/${idKK}`, {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                            "X-Requested-With": "XMLHttpRequest"
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

            // Tangani tombol edit KK
            document.querySelectorAll(".edit-kk-btn").forEach(button => {
                button.addEventListener("click", function() {
                    document.getElementById("edit_nik").value = this.dataset.nik;
                    document.getElementById("edit_pin").value = this.dataset.pin;
                    document.getElementById("edit_email").value = this.dataset.email;
                    document.getElementById("edit_nama").value = this.dataset.nama;
                    document.getElementById("edit_alamat").value = this.dataset.alamat;
                    document.getElementById("edit_noTelepon").value = this.dataset.notelepon;
                    document.getElementById("edit_peranUser").value = this.dataset.peranuser;
                    document.getElementById("edit_rt_rw").value = this.dataset.rtrw;
                    document.getElementById("edit_idRT").value = this.dataset.idrt;
                    document.getElementById("edit_idRW").value = this.dataset.idrw;

                    // Simpan ID KK ke dalam atribut form
                    document.getElementById("editKKForm").setAttribute("data-id", this.dataset.id);

                    var editKKModal = new bootstrap.Modal(document.getElementById("editKKModal"));
                    editKKModal.show();
                });
            });
        });

        // Fungsi untuk menutup modal saat tombol batal diklik
        document.getElementById('btnBatal').addEventListener('click', function() {
            var editModal = bootstrap.Modal.getInstance(document.getElementById('editModal'));
            editModal.hide();
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