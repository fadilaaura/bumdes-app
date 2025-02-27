<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Tagihan - Dashboard Admin BUMDes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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
        .sidebar a:hover, .dropdown-btn:hover, .sidebar .active{
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
        <a href="{{ route('data_kk') }}">📋 Data KK</a>
        <a href="{{ route('data_rt') }}">📋 Data RT</a>
        <a href="{{ route('data_rw') }}">📋 Data RW</a>
    </div>
    <button class="dropdown-btn">💰 Kelola Tagihan ▼</button>
    <div class="dropdown-content">
        <a href="{{ route('tagihan.index') }}" class="active">📋 Tambah Tagihan</a>
        <a href="{{ route('konfirmasi_tagihan') }}">📋 Konfirmasi Tagihan</a>
    </div>
    <a href="{{ route('laporan.iuran') }}">📊 Laporan Iuran Sampah</a>
    <a href="{{ route('kelola.peran') }}">🔑 Kelola Peran</a>
    <a href="{{ route('profil') }}">👤 Profil</a>
    <a href="{{ route('login.admin') }}">🚪 Keluar</a>
</div>

<div class="content">
    <h1>Kelola Tagihan</h1>
    <div class="mb-3">
        <a href="{{ route('tagihan.create') }}" class="btn btn-primary">Tambah Tagihan</a>
        <button class="btn btn-secondary">Export Data</button>
    </div>

    @php
    $tagihans = $tagihans ?? collect(); // Kalau belum ada, isi dengan koleksi kosong
@endphp

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Nomor HP</th>
                <th>RT/RW</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tagihans as $tagihan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $tagihan->nama }}</td>
                <td>{{ $tagihan->nik }}</td>
                <td>{{ $tagihan->nomor_hp }}</td>
                <td>{{ $tagihan->rt_rw }}</td>
                <td>{{ $tagihan->jumlah }}</td>
                <td>{{ $tagihan->statusTagihan }}</td>
                <td>
                    <a href="https://wa.me/{{ $tagihan->nomor_hp }}?text=Halo%20{{ urlencode($tagihan->nama) }},%20tagihan%20Anda%20sebesar%20Rp%20{{ number_format($tagihan->jumlah) }}%20jatuh%20tempo%20pada%20{{ $tagihan->tanggalJatuhTempo }}." 
                        target="_blank" class="btn btn-success btn-sm">
                        Kirim WhatsApp
                    </a>

                    <button class="btn btn-primary btn-sm edit-btn"
                        data-id="{{ $tagihan->idTagihan }}"
                        data-nama="{{ $tagihan->nama }}"
                        data-nik="{{ $tagihan->nik }}"
                        data-nomor_hp="{{ $tagihan->nomor_hp }}"
                        data-rt_rw="{{ $tagihan->rt_rw }}"
                        data-jumlah="{{ $tagihan->jumlah }}"
                        data-status="{{ $tagihan->statusTagihan }}"
                        data-tanggal_pembuatan="{{ $tagihan->tanggalPembuatan }}"
                        data-tanggal_jatuh_tempo="{{ $tagihan->tanggalJatuhTempo }}">
                        Ubah
                    </button>

                    <form action="{{ route('tagihan.destroy', $tagihan->idTagihan) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm mt-2" onclick="return confirm('Yakin ingin menghapus tagihan ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

<!-- Modal Edit Tagihan -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Tagihan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="edit_nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="edit_nama" name="nama" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_nik" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="edit_nik" name="nik" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_nomor_hp" class="form-label">Nomor HP</label>
                        <input type="text" class="form-control" id="edit_nomor_hp" name="nomor_hp" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_rt_rw" class="form-label">RT/RW</label>
                        <input type="text" class="form-control" id="edit_rt_rw" name="rt_rw" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_jumlah" class="form-label">Jumlah Tagihan</label>
                        <input type="number" class="form-control" id="edit_jumlah" name="jumlah" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_statusTagihan" class="form-label">Status</label>
                        <select class="form-control" id="edit_statusTagihan" name="statusTagihan">
                            <option value="Belum Lunas">Belum Lunas</option>
                            <option value="Lunas">Lunas</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_tanggalPembuatan" class="form-label">Tanggal Pembuatan</label>
                        <input type="date" class="form-control" id="edit_tanggalPembuatan" name="tanggalPembuatan" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_tanggalJatuhTempo" class="form-label">Tanggal Jatuh Tempo</label>
                        <input type="date" class="form-control" id="edit_tanggalJatuhTempo" name="tanggalJatuhTempo" required>
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


    document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', function() {
        document.getElementById('edit_nama').value = this.dataset.nama;
        document.getElementById('edit_nik').value = this.dataset.nik;
        document.getElementById('edit_nomor_hp').value = this.dataset.nomor_hp;
        document.getElementById('edit_rt_rw').value = this.dataset.rt_rw;
        document.getElementById('edit_jumlah').value = this.dataset.jumlah;
        document.getElementById('edit_statusTagihan').value = this.dataset.status;
        document.getElementById('edit_tanggalPembuatan').value = this.dataset.tanggal_pembuatan;
        document.getElementById('edit_tanggalJatuhTempo').value = this.dataset.tanggal_jatuh_tempo;

        document.getElementById('editForm').action = "/admin/tagihan/update/" + button.dataset.id;


        var editModal = new bootstrap.Modal(document.getElementById('editModal'));
        editModal.show();
    });
});

</script>

</body>
</html>
