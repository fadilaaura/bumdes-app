<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/logo-nb.png" type="image/x-icon">
    <title>Kelola Tagihan - Dashboard Admin BUMDes</title>
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
        }

        .sidebar a:hover, .sidebar-link:hover, .sidebar-link.active,
        .dropdown-btn:hover,
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

        .table tr:hover {
            background: #f1f1f1;
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
            <a href="{{ route('tagihan.index') }}">📋 Tambah Tagihan</a>
            <a href="{{ route('konfirmasi.pembayaran') }}" class="active">📋 Konfirmasi Tagihan</a>
        </div>
        <a href="{{ route('laporan.iuran') }}">📊 Laporan Iuran Sampah</a>
        <a href="{{ route('kelola.peran') }}">🔑 Kelola Peran</a>
        <a href="{{ route('profil') }}">👤 Profil</a>
        <form action="{{ route('logout.admin') }}" method="POST">
            @csrf
            <button type="submit" class="sidebar-link">🚪 Keluar</button>
        </form>
    </div>

    <div class="content">
        <h1>Konfirmasi Pembayaran</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table table-bordered mt-2">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIK</th>
            <th>Jumlah</th>
            <th>Tanggal Jatuh Tempo</th>
            <th>Bukti Pembayaran</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pembayaran as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->nik }}</td>
                <td>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggalJatuhTempo)->format('d-m-Y') ?? '-' }}</td>
                <td>
                    <button class="btn btn-primary btn-sm" onclick="lihatBukti('{{ asset('storage/' . $item->buktiPembayaran) }}')">
                        Lihat Bukti
                    </button>
                </td>
                <td>
                    @if($item->status == 'pending')
                        <span class="badge bg-warning text-dark">Menunggu Konfirmasi</span>
                    @elseif($item->status == 'lunas')
                        <span class="badge bg-success text-white">Lunas</span>
                    @endif
                </td>
                <td>
                    @if($item->status == 'pending')
                        <form action="{{ route('konfirmasi.pembayaran.konfirmasi', $item->idPembayaran) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Konfirmasi</button>
                        </form>
        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalTolak{{ $item->idPembayaran }}">
            Tolak
        </button>
                    @endif
                </td>
            </tr>
            <!-- Modal Tolak -->
<div class="modal fade" id="modalTolak{{ $item->idPembayaran }}" tabindex="-1" aria-labelledby="modalTolakLabel{{ $item->idPembayaran }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTolakLabel{{ $item->idPembayaran }}">Tolak Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <label for="alasan_penolakan_{{ $item->idPembayaran }}">Alasan Penolakan:</label>
                <textarea class="form-control" id="alasan_penolakan_{{ $item->idPembayaran }}" rows="3" required></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button"
                    class="btn btn-danger"
                    onclick="tolakDanKirimWA({{ $item->idPembayaran }}, '{{ $item->nama }}', '{{ $item->nomor_hp }}')">
                    Tolak & Kirim WhatsApp
                </button>
            </div>
        </div>
    </div>
</div>

        @endforeach
    </tbody>
</table>

    </div>

    <!-- Modal untuk menampilkan bukti pembayaran -->
    <div class="modal fade" id="modalBukti" tabindex="-1" aria-labelledby="modalBuktiLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalBuktiLabel">Bukti Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="gambarBukti" src="" class="img-fluid" alt="Bukti Pembayaran">
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

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function lihatBukti(url) {
            var imgElement = document.getElementById('gambarBukti');
            var modalElement = document.getElementById('modalBukti');

            if (imgElement && modalElement) {
                imgElement.src = url;
                var modal = new bootstrap.Modal(modalElement);
                modal.show();
            } else {
                console.error("Elemen modal atau gambar tidak ditemukan.");
            }
        }
    </script>

<script>
function tolakDanKirimWA(idPembayaran, nama, nomorHp) {
    const alasan = document.getElementById(`alasan_penolakan_${idPembayaran}`).value.trim();

    if (!alasan) {
        alert("Tolong isi alasan penolakan terlebih dahulu.");
        return;
    }

    fetch(`/admin/pembayaran/tolak-ajax/${idPembayaran}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: JSON.stringify({ alasan_penolakan: alasan })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Tutup modal
            const modalId = `modalTolak${idPembayaran}`;
            const modalEl = document.getElementById(modalId);
            const modalInstance = bootstrap.Modal.getInstance(modalEl);
            modalInstance.hide();

            // Compose pesan WA
            const nomorWa = nomorHp.replace(/^0/, "62");
            const pesan = `Halo *${nama}*,\n\nMaaf, pembayaran iuran sampah Anda *ditolak*.\n\n*Alasan:* ${alasan}\n\nSilakan unggah ulang bukti pembayaran yang benar.\n\nTerima kasih 🙏`;
            const waUrl = `https://wa.me/${nomorWa}?text=${encodeURIComponent(pesan)}`;

            // Buka WA di tab baru
            window.open(waUrl, '_blank');

            // Setelah 1 detik, reload halaman
            setTimeout(() => {
                location.reload();
            }, 1000);
        } else {
            alert("Gagal menolak pembayaran.");
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert("Terjadi kesalahan.");
    });
}
</script>




</body>
</html>
