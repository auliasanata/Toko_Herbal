@extends('layouts.app')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0" style="color: black;">Laporan Penjualan</h1>
    <h3 class="h3 mb-0 text-gray-800 text-sm"> Master / Laporan Penjualan</h3>
</div>

<hr>

<!-- Form Filter -->
<form action="{{ route('laporan_penjualan.index') }}" method="GET">
    <div class="row mb-3 d-flex align-items-end">
        <!-- Input Tanggal Awal -->
        <div class="col-md-3">
            <label for="tanggal_awal" class="form-label">Tanggal Awal:</label>
            <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal" value="{{ request('tanggal_awal') }}" required>
        </div>
        <!-- Input Tanggal Akhir -->
        <div class="col-md-3">
            <label for="tanggal_akhir" class="form-label">Tanggal Akhir:</label>
            <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}" required>
        </div>
        <!-- Input Nama Obat -->
        <div class="col-md-2">
            <label for="nama_obat" class="form-label">Nama Obat:</label>
            <input type="text" class="form-control" id="nama_obat" name="nama_obat" value="{{ request('nama_obat') }}">
        </div>
        <!-- Input Jenis Penjualan -->
        <div class="col-md-2">
            <label for="jenis_penjualan" class="form-label">Jenis Penjualan:</label>
            <select class="form-select" id="jenis_penjualan" name="jenis_penjualan">
                <option value="">Semua</option>
                <option value="Online" {{ request('jenis_penjualan') == 'Online' ? 'selected' : '' }}>Online</option>
                <option value="Offline" {{ request('jenis_penjualan') == 'Offline' ? 'selected' : '' }}>Offline</option>
            </select>
        </div>
        <!-- Tombol Filter -->
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100" style="background-color:#75AC34">Filter</button>
        </div>
    </div>
</form>


<br>

<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
    <div>
        <a href="{{ route('laporan_penjualan.export_pdf', ['tanggal_awal' => request('tanggal_awal'), 'tanggal_akhir' => request('tanggal_akhir')]) }}" class="btn btn-primary mb-4" style="background-color: #75AC34;">
            Download PDF </a>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold">Data Laporan Penjualan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <th>Invoice</th>

                        <th>Nama Obat</th>
                        <th>Kuantiti</th>
                        <th>Harga Satuan</th>
                        <th>Harga Total</th>
                        <th>Jenis Penjualan</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($laporanPenjualan as $laporan)
                    <tr>
                    <td>{{ $laporan['no_transaksi'] }}</td>

                        <td>{{ $laporan['nama_obat'] }}</td>
                        <td>{{ $laporan['kuantitas'] }}</td>
                        <td>{{ $laporan['harga_satuan'] }}</td>
                        <td>{{ $laporan['harga_total'] }}</td>
                        <td>{{ $laporan['jenis_penjualan'] }}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection