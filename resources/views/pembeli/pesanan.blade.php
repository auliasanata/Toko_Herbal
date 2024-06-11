@extends('pembeli.masterpembeli')

@section('pembeli')

<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5" style="margin-top: -100px;">
    <div class="container py-5">
        <div class="tab-class text-center">
            <div class="row g-4">
                <div class="col-lg-4 text-start">
                    <h1>Pesanan</h1>
                </div>
            </div>
        </div>
    </div>

    @php
    $no_transaksi_unik = [];
    @endphp

    @foreach($pesanans as $p)
    @if(!in_array($p->no_transaksi, $no_transaksi_unik))
    <!-- Hanya tampilkan satu kali untuk no_transaksi yang sama -->
    <a href="javascript:void(0)" class="pesanan-link" data-status="{{ $p->status }}" data-no-transaksi="{{ $p->no_transaksi }}" style="text-decoration: none; color: inherit;">
        <div style="display: flex;">
            <div style="width: 248px; height: 169px; margin-left: auto; margin-right: auto; border: radius 1px; border-color:black; display: flex; justify-content: center; align-items: center;">
                @if($p->image_produk)
                <img src="data:image/jpeg;base64,{{ $p->image_produk }}" alt="produk" style="height: 170px; width: 100px;">
                @else
                <p>No image available</p>
                @endif
            </div>

            <div style="margin-right: 150px; margin-left: auto;">
                <table>
                    <tr>
                        <td><strong>Invoice</strong></td>
                        <td style="padding-right: 50px; text-align: right;">{{ $p->no_transaksi }}</td>
                    </tr>
                    <tr>
                        <td><strong>Jumlah Barang</strong></td>
                        <td style="margin-right:-200px">{{ $transaksiCounts[$p->no_transaksi] ?? 1 }}</td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal Pembelian</strong></td>
                        <td style="margin-right:-200px">{{ $p->created_at->format('Y-m-d') }}</td>
                    </tr>
                    @if($p->status == 'Konfirmasi')
                    <tr>
                        <td><strong>Status</strong></td>
                        <td>Dikirim</td>
                    </tr>
                    @elseif($p->status == 'Diterima')
                    <tr>
                        <td><strong>Status</strong></td>
                        <td>Selesai</td>
                    </tr>
                    @endif
                    @if($p->status == 'Konfirmasi')
                    <tr>
                        <td></td>
                        <td>
                            <form action="{{ route('pesanan.diterima', $p->no_transaksi) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Diterima</button>
                            </form>
                        </td>
                    </tr>
                    @endif
                </table>

                @if($p->status !== 'Diterima' && $p->status !== 'Konfirmasi')
                <form action="{{ route('batalPesanan', $p->no_transaksi) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Batalkan Pesanan</button>
                </form>
                @endif

                <form action="{{ route('detailPesanan', $p->no_transaksi) }}" method="GET" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-primary">Detail</button>
                </form>
            </div>
        </div>
    </a>
    <hr>
    @php
    $no_transaksi_unik[] = $p->no_transaksi;
    @endphp
    @endif
    @endforeach

</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var pesananLinks = document.querySelectorAll('.pesanan-link');
        pesananLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                var status = this.getAttribute('data-status');
                var noTransaksi = this.getAttribute('data-no-transaksi');
                if (status === 'konfirmasi') {
                    alert('Maaf, pesanan Anda sudah terkirim.');
                } else {
                    window.location.href = '/detailpesanan?no_transaksi=' + noTransaksi;
                }
            });
        });
    });
</script>

@endsection
