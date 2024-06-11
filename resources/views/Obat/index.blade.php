@extends('layouts.app')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0" style="color: black;">Obat</h1>
    <h3 class="h3 mb-0 text-gray-800 text-sm"> Master / Obat</h3>
</div>

<hr>
<br>
</br>

<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
    <div>
        <a href="{{ route('obat.create') }}" class="btn btn-primary mb-3" style="background-color: #75AC34;">
            <i class="fa fa-plus"></i> Tambah Data Obat
        </a>
    </div>
</div>
<hr>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold">Data Obat</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-sm" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th>Bahan</th>
                        <th>Gambar</th>

                        <th>Stock</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($obats as $index => $obat)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $obat->id }}</td>
                        <td>{{ $obat->nama }}</td>
                        <td>{{ $obat->harga }}</td>
                        <td>{{ $obat->deskripsi }}</td>
                        <td>{{ $obat->bahan }}</td>
                        <td><button class="btn btn-info" data-toggle="modal" data-target="#gambarModal_{{ $obat->id }}">Gambar</button></td>

                        <td>{{ $obat->stock }}</td>
                        <td style="display: flex;">
                            <a class="btn btn-primary mr-2" href="{{ route('obat.edit', $obat->id) }}" style="background-color: #75AC34;">Edit</a>
                            <form action="{{ route('obat.destroy', $obat->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger mr-2" style="background-color: #FF0000;">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@foreach($obats as $obat)
<div class="modal fade" id="gambarModal_{{ $obat->id }}" tabindex="-1" role="dialog" aria-labelledby="gambarModalLabel_{{ $obat->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="gambarModalLabel_{{ $obat->id }}">Gambar Obat - {{ $obat->nama }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                @if($obat->image)
                <img src="data:image/jpeg;base64,{{ base64_encode($obat->image) }}" alt="Gambar Obat">
                @else
                Tidak Ada Gambar
                @endif
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection
