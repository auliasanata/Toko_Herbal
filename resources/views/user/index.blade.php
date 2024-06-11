@extends('layouts.app')

@section('content')


<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0" style="color: black;">user</h1>
    <h3 class="h3 mb-0 text-gray-800 text-sm"> Master / user</h3>
</div>

<hr>

<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
    <div>
        <a href="{{ route('users.create') }}" class="btn btn-primary mb-3" style="background-color: #75AC34;">
            <i class="fa fa-plus"></i> Tambah Data user
        </a>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold">Data User</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No HP</th>
                        <th>Alamat</th>
                        <th>Password</th>
                        <th>Level</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->no_hp }}</td>
                        <td>{{ $user->alamat }}</td>
                        <td>{{ $user->password }}</td>
                        <td>{{ $user->level }}</td>


                        <td style="display: flex;">
                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-primary" style="margin-right: 5px;">Detail</a>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success" style="margin-right: 5px;">Edit</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
