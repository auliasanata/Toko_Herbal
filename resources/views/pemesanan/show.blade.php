@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Pemesanan</h2>
    <table class="table">
        <thead>
            <tr>
                <th><strong>Nama Pengguna:</strong></th>
                <th><strong>Nama Produk:</strong></th>
                <th><strong>Jumlah Produk:</strong></th>
                <th><strong>Opsi Bayar:</strong></th>
                <th><strong>Sub Harga:</strong></th>
                <th><strong>Sub Kirim:</strong></th>
                <th><strong>Total Bayar:</strong></th>
                <th><strong>Tanggal:</strong></th>
                <th><strong>Status:</strong></th>
                <th><strong>Bukti Pembayaran:</strong></th>
            </tr>
        </thead>
        <tbody>
            @foreach($pesanan as $pemesanan)
            <tr>
                <td>{{ $pemesanan->nama_pengguna }}</td>
                <td>{{ $pemesanan->nama_produk }}</td>
                <td>{{ $pemesanan->jumlah_produk }}</td>
                <td>{{ $pemesanan->opsi_pengiriman }}</td>
                <td>{{ $pemesanan->harga_produk }}</td>
                <td>{{ $pemesanan->subtotal_pengiriman }}</td>
                <td>{{ $pemesanan->subtotal_produk }}</td>
                <td>{{ $pemesanan->created_at }}</td>
                <td>{{ $pemesanan->status }}</td>
                <td class="zoomable-image-container">
                    <img class="zoomable-image" src="data:image;base64,{{ base64_encode($pemesanan->bukti_pembayaran) }}" />
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('pemesanan.index') }}" class="btn btn-primary">Kembali</a>
</div>
@endsection
