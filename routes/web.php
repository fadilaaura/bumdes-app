<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthWargaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ProfilWargaController;
use App\Http\Controllers\KepalaKeluargaController;
use App\Http\Controllers\RTController;
use App\Http\Controllers\RWController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\RiwayatPembayaranWargaController;

#====================== BISA DIAKSES KEDUA AUTH ========================
Route::get('/', [BerandaController::class, 'index'])->name('beranda');

Route::get('/', function () {
    return view('beranda');
})->name('beranda');

Route::get('/layanan-bumdes', function () {
    return view('layanan');
})->name('layanan.bumdes');

Route::get('/berita', function () {
    return view('berita');
})->name('berita');

Route::get('/tentangkami', function () {
    return view('tentangkami');
})->name('tentang.kami');

Route::get('/promosi-umkm', function () {
    return view('promosi_umkm');
})->name('promosi.umkm');

# ======================== [ LOGIN dan DASHBOARD PENGELOLA BUMDES ] ========================
Route::get('/login-admin', [AuthController::class, 'showLoginForm'])->name('login.admin');
Route::post('/login-admin', [AuthController::class, 'login']);
Route::post('/logout-admin', [AuthController::class, 'logout'])->name('logout.admin');

Route::middleware(['auth:PengelolaBumdes'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/data-kk', function () {
        return view('data_kk');
    })->name('data_kk');

    Route::get('/data-rw', function () {
        return view('data_rw');
    })->name('data_rw');

    Route::get('/data-rt', function () {
        return view('data_rt');
    })->name('data_rt');

    Route::view('/kelola-tagihan', 'kelola_tagihan')->name('kelola_tagihan');
    Route::view('/kelola-tagihan/tambah', 'tambah_tagihan')->name('tambah_tagihan');
    Route::view('/kelola-tagihan/konfirmasi', 'konfirmasi_tagihan')->name('konfirmasi_tagihan');

    Route::get('/admin/tagihan', [TagihanController::class, 'index'])->name('tagihan.index');
    Route::get('/admin/tagihan/tambah', [TagihanController::class, 'create'])->name('tagihan.create');
    Route::get('/admin/tagihan/konfirmasi', [TagihanController::class, 'confirm'])->name('tagihan.confirm');
    Route::post('/admin/tagihan/store', [TagihanController::class, 'store'])->name('tagihan.store');
    Route::delete('/admin/tagihan/{id}', [TagihanController::class, 'destroy'])->name('tagihan.destroy');
    Route::get('/admin/tagihan/edit/{id}', [TagihanController::class, 'edit'])->name('tagihan.edit');
    Route::post('/admin/tagihan/update/{id}', [TagihanController::class, 'update'])->name('tagihan.update');
    Route::get('/export-tagihan', [TagihanController::class, 'export'])->name('export.tagihan');

    Route::get('/laporan-iuran', [LaporanController::class, 'index'])->name('laporan.iuran');

    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::post('/profil/update', [ProfilController::class, 'update'])->name('profil.update');

    Route::get('/data-kk', [KepalaKeluargaController::class, 'index'])->name('data_kk');
    Route::get('/kepala-keluarga/tambah', [KepalaKeluargaController::class, 'create'])->name('kepala_keluarga.create');
    Route::post('/kepala-keluarga/store', [KepalaKeluargaController::class, 'store'])->name('kepala_keluarga.store');
    Route::put('/kepala-keluarga/{idKK}', [KepalaKeluargaController::class, 'update'])->name('kepala-keluarga.update');
    Route::delete('/kepala-keluarga/{idKK}', [KepalaKeluargaController::class, 'destroy'])->name('kepala-keluarga.destroy');
    Route::get('/export-kepala-keluarga', [KepalaKeluargaController::class, 'export'])->name('export.kepala.keluarga');

    Route::get('/rt', [RTController::class, 'index'])->name('data_rt');
    Route::get('/rt/tambah', [RTController::class, 'create'])->name('rt.create');
    Route::post('/rt/store', [RTController::class, 'store'])->name('rt.store');
    Route::get('/rt/{idRT}/edit', [RTController::class, 'edit'])->name('rt.edit');
    Route::put('/rt/{idRT}/update', [RTController::class, 'update'])->name('rt.update');
    Route::delete('/rt/{idRT}/delete', [RTController::class, 'destroy'])->name('rt.destroy');
    Route::get('/export-rt', [RTController::class, 'export'])->name('export.rt');

    Route::get('/data_rw', [RWController::class, 'index'])->name('data_rw');
    Route::get('/tambah_rw', [RWController::class, 'create'])->name('tambah_rw');
    Route::post('/rw/store', [RWController::class, 'store'])->name('rw.store');
    Route::get('/rw/{idRW}/edit', [RWController::class, 'edit'])->name('rw.edit');
    Route::put('/rw/{idRW}/update', [RWController::class, 'update'])->name('rw.update');
    Route::delete('/rw/{idRW}/delete', [RWController::class, 'destroy'])->name('rw.destroy');
    Route::get('/export-rw', [RWController::class, 'export'])->name('export.rw');

    Route::get('/kelola-peran', [WargaController::class, 'kelolaPeran'])->name('kelola.peran');
    Route::get('/kelola-peran/{idKK}/edit', [WargaController::class, 'edit'])->name('peran.edit');
    Route::put('/kelola-peran/{idKK}/update', [WargaController::class, 'update'])->name('peran.update');
    Route::post('/kelola-peran/{idKK}/update', [WargaController::class, 'update'])->name('peran.update');
    Route::delete('/kelola-peran/{idKK}/delete', [WargaController::class, 'destroy'])->name('peran.destroy');
});

# ======================== [ LOGIN DAN DASHBOARD KEPALA KELUARGA AS WARGA ] ========================
Route::get('/warga/login', [AuthWargaController::class, 'showLoginForm'])->name('warga.login');
Route::post('/warga/login', [AuthWargaController::class, 'login'])->name('warga.login');
Route::post('/warga/logout', [AuthWargaController::class, 'logout'])->name('warga.logout');

Route::middleware(['auth:KepalaKeluarga'])->group(function () {
    Route::get('/dashboard-warga', [AuthWargaController::class, 'showDashboard'])->name('dashboard.warga');

    Route::get('/profilwarga', [ProfilWargaController::class, 'index'])->name('profil_warga');
    Route::post('/profilwarga/update', [ProfilWargaController::class, 'update'])->name('profil_warga.update');
    
    Route::get('/retribusi-sampah', [PembayaranController::class, 'index'])->name('retribusi.sampah');
    Route::post('/retribusi-sampah', [PembayaranController::class, 'store'])->name('retribusi.sampah.store');
    Route::get('/riwayat-pembayaran', [RiwayatPembayaranWargaController::class, 'index'])->name('riwayat.pembayaran.warga');

});