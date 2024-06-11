@extends('layouts.app')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0" style="color: black;">Transaksi Offline</h1>
    <h3 class="h3 mb-0 text-gray-800 text-sm"> Master / Transaksi Offline</h3>
</div>

<hr>

<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
    <div>
        <a href="{{ route('offline_transactions.create') }}" class="btn btn-primary mb-3" style="background-color: #75AC34;">
            <i class="fa fa-plus"></i> Tambah Data Transaksi Offline
        </a>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold">Data Transaksi Offline</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <!-- <th>ID</th> -->
                        <th>Invoice</th>
                        <th>Nama Obat</th>
                        <th>Kuantitas</th>
                        <th>Sub Harga</th>
                        <th>Total Bayar</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                    <tr>
                        <!-- <td>{{ $transaction->id }}</td> -->
                        <td>{{ $transaction->no_transaksi }}</td>
                        <td>{{ $transaction->obat->nama }}</td>
                        <td>{{ $transaction->kuantitas }}</td>
                        <td>{{ $transaction->sub_harga }}</td>
                        <td>{{ $transaction->total_bayar }}</td>
                        <td>{{ $transaction->tanggal }}</td>
                        <td>
                            <!-- Tambahkan tombol untuk menampilkan, mengedit, dan menghapus transaksi -->
                            <a href="{{ route('offline_transactions.show', $transaction->id) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('offline_transactions.edit', $transaction->id) }}" class="btn btn-primary btn-sm">Edit</a>

                            <!-- Formulir untuk hapus -->
                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $transaction->id }})">Hapus</button>
                            <form id="delete-form-{{ $transaction->id }}" action="{{ route('offline_transactions.destroy', $transaction->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function confirmDelete(id) {
        if (confirm('Anda yakin ingin menghapus transaksi ini?')) {
            event.preventDefault();
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>

@endsection
