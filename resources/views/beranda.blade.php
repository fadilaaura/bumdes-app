@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

@section('content')
<div class="container">
    <!-- Hero Section -->
    <section class="hero">
            <div class="carousel-container">
                <div class="carousel-slide active">
                    <img src="{{ asset('images/fotobumdes.jpg') }}" class="img-fluid rounded shadow" alt="BUMDes Spirit Mejabar">
                </div>
                <div class="carousel-slide">
                    <img src="images/banner3.jpg" alt="Fasilitas Universitas Bhakti Muda">
                </div>
                <div class="carousel-slide">
                    <img src="images/banner2.jpg" alt="Kegiatan Mahasiswa Universitas Bhakti Muda">
                </div>
            </div>
        </section>


    <section class="section-container">
            <div class="card">
                <h2 class="section-title">BUMDes Spirit Mejabar</h2>
                <p>Badan Usaha Milik Desa (BUMDes) Spirit Mejabar adalah lembaga ekonomi yang dikelola oleh masyarakat Desa Mejasem Barat untuk meningkatkan kesejahteraan dan kemandirian desa. Sebagai wadah inovasi dan pengelolaan potensi lokal, BUMDes Spirit Mejabar menyediakan berbagai layanan yang mendukung kebutuhan warga, termasuk pengelolaan iuran sampah, usaha produktif, serta pengembangan ekonomi berbasis komunitas. Dengan semangat kebersamaan dan transparansi, BUMDes Spirit Mejabar terus berupaya memberikan kontribusi positif bagi desa, menciptakan layanan yang modern, efisien, dan ramah pengguna.</p>
            </div>
        </section>

    <!-- Visi & Misi -->
    <div class="row mt-5">
        <div class="col-md-6">
            <div class="card p-4 shadow">
                <h4 class="text-primary">Visi</h4>
                <p>Menjadi BUM Desa <strong>SPIRIT MEJABAR</strong> yang mempunyai kreativitas, unggul, dan profesional.</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-4 shadow">
                <h4 class="text-primary">Misi</h4>
                <ul>
                    <li>Mewujudkan pemerintahan desa yang dekoratif, partisipatif, responsif, dan transparan.</li>
                    <li>Mengaktifkan serta memajukan BUM Desa dan UMKM sebagai pilar ekonomi desa.</li>
                    <li>Meningkatkan Pendapatan Asli Desa dan pengelolaan secara profesional.</li>
                    <li>Menggali potensi desa untuk didayagunakan.</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Layanan BUMDes -->
    <h3 class="text-center mt-5 text-primary">Layanan BUMDes Spirit Mejabar</h3>
    <div class="row text-center">
        <div class="col-md-3">
            <div class="card p-3 shadow">
                <img src="{{ asset('icons/sampah.png') }}" width="50" alt="Sampah">
                <p>Pengelolaan Sampah</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow">
                <img src="{{ asset('icons/pinjaman.png') }}" width="50" alt="Pinjaman">
                <p>Simpan Pinjam</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow">
                <img src="{{ asset('icons/samsat.png') }}" width="50" alt="Samsat">
                <p>Samsat Budiman</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow">
                <img src="{{ asset('icons/ppob.png') }}" width="50" alt="PPOB">
                <p>PPOB (Payment Point Online Bank)</p>
            </div>
        </div>
    </div>

    <!-- Berita / Kegiatan -->
    <h3 class="text-center mt-5 text-primary">Berita & Kegiatan</h3>
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow p-3">
                <img src="{{ asset('images/rapat.jpg') }}" class="img-fluid rounded">
                <h5 class="mt-2">Rapat Koordinasi Kegiatan BUMDes</h5>
                <p>16 Januari 2025 - Rapat koordinasi kegiatan BUMDes Mejabar untuk tahun 2025 di Balai Desa.</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow p-3">
                <img src="{{ asset('images/studi_banding.jpg') }}" class="img-fluid rounded">
                <h5 class="mt-2">Kegiatan Studi Banding</h5>
                <p>4 Oktober 2024 - Studi banding BUMDes Spirit Mejabar ke BUMDes Karya Makmur Sikunco, Cilacap.</p>
            </div>
        </div>
    </div>
</div>

<!-- Footer Section -->
<footer class="bg-primary text-white mt-5 py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5>BUMDes Spirit Mejabar</h5>
                <p>Griya Mejasem Baru, Mejassem Bar., Kec. Kramat, Kabupaten Tegal, Jawa Tengah</p>
            </div>
            <div class="col-md-4">
                <h5>Menu</h5>
                <ul class="list-unstyled">
                    <li><a href=" " class="text-white">Beranda</a></li>
                    <li><a href=" " class="text-white">Layanan BUMDes</a></li>
                    <li><a href=" " class="text-white">Berita</a></li>
                    <li><a href=" " class="text-white">Tentang Kami</a></li>
                    <li><a href=" " class="text-white">Promosi UMKM</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Hubungi Kami</h5>
                <p>(021) 6510300</p>
                <p><a href="https://instagram.com" class="text-white">Instagram</a></p>
                <p><a href="https://facebook.com" class="text-white">Facebook</a></p>
                <p>Email: spiritmejabar@gmail.com</p>
            </div>
        </div>
    </div>
</footer>
@endsection
