<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Kelola Peran - BUMDes Spirit Mejabar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Gaya Umum */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            display: flex;
        }

        /* Sidebar */
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

        /* Tombol */
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
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4>Badan Usaha Milik Desa</h4>
        <h5>Spirit Mejabar</h5>
        <hr>
        <a href="{{ route('admin.dashboard') }}">🏠 Beranda</a>
        <button class="dropdown-btn">📂 Data Master ▼</button>
        <div class="dropdown-content">
            <a href="{{ route('data_kk') }}">📋 Data KK</a>
            <a href="{{ route('data_rt') }}">📋 Data RT</a>
            <a href="{{ route('data_rw') }}">📋 Data RW</a>
        </div>
        <button class="dropdown-btn">💰 Kelola Tagihan ▼</button>
        <div class="dropdown-content">
            <a href="{{ route('tagihan.index') }}">📋 Tambah Tagihan</a>
            <a href="{{ route('konfirmasi_tagihan') }}">📋 Konfirmasi Tagihan</a>
        </div>
        <a href="{{ route('laporan.iuran') }}">📊 Laporan Iuran</a>
        <a href="{{ route('kelola.peran') }}" class="active">🔑 Kelola Peran</a>
        <a href="{{ route('profil') }}">👤 Profil</a>
        <form action="{{ route('logout.admin') }}" method="POST">
    @csrf
    <button type="submit" class="sidebar-link">🚪 Keluar</button>
</form>    </div>

    <!-- Konten Utama -->
    <div class="content">
        <h2>Kelola Peran</h2>
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
</body>

</html>