@extends('pembeli.masterpembeli')

@section('pembeli')

<div class="container-fluid fruite py-5" style="margin-top: -100px;">
    <div class="container py-5">
        <div class="tab-class text-center">
            <div class="row g-4">
                <div class="col-lg-4 text-start">
                    <h1>Pemesanan</h1>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" action="/buktipembayaranpesanan" id="pesananForm" enctype="multipart/form-data">
        @csrf

        <!-- Input hidden untuk menyimpan nilai image_produk -->
        <input type="hidden" name="image_produk" value="{{ $image_produk }}">

        <!-- Input tersembunyi untuk data pesanan -->
        <input type="hidden" name="nama_produk" value="{{ $nama_produk }}">
        <input type="hidden" name="deskripsi_produk" value="{{ $deskripsi_produk }}">
        <input type="hidden" name="harga_produk" value="{{ $harga_produk }}">
        <input type="hidden" name="alamat_lengkap" value="{{ $alamat_lengkap }}">
        <input type="hidden" name="jumlah_produk" value="{{ $jumlah_produk }}">
        <input type="hidden" name="provinsi" value="{{ $provinsi }}">
        <input type="hidden" name="opsi_pengiriman" value="{{ $opsi_pengiriman }}">
        <input type="hidden" name="subtotal_pengiriman" value="{{ $subtotal_pengiriman }}">
        <input type="hidden" name="subtotal_produk" value="{{ $subtotal_produk }}">
        <input type="hidden" name="total_pembayaran" value="{{ $total_pembayaran }}">
        <!-- Input tersembunyi untuk menyimpan nilai metode_pembayaran -->
        <input type="hidden" name="metode_pembayaran" id="metode_pembayaran" value="">

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card" style="background-color: #E2F4E4; border-radius: 10px; padding: 20px;">
                    <h3>Pilih Metode Pembayaran</h3>
                    <select id="paymentMethod" class="form-select" style="width: 600px; margin-bottom: 20px;">
                        <option value="COD">Cash on Delivery (COD)</option>
                        <option value="Transfer Bank">Transfer Bank</option>
                    </select>
                    <div id="uploadSection" style="display: none;">
                        <h3>Upload Bukti Pembayaran</h3>
                        <input type="file" id="fileInput" name="bukti_pembayaran" class="form-control" style="width: 600px;">
                    </div>
                    <button type="submit" class="btn border-secondary text-light mt-3" style="background-color:#75AC34">Submit</button>
                </div>
            </div>
        </div>
    </form>

</div>

<script>
    // Ketika halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        var metode_pembayaran = document.getElementById('metode_pembayaran');
        // Set nilai metode_pembayaran menjadi "COD" secara default
        metode_pembayaran.value = 'COD';
    });

    // Ketika opsi pembayaran berubah
    document.getElementById('paymentMethod').addEventListener('change', function() {
        var uploadSection = document.getElementById('uploadSection');
        var fileInput = document.getElementById('fileInput');
        var metode_pembayaran = document.getElementById('metode_pembayaran');

        // Ambil nilai opsi pembayaran yang dipilih
        var selectedOption = this.value;

        // Set nilai metode_pembayaran dengan nilai opsi pembayaran yang dipilih
        metode_pembayaran.value = selectedOption;

        if (selectedOption === 'Transfer Bank') {
            uploadSection.style.display = 'block';
            fileInput.required = true; // Buat input file menjadi wajib diisi
        } else {
            uploadSection.style.display = 'none';
            fileInput.required = false; // Buat input file tidak wajib diisi
            // Set nilai input bukti pembayaran ke path gambar default jika metode pembayaran adalah COD
            document.querySelector('input[name="bukti_pembayaran"]').value = 'assets/images/herbal.png';
        }
    });

    // Validasi sebelum pengiriman formulir
    document.getElementById('pesananForm').addEventListener('submit', function(event) {
        var selectedOption = document.getElementById('paymentMethod').value;
        var fileInput = document.getElementById('fileInput');

        // Jika opsi pembayaran adalah Transfer Bank dan input file belum diisi
        if (selectedOption === 'Transfer Bank' && fileInput.value === '') {
            alert('Mohon unggah bukti pembayaran.');
            event.preventDefault(); // Hentikan pengiriman formulir
        }
    });
</script>


@endsection