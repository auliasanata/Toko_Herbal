<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransaksiOfflineController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\PesananController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::post('/buktipembayaran', [PembelianController::class, 'handleBuktiPembayaran'])->name('bukti_pembayaran');

Route::post('/buktipembayaranpesanan', [PesananController::class, 'store']);
Route::get('/buktipembayaran', [PembelianController::class, 'bukti']);






Route::get('/pesananadmin', [PesananController::class, 'index']);
Route::get('/pemesanan', [PesananController::class, 'index'])->name('pemesanan.index');
Route::get('/pemesanan/{id}/edit', [PesananController::class, 'edit'])->name('pemesanan.edit');
Route::put('/pemesanan/{id}', [PesananController::class, 'update'])->name('pemesanan.update');
Route::delete('/pemesanan/{no_transaksi}', [PesananController::class, 'destroy'])->name('pemesanan.destroy');
Route::get('/pemesanan/{no_transaksi}', [PesananController::class, 'show'])->name('pemesanan.show');
Route::post('pemesanan/{no_transaksi}/konfirmasi', [PesananController::class, 'konfirmasi'])->name('pemesanan.konfirmasi');
Route::post('/pemesanan/checkbox', [PemesananController::class, 'checkbox'])->name('pemesanan.checkbox');

Route::post('pesanan/{pesanan}/diterima', [PesananController::class, 'diterima'])->name('pesanan.diterima');



Route::get('/detailpesanan/{no_transaksi}', [PesananController::class, 'detail'])->name('detailPesanan');















Auth::routes();


// Rute untuk menampilkan halaman login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Rute untuk menampilkan halaman registrasi
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/registerpembeli', [RegisterController::class, 'storepembeli'])->name('storepembeli');



// Route::get('/pemesanan', [PemesananController::class, 'index']);
Route::get('/pengiriman', [PengirimanController::class, 'index']);
Route::get('/transkasioffline', [TransaksiOfflineController::class, 'index']);
Route::get('/laporanpenjualan', [LaporanPenjualanController::class, 'index']);
Route::get('/pemesananpembeli/{id}', [PemesananController::class, 'pemesanan']);
Route::get('/pemesananpembeli', [PembelianController::class, 'pemesananpembeli']);







Route::resource('obat', ObatController::class);
// Route::resource('pemesanan', PemesananController::class);
Route::resource('pengiriman', PengirimanController::class);
Route::get('/laporan-penjualan', [LaporanPenjualanController::class, 'index'])->name('laporan_penjualan.index');
Route::get('/Datauser', [LaporanPenjualanController::class, 'user']);






// Route untuk menampilkan semua pengguna
Route::get('/users', [RegisterController::class, 'index'])->name('users.index');

Route::get('/datadiri', [DashboardController::class, 'datadiri'])->name('datadiri.index');
Route::get('/datadiri/edit/{id}', [DashboardController::class, 'editdatadiri'])->name('datadiri.edit');
Route::put('/datadiri/update/{id}', [DashboardController::class, 'updatedatadiri'])->name('datadiri.update');



// Route untuk menampilkan formulir pembuatan pengguna baru
// Route::get('/users/create', [RegisterController::class, 'create'])->name('users.create');

// Route untuk menyimpan data pengguna yang baru dibuat
Route::post('/users', [DashboardController::class, 'store'])->name('users.store');

// Route untuk menampilkan detail pengguna
Route::get('/users/{user}', [DashboardController::class, 'show'])->name('users.show');

// Route untuk menampilkan formulir pengeditan pengguna
Route::get('/users/{user}/edit', [DashboardController::class, 'edit'])->name('users.edit');

// Route untuk menyimpan data pengguna yang diperbarui
Route::put('/users/{user}', [DashboardController::class, 'update'])->name('users.update');

// Route untuk menghapus pengguna
Route::delete('/users/{user}', [DashboardController::class, 'destroy'])->name('users.destroy');




Route::get('/offline_transactions', [TransaksiOfflineController::class, 'index'])->name('offline_transactions.index');
Route::get('/offline_transactions/create', [TransaksiOfflineController::class, 'create'])->name('offline_transactions.create');
Route::post('/offline_transactions', [TransaksiOfflineController::class, 'store'])->name('offline_transactions.store');
Route::get('/offline_transactions/{transaction}', [TransaksiOfflineController::class, 'show'])->name('offline_transactions.show');
Route::get('/offline_transactions/{transaction}/edit', [TransaksiOfflineController::class, 'edit'])->name('offline_transactions.edit');
Route::put('/offline_transactions/{transaction}', [TransaksiOfflineController::class, 'update'])->name('offline_transactions.update');
Route::delete('/offline_transactions/{transaction}', [TransaksiOfflineController::class, 'destroy'])->name('offline_transactions.destroy');


Route::get('/laporan-penjualan/export-pdf', [LaporanPenjualanController::class, 'exportPDF'])->name('laporan_penjualan.export_pdf');





Route::get('/pemesanansementara', [PemesananController::class, 'pemesanansementara']);
Route::get('/tambahuser', [DashboardController::class, 'create'])->name('users.create');
Route::get('/', [DashboardController::class, 'landingpage']);



Route::get('/home', [PembelianController::class, 'home']);
Route::get('/data', [PembelianController::class, 'data']);

Route::get('/masterpembeli', [PembelianController::class, 'masterpembeli']);
Route::get('/produk', [PembelianController::class, 'produk'])->name('produk');
Route::get('/pemesananpembeli', [PembelianController::class, 'pemesananpembeli']);
Route::get('/pesanan', [PembelianController::class, 'pesanan'])->name('pemesanan');
Route::delete('/batalPesanan/{no_transaksi}', [PembelianController::class, 'batalPesanan'])->name('batalPesanan');
Route::delete('/pesanan/{id}', [PembelianController::class, 'hapuspesanan'])->name('hapusPesanan');



Route::get('/detailpesanan', [PembelianController::class, 'detailpesanan']);
Route::get('/keranjang', [PembelianController::class, 'keranjang'])->name('keranjang');
Route::post('/reviewBuktiPembayaran', [PembelianController::class, 'reviewBuktiPembayaran'])->name('reviewBuktiPembayaran');
Route::get('/buktipembayarankeranjang', [PembelianController::class, 'buktipembayarankeranjang'])->name('buktipembayarankeranjang');








