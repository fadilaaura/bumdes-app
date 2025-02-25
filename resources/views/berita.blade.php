@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Banner -->
    <div class="banner">
        <img src="{{ asset('images/banner-berita.png') }}" class="img-fluid w-100" alt="Banner Berita">
    </div>

    <!-- Berita Section -->
    <div class="row mt-4">
        @php
            $news = [
                [
                    'image' => 'pasar-mejasem.jpg',
                    'title' => 'Rapat Koordinasi Kegiatan Bumdes',
                    'date' => '20 Januari 2025',
                    'description' => 'Kamis, 16 Januari 2025, dilakukan rapat koordinasi tentang kegiatan Bumdes Mejabar tahun 2025 di Ruang Serbaguna Balai Desa Mejase...',
                ],
                [
                    'image' => 'rapat-koordinasi.jpg',
                    'title' => 'Rapat Koordinasi Kegiatan Bumdes',
                    'date' => '16 Januari 2025',
                    'description' => 'Kamis, 16 Januari 2025, dilakukan rapat koordinasi tentang kegiatan Bumdes Mejabar tahun 2025 di Ruang Serbaguna Balai Desa Mejase...',
                ],
                [
                    'image' => 'studi-tiru.jpg',
                    'title' => 'Studi Tiru Desa Mejase Barat ke TPST Patikraja, Banyumas',
                    'date' => '31 Oktober 2024',
                    'description' => 'Pada Hari Selasa, 29 Oktober 2024, Pemdes Mejase Barat, Bumdes, dan DLH Kabupaten Tegal melakukan kunjungan dalam rangka stud...',
                ],
                [
                    'image' => 'pengelolaan-sampah.jpg',
                    'title' => 'Pengelolaan Sampah di Desa Piloting',
                    'date' => '31 Oktober 2024',
                    'description' => 'Pada hari Kamis, 24 Oktober 2024 dilaksanakan kegiatan sosialisasi pengelolaan sampah di desa piloting bersama Dinas Lingkungan Hid...',
                ],
                [
                    'image' => 'studi-banding.jpg',
                    'title' => 'Kegiatan Studi Banding BUMDesa Spirit Mejabar ke BUMDes Karya Makmur',
                    'date' => '4 Oktober 2024',
                    'description' => 'Kegiatan Studi Banding BUMDesa Spirit Mejabar ke BUMDes Karya Makmur Sikanco - Cilacap berkaitan dengan Unit Samsat Budiman.',
                ],
                [
                    'image' => 'pelatihan-sia.jpg',
                    'title' => 'Pelatihan SIA BUMDesa',
                    'date' => '4 Oktober 2024',
                    'description' => 'Pada hari Selasa, 4 April 2023 telah dilaksanakan Kegiatan Pelatihan SIA BUMDesa. Kegiatan tersebut bertempat di Kantor BUMDesa Spirit...',
                ],
            ];
        @endphp

        @foreach($news as $item)
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <img src="{{ asset('images/news/' . $item['image']) }}" class="card-img-top" alt="{{ $item['title'] }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $item['title'] }}</h5>
                    <p class="text-muted">{{ $item['date'] }}</p>
                    <p class="card-text">{{ $item['description'] }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
