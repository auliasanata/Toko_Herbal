@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Transaksi Offline Baru</h2>
    <form action="{{ route('offline_transactions.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="obat_id" class="form-label">ID Obat:</label>
            <select class="form-control" id="obat_id" name="obat_id" required>
                @foreach($obats as $obat)
                <option value="{{ $obat->id }}">{{ $obat->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="kuantitas">Kuantitas:</label>
            <input type="number" class="form-control" id="kuantitas" name="kuantitas" required>
        </div>
        <div class="form-group">
            <label for="sub_harga">Sub Harga:</label>
            <input type="number" class="form-control" id="sub_harga" name="sub_harga" required>
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
    </form>
</div>
@endsection