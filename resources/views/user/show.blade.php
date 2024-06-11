@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Pengguna</h2>
    <p><strong>Nama:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>No. HP:</strong> {{ $user->no_hp }}</p>
    <p><strong>Alamat:</strong> {{ $user->alamat }}</p>
    <!-- Tambahkan tombol kembali jika diperlukan -->
</div>
@endsection
