@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Pengiriman</h2>
    <p><strong>Nama Pemesan:</strong> {{ $pengiriman->nama_pengguna }}</p>
    <p><strong>Nama Produk:</strong> {{ $pengiriman->nama_produk }}</p>
    <p><strong>Pengiriman:</strong> {{ $pengiriman->opsi_pengiriman }}</p>
    <p><strong>Alamat Lengkap:</strong> {{ $pengiriman->alamat_lengkap }}</p>
    <p><strong>Provinsi:</strong> {{ $pengiriman->provinsi }}</p>
    <p><strong>Jumlah Produk:</strong> {{ $pengiriman->jumlah_produk }}</p>
    <p><strong>Harga Pengiriman:</strong> {{ $pengiriman->subtotal_pengiriman }}</p>
    <!-- Tambahkan informasi detail lainnya yang ingin ditampilkan -->
</div>
@endsection
