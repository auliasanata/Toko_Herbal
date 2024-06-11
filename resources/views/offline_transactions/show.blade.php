@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Transaksi Offline</h2>
    <p><strong>ID:</strong> {{ $transaction->id }}</p>
    <p><strong>ID Obat:</strong> {{ $transaction->obat->nama }}</p>
    <p><strong>Kuantitas:</strong> {{ $transaction->kuantitas }}</p>
    <p><strong>Sub Harga:</strong> {{ $transaction->sub_harga }}</p>
    <p><strong>Total Bayar:</strong> {{ $transaction->total_bayar }}</p>
    <p><strong>Tanggal:</strong> {{ $transaction->tanggal }}</p>
    <!-- Tambahkan tombol kembali jika diperlukan -->
    <a href="{{ route('offline_transactions.index') }}" class="btn btn-secondary">Kembali</a>

</div>
@endsection