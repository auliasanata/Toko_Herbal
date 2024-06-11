@extends('pembeli.masterpembeli')

@section('pembeli')

<div class="container py-5">
    <h1 class="mb-4">Detail Pesanan</h1>

    <div class="card">
        <div class="card-header">
            <h5>No. Transaksi: {{ $pesanan->first()->no_transaksi }}</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Harga Produk</th>
                        <th>Kuantitas</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalProduk = 0;
                        $totalHarga = 0;
                    @endphp

                    @foreach($pesanan as $p)
                    <tr>
                        <td>{{ $p->nama_produk }}</td>
                        <td>Rp {{ number_format($p->harga_produk, 0, ',', '.') }}</td>
                        <td>{{ $p->jumlah_produk }}</td>
                    </tr>

                    @php
                        $totalProduk += $p->jumlah_produk;
                        $totalHarga += $p->harga_produk; // Update total harga calculation
                    @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2" class="text-end">Total Produk</th>
                        <td>{{ $totalProduk }}</td>
                    </tr>
                    <tr>
                        <th colspan="2" class="text-end">Total Harga</th>
                        <td>Rp {{ number_format($totalHarga, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('pemesanan') }}" class="btn btn-secondary">Kembali ke Daftar Pesanan</a>
    </div>
</div>

@endsection
