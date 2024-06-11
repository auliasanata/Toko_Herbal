@extends('layouts.app')

@section('content')
<div>
    <h2>Edit Data Obat</h2>
    <form action="{{ route('obat.update', $obat->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama:</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $obat->nama }}" required>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga:</label>
            <input type="text" class="form-control" id="harga" name="harga" value="{{ $obat->harga }}" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi:</label>
            <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{ $obat->deskripsi }}" required>
        </div>
        <div class="mb-3">
            <label for="bahan" class="form-label">Bahan:</label>
            <input type="text" class="form-control" id="bahan" name="bahan" value="{{ $obat->bahan }}" required>
        </div>
        <div class="mb-3">
            <label for="kategori" class="form-label">kategori:</label>
            <input type="text" class="form-control" id="kategori" name="kategori" value="{{ $obat->kategori }}" required>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stock:</label>
            <input type="text" class="form-control" id="stock" name="stock" value="{{ $obat->stock }}" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Gambar:</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
