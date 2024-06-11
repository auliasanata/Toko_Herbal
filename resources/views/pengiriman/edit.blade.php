@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Pengiriman</h2>
    <form action="{{ route('pengiriman.update', $pengiriman->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama_pengguna">Nama Pemesan:</label>
            <input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna" value="{{ $pengiriman->nama_pengguna }}">
        </div>
        <div class="form-group">
            <label for="nama_produk">Nama Produk:</label>
            <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="{{ $pengiriman->nama_produk }}">
        </div>
        <div class="form-group">
            <label for="opsi_pengiriman">Pengiriman:</label>
            <input type="text" class="form-control" id="opsi_pengiriman" name="opsi_pengiriman" value="{{ $pengiriman->opsi_pengiriman }}">
        </div>
        <div class="form-group">
            <label for="alamat_lengkap">Alamat Lengkap:</label>
            <input type="text" class="form-control" id="alamat_lengkap" name="alamat_lengkap" value="{{ $pengiriman->alamat_lengkap }}">
        </div>
        <div class="form-group">
            <label for="provinsi">Provinsi:</label>
            <input type="text" class="form-control" id="provinsi" name="provinsi" value="{{ $pengiriman->provinsi }}">
        </div>
        <div class="form-group">
            <label for="jumlah_produk">Jumlah Produk:</label>
            <input type="number" class="form-control" id="jumlah_produk" name="jumlah_produk" value="{{ $pengiriman->jumlah_produk }}">
        </div>
        <div class="form-group">
            <label for="subtotal_pengiriman">Harga Pengiriman:</label>
            <input type="text" class="form-control" id="subtotal_pengiriman" name="subtotal_pengiriman" value="{{ $pengiriman->subtotal_pengiriman }}">
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection
