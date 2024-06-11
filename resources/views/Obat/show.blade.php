@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Detail Obat</h5>
    </div>
    <div class="card-body">
        <p><strong>ID:</strong> {{ $obat->id }}</p>
        <p><strong>Nama:</strong> {{ $obat->nama }}</p>
        <p><strong>Harga:</strong> {{ $obat->harga }}</p>
        <p><strong>Deskripsi:</strong> {{ $obat->deskripsi }}</p>
        <p><strong>Bahan:</strong> {{ $obat->bahan }}</p>
        <p><strong>Stock:</strong> {{ $obat->stock }}</p>
        <!-- Tambahkan informasi tambahan sesuai kebutuhan -->

        <a href="{{ route('obat.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection