@extends('layouts.app')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0" style="color: black;">Pemesanan</h1>
    <h3 class="h3 mb-0 text-gray-800 text-sm"> Master / Pemesanan</h3>
</div>

<hr>

<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
   
    <form>
        @csrf
        <input type="hidden" name="selected_ids" value="">
        <button type="submit" class="btn btn-primary" name="delete">Hapus yang Dipilih</button>
        <button type="submit" class="btn btn-success" name="konfirmasi">Konfirmasi yang Dipilih</button>
    </form>
</div>



<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold">Data Pemesanan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="checkAll"></th>
                        <th>ID</th>
                        <th>ID Customer</th>
                        <th>ID Obat</th>
                        <th>Kualitas</th>
                        <th>Alamat</th>
                        <th>Provinsi</th>
                        <th>Pengirim</th>
                        <th>Opsi Bayar</th>
                        <th>Sub Harga</th>
                        <th>Sub Kirim</th>
                        <th>Total Bayar</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Status Pemesanan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="checkbox" name="selected_ids[]" ></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        
                       
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.getElementById('checkAll').onclick = function() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    };

    // Menggunakan event click pada tombol submit untuk mengatur nilai input selected_ids
    document.querySelectorAll('button[type="submit"]').forEach(function(button) {
        button.addEventListener('click', function(event) {
            var selectedIds = [];
            var checkboxes = document.querySelectorAll('input[name="selected_ids[]"]:checked');
            for (var checkbox of checkboxes) {
                selectedIds.push(checkbox.value);
            }
            document.querySelector('input[name="selected_ids"]').value = selectedIds.join(',');
        });
    });
</script>

@endsection