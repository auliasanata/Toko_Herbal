@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0" style="color: black;">Pengiriman</h1>
    <h3 class="h3 mb-0 text-gray-800 text-sm"> Master / Pengiriman</h3>
</div>

<hr>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold">Data Pengiriman</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama Pemesan</th>
                        <th>Nama Produk</th>
                        <th>Pengiriman</th>
                        <th>Alamat lengkap</th>
                        <th>Provinsi</th>
                        <th>Jumlah Produk</th>
                        <th>Harga Pengiriman</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengirimans->groupBy(function($item) {
                        return $item->nama_pengguna . '-' . $item->alamat_lengkap;
                    }) as $groupedPengirimans)
                        @php
                            $pengiriman = $groupedPengirimans->first();
                        @endphp
                        <tr>
                            <td>{{ $pengiriman->nama_pengguna }}</td>
                            <td>{{ $pengiriman->nama_produk }}</td>
                            <td>{{ $pengiriman->opsi_pengiriman }}</td>
                            <td>{{ $pengiriman->alamat_lengkap }}</td>
                            <td>{{ $pengiriman->provinsi }}</td>
                            <td>{{ $pengiriman->jumlah_produk }}</td>
                            <td>{{ $pengiriman->subtotal_pengiriman }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('pengiriman.show', $pengiriman->id) }}" class="btn btn-info">Detail</a>
                                    <a href="{{ route('pengiriman.edit', $pengiriman->id) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('pengiriman.destroy', $pengiriman->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
