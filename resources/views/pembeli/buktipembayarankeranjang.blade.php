@extends('pembeli.masterpembeli')

@section('pembeli')

<div class="container-fluid py-5">
    <div class="container py-5">
        <h1>Review Bukti Pembayaran</h1>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                @foreach($selectedPesanan as $item)
                <div class="card mb-3">
                    <div class="card-body">
                        <h3>{{ $item->nama_produk }}</h3>
                        <p>{{ $item->deskripsi_produk }}</p>
                        <p>Harga: Rp. {{ $item->harga_produk }}</p>
                        <p>Jumlah: {{ $item->jumlah_produk }}</p>
                        <p>Total: Rp. {{ $item->harga_produk * $item->jumlah_produk }}</p>
                    </div>
                </div>
                @endforeach
                <div class="card mb-3">
                    <div class="card-body">
                        <h4>Total Jumlah: Rp. {{ number_format($totalHarga, 0, ',', '.') }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
