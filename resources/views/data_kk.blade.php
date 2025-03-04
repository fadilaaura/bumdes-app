<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>Data Master - Dashboard Admin BUMDes</title>
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
            text-align: left;
            cursor: pointer;
            width: 100%;
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
    <a href="{{ route('admin.dashboard') }}">🏠 Beranda</a>
    <button class="dropdown-btn">📂 Data Master ▼</button>
    <div class="dropdown-content">
        <a href="{{ route('data_kk') }}"class="active">📋 Data KK</a>
        <a href="{{ route('data_rt') }}">📋 Data RT</a>
        <a href="{{ route('data_rw') }}">📋 Data RW</a>
    </div>
    <button class="dropdown-btn">💰 Kelola Tagihan ▼</button>
    <div class="dropdown-content">
        <a href="{{ route('tagihan.index') }}">📋 Tambah Tagihan</a>
        <a href="{{ route('konfirmasi_tagihan') }}">📋 Konfirmasi Tagihan</a>
    </div>
    <a href="{{ route('laporan.iuran') }}">📊 Laporan Iuran Sampah</a>
    <a href="{{ route('kelola.peran') }}">🔑 Kelola Peran</a>
    <a href="{{ route('profil') }}">👤 Profil</a>
    <a href="{{ route('login.admin') }}">🚪 Keluar</a>
</div>

<div class="content">
    <h1>Data KK</h1>
    <div class="mb-3">
    <button onclick="window.location.href='{{ route('kepala_keluarga.create') }}'" class="btn btn-primary">
    Tambah Data
    </button>
        <button class="btn btn-secondary">Export Data</button>
    </div>

    <table class="table table-bordered">
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
    Edit
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
                        <input type="text" class="form-control" id="edit_peranUser" name="peranUser" required>
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("editKKForm").addEventListener("submit", function (event) {
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
document.getElementById('btnBatal').addEventListener('click', function () {
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

</body>
</html>