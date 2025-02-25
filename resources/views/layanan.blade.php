@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Banner Section -->
    <div class="banner text-center">
        <img src="{{ asset('images/banner-layanan.png') }}" class="img-fluid w-100" alt="Layanan BUMDes">
    </div>

    <!-- Services Section -->
    <div class="services mt-4">
        <div class="row">
            @php
                $services = [
                    [
                        'icon' => 'fa-trash',
                        'title' => 'Pengelolaan Sampah',
                        'description' => 'Layanan ini dirancang untuk mendukung kebersihan lingkungan desa dengan sistem pengelolaan sampah yang profesional.',
                    ],
                    [
                        'icon' => 'fa-piggy-bank',
                        'title' => 'Simpan Pinjam',
                        'description' => 'Fasilitas simpan pinjam memberikan solusi keuangan bagi masyarakat untuk mendukung kebutuhan usaha, pendidikan, dan lainnya.',
                    ],
                    [
                        'icon' => 'fa-car',
                        'title' => 'Samsat Budiman',
                        'description' => 'Melalui layanan Samsat Budiman, masyarakat dapat mengurus pembayaran pajak kendaraan bermotor tanpa keluar desa.',
                    ],
                    [
                        'icon' => 'fa-credit-card',
                        'title' => 'PPOB (Payment Point Online Bank)',
                        'description' => 'Masyarakat dapat membayar berbagai tagihan seperti listrik, air, internet, pulsa, dan lainnya secara online.',
                    ]
                ];
            @endphp

            @foreach($services as $service)
                <div class="col-md-12 mb-3">
                    <div class="card p-3 shadow-sm border-0 rounded bg-light">
                        <div class="d-flex align-items-center">
                            <div class="icon-container me-3 text-primary">
                                <i class="fas {{ $service['icon'] }} fa-2x"></i>
                            </div>
                            <div class="service-content flex-grow-1">
                                <h5 class="fw-bold">{{ $service['title'] }}</h5>
                                <p class="text-muted">{{ $service['description'] }}</p>
                            </div>
                            <div>
                                <a href="#" class="btn btn-primary">Cek Disini</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
