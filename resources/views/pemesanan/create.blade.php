@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Data Pemesanan</h2>
    <form action="{{ route('pemesanan.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="id">ID Pemesanan:</label>
            <input type="text" class="form-control" id="id" name="id" required>
        </div>
        <div class="form-group">
            <label for="id_customer">ID Customer:</label>
            <input type="text" class="form-control" id="id_customer" name="id_customer" required>
        </div>
        <div class="form-group">
            <label for="id_obat">ID Obat:</label>
            <select class="form-control" id="id_obat" name="id_obat" required>
                <option value="" selected disabled>Pilih ID Obat</option> <!-- Opsi default -->
                @foreach($obat as $item)
                @if($item->id)
                <option value="{{ $item->id }}">{{ $item->id }}</option>
                @endif
                @endforeach
            </select>
        </div>



        <div class="form-group">
            <label for="kualitas">Kualitas:</label>
            <input type="number" class="form-control" id="kualitas" name="kualitas" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <input type="text" class="form-control" id="alamat" name="alamat" required>
        </div>
        <div class="form-group">
            <label for="provinsi">Provinsi:</label>
            <input type="text" class="form-control" id="provinsi" name="provinsi" required>
        </div>
        <div class="form-group">
            <label for="pengirim">Pengirim:</label>
            <input type="text" class="form-control" id="pengirim" name="pengirim" required>
        </div>
        <div class="form-group">
            <label for="opsi_bayar">Opsi Bayar:</label>
            <input type="text" class="form-control" id="opsi_bayar" name="opsi_bayar" required>
        </div>
        <div class="form-group">
            <label for="sub_harga">Sub Harga:</label>
            <input type="number" class="form-control" id="sub_harga" name="sub_harga" required>
        </div>
        <div class="form-group">
            <label for="sub_kirim">Sub Kirim:</label>
            <input type="number" class="form-control" id="sub_kirim" name="sub_kirim" required>
        </div>
        <div class="form-group">
            <label for="total_bayar">Total Bayar:</label>
            <input type="number" class="form-control" id="total_bayar" name="total_bayar" required>
        </div>
        <div class="form-group">
            <label for="tanggal">Tanggal:</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('pemesanan.index') }}" class="btn btn-primary">Kembali</a>

    </form>
</div>
@endsection