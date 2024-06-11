@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Data Pemesanan</h2>
    <form action="{{ route('pemesanan.update', $pesanan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama_pengguna">Nama Pemesan:</label>
            <input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna" value="{{ $pesanan->nama_pengguna }}" required>
        </div>
        <div class="form-group">
            <label for="nama_produk">Nama Obat:</label>
            <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="{{ $pesanan->nama_produk }}" required>
        </div>
        <div class="form-group">
            <label for="jumlah_produk">Jumlah Produk:</label>
            <input type="text" class="form-control" id="jumlah_produk" name="jumlah_produk" value="{{ $pesanan->jumlah_produk }}" required>
        </div>
        <div class="form-group">
            <label for="harga_produk">Sub Harga:</label>
            <input type="text" class="form-control" id="harga_produk" name="harga_produk" value="{{ $pesanan->harga_produk }}" required>
        </div>
        <div class="form-group">
            <label for="subtotal_pengiriman">Sub Kirim:</label>
            <input type="text" class="form-control" id="subtotal_pengiriman" name="subtotal_pengiriman" value="{{ $pesanan->subtotal_pengiriman }}" required>
        </div>
        <div class="form-group">
            <label for="subtotal_produk">Sub Total Produk:</label>
            <input type="text" class="form-control" id="subtotal_produk" name="subtotal_produk" value="{{ $pesanan->subtotal_produk }}" required>
        </div>
        <div class="form-group">
            <label for="total_pembayaran">Total Bayar:</label>
            <input type="text" class="form-control" id="total_pembayaran" name="total_pembayaran" value="{{ $pesanan->total_pembayaran }}" required>
        </div>
        <div class="form-group">
            <label for="created_at">Created At:</label>
            <input type="date" class="form-control" id="created_at" name="created_at" value="{{ $pesanan->created_at }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('pemesanan.index') }}" class="btn btn-primary">Kembali</a>
    </form>
</div>
@endsection
