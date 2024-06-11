@extends('layouts.app')

@section('content')

<!-- Menggunakan jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0" style="color: black;">Pemesanan</h1>
    <h3 class="h3 mb-0 text-gray-800 text-sm">Master / Pemesanan</h3>
</div>

<hr>

<!-- Tabel Data Pemesanan -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold">Data Pemesanan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>invoice</th>
                        <th>Nama Pemesan</th>
                        <th>Nama Obat</th>
                        <th>Kuantiti</th>
                        <th>Opsi Bayar</th>
                        <th>Sub Harga</th>
                        <th>Harga kirim</th>
                        <th>Total Bayar</th>
                        <th>Tanggal</th>
                        <th>Bukti Pembayaran</th>
                        <th>Status Pemesanan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no_transaksi_unik = [];
                    @endphp
                    @foreach($pesanan as $pemesanan)
                    @if(!in_array($pemesanan->no_transaksi, $no_transaksi_unik))
                    @php
                    $no_transaksi_unik[] = $pemesanan->no_transaksi;
                    @endphp
                    <tr>
                        <td>{{ $pemesanan->no_transaksi }}</td>
                        <td>{{ $pemesanan->nama_pengguna }}</td>
                        <td>{{ $pemesanan->nama_produk }}</td>
                        <td>{{ $pemesanan->jumlah_produk }}</td>
                        <td>{{ $pemesanan->metode_pembayaran }}</td>
                        <td>{{ $pemesanan->harga_produk }}</td>
                        <td>{{ $pemesanan->subtotal_pengiriman }}</td>
                        <td>{{ $pemesanan->total_pembayaran }}</td>
                        <td>{{ $pemesanan->created_at }}</td>
                        <td class="zoomable-image-container">
                            @if (empty($pemesanan->bukti_pembayaran))
                            COD
                            @else
                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#imageModal{{ $pemesanan->id }}">Lihat Bukti</a>
                            @endif
                        </td>

                        <td>{{ $pemesanan->status }}</td>
                        <td style="display: flex;">
                            <a href="{{ route('pemesanan.show', $pemesanan->no_transaksi) }}" class="btn btn-info">Detail</a>
                            <!-- <a href="{{ route('pemesanan.edit', $pemesanan->id) }}" class="btn btn-primary" style="margin-left: 5px;">Edit</a> -->
                            <form action="{{ route('pemesanan.destroy', $pemesanan->no_transaksi) }}" method="POST" style="margin-left: 5px;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            @if($pemesanan->status !== 'Konfirmasi' && $pemesanan->status !== 'Diterima')
                            <form action="{{ route('pemesanan.konfirmasi', $pemesanan->no_transaksi) }}" method="POST" style="margin-left: 5px;">
                                @csrf
                                <button type="submit" class="btn btn-success">Konfirmasi</button>
                            </form>

                            @endif
                        </td>
                    </tr>

                    <!-- Modal for full-size image -->
                    <div class="modal fade" id="imageModal{{ $pemesanan->id }}" tabindex="-1" aria-labelledby="imageModalLabel{{ $pemesanan->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="imageModalLabel{{ $pemesanan->id }}">Bukti Pembayaran</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <img src="data:image;base64,{{ base64_encode($pemesanan->bukti_pembayaran) }}" class="img-fluid" />
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection