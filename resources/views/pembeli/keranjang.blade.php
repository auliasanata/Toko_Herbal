@extends('pembeli.masterpembeli')

@section('pembeli')

<div class="container-fluid fruite py-5" style="margin-top: -100px;">
    <div class="container py-5">
        <div class="tab-class text-center">
            <div class="row g-4">
                <div class="col-lg-12 text-start">
                    <h1>Keranjang</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            @foreach($pesanan as $item)
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <form action="{{ route('hapusPesanan', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                        </form>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input checkbox-item" type="checkbox" value="{{ $item->id }}" id="checkbox-{{ $item->id }}">
                        <label class="form-check-label" for="checkbox-{{ $item->id }}">
                            <h3>{{ $item->nama_produk }}</h3>
                        </label>
                    </div>
                    <p>{{ $item->deskripsi_produk }}</p>
                    <p>Harga: Rp. {{ $item->harga_produk }}</p>
                    <p>Jumlah: {{ $item->jumlah_produk }}</p>
                    <p class="subtotal">Total: Rp. {{ $item->harga_produk * $item->jumlah_produk }}</p>
                </div>

            </div>
            @endforeach
            <div class="card mb-3">
                <div class="card-body">
                    <h4 id="total">Total Jumlah: Rp. 0</h4>
                </div>
            </div>
            <div>
                <form id="formReview" action="{{ route('reviewBuktiPembayaran') }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-center">
                    @csrf
                    <input type="hidden" name="selected_pesanan" id="selected_pesanan" value="">
                    <input type="hidden" id="metodePembayaran" name="metode_pembayaran">
                    <div class="card mb-3" style="background-color: #E2F4E4; border-radius: 10px; padding: 20px; margin-left:200px;">
                        <h3>Pilih Metode Pembayaran</h3>
                        <select id="paymentMethod" name="metode_pembayaran" class="form-select" style="width: 600px; margin-bottom: 20px;" onchange="showHideUpload()">
                            <option value="COD">Cash on Delivery (COD)</option>
                            <option value="Transfer Bank">Transfer Bank</option>
                        </select>
                        <div id="uploadSection" style="display: none;">
                            <h3>Upload Bukti Pembayaran</h3>
                            <input type="file" id="fileInput" name="bukti_pembayaran" class="form-control" style="width: 600px;">
                        </div>
                        <button type="submit" class="btn border-secondary text-light mt-3" style="background-color:#75AC34">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function showHideUpload() {
        var paymentMethod = document.getElementById('paymentMethod').value;
        var uploadSection = document.getElementById('uploadSection');
        var metodePembayaranInput = document.getElementById('metodePembayaran');

        if (paymentMethod === 'Transfer Bank') {
            uploadSection.style.display = 'block';
            metodePembayaranInput.value = 'Transfer Bank';
            fileInput.required = true; // Buat input file menjadi wajib diisi

        } else {
            uploadSection.style.display = 'none';
            metodePembayaranInput.value = 'COD';
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        var checkboxes = document.querySelectorAll('.checkbox-item');
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', updateTotalAndSelection);
        });

        function updateTotalAndSelection() {
            var total = 0;
            var selectedPesanan = [];
            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    var cardBody = checkbox.closest('.card-body');
                    var subtotalText = cardBody.querySelector('.subtotal').textContent;
                    var subtotal = parseFloat(subtotalText.replace('Total: Rp. ', '').replace(/,/g, ''));
                    total += subtotal;
                    var pesananId = checkbox.value;
                    selectedPesanan.push(pesananId);
                }
            });
            document.getElementById('total').textContent = 'Total Jumlah: Rp. ' + total.toLocaleString();
            document.getElementById('selected_pesanan').value = JSON.stringify(selectedPesanan);
        }
    });
</script>

@endsection