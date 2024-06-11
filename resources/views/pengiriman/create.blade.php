@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Data Pengiriman</h2>
    <form action="{{ route('pengiriman.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="id" class="form-label">ID:</label>
            <input type="text" class="form-control" id="id" name="id" required>
        </div>
        <div class="mb-3">
            <label for="pemesanan_id" class="form-label">ID Pemesanan:</label>
            <select class="form-control" id="pemesanan_id" name="pemesanan_id" required>
                @foreach($pemesanans as $pemesanan)
                @if($pemesanan->status_pemesanan == 'Konfirmasi')

                <option value="{{ $pemesanan->id }}">{{ $pemesanan->id }}</option>
                @endif

                @endforeach
            </select>

        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection