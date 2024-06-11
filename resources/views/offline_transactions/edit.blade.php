@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Transaksi Offline</h2>
    <form action="{{ route('offline_transactions.update', $transaction->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="obat_id" class="form-label">ID Obat:</label>
            <select class="form-control" id="obat_id" name="obat_id" required>
                @foreach($obats as $obat)
                <option value="{{ $obat->id }}" {{ $transaction->obat_id == $obat->id ? 'selected' : '' }}>{{ $obat->nama }}</option>
                @endforeach
            </select>
        <div class="form-group">
            <label for="kuantitas">Kuantitas:</label>
            <input type="text" class="form-control" id="kuantitas" name="kuantitas" value="{{ $transaction->kuantitas }}" required>
        </div>
        <div class="form-group">
            <label for="sub_harga">Sub Harga:</label>
            <input type="text" class="form-control" id="sub_harga" name="sub_harga" value="{{ $transaction->sub_harga }}" required>
        </div>
        <div class="form-group">
            <label for="total_bayar">Total Bayar:</label>
            <input type="text" class="form-control" id="total_bayar" name="total_bayar" value="{{ $transaction->total_bayar }}" required>
        </div>
        <div class="form-group">
            <label for="tanggal">Tanggal:</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $transaction->tanggal }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection