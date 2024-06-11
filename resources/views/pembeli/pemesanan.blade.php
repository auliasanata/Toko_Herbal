@extends('pembeli.masterpembeli')

@section('pembeli')

<!-- Fruits Shop Start-->
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
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card" style="background-color: #E2F4E4; border-radius: 10px;">
                <div class="card-body">

                    <form method="POST" action="/buktipembayaran" enctype="multipart/form-data">
                        @csrf <!-- Tambahkan ini untuk melindungi formulir dari serangan CSRF -->

                        <div style="display: flex; margin-top: 20px;">
                            <div style="height: 250px; width: 250px; margin-left: 10px;">
                                @if($produk->image)
                                <img src="data:image/jpeg;base64,{{ base64_encode($produk->image) }}" alt="Gambar Produk" class="img-fluid w-100 rounded-top">
                                @else
                                <p>Tidak Ada Gambar</p>
                                @endif
                            </div>

                            <input type="hidden" name="image_produk" value="{{ base64_encode($produk->image) }}"> <input type="hidden" name="nama_produk" value="{{ $produk->nama }}">
                            <input type="hidden" name="deskripsi_produk" value="{{ $produk->deskripsi }}">
                            <input type="hidden" name="harga_produk" value="{{ $produk->harga }}">
                            <input type="hidden" name="alamat_lengkap" id="alamat_lengkap_input">
                            <input type="hidden" name="jumlah_produk" id="jumlah_produk_input">
                            <input type="hidden" name="provinsi" id="provinsi_input">
                            <input type="hidden" name="opsi_pengiriman" id="opsi_pengiriman_input">
                            <input type="hidden" name="subtotal_pengiriman" id="subtotal_pengiriman_input">
                            <input type="hidden" name="subtotal_produk" id="subtotal_produk_input">
                            <input type="hidden" name="total_pembayaran" id="total_pembayaran_input">


                            <div style="margin-left: 25px;">
                                <h3>{{ $produk->nama }}</h3>
                                <p>{{ $produk->deskripsi }}</p>
                                <h4 style="display: inline;">Rp. {{ $produk->harga }}</h4>
                                <div style="position: absolute; bottom: 10px; right: 10px;">
                                    <h4 style="display: inline;"></h4>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div>
                <div class="card-body">

                    <div class="form-group mb-4">
                        <label class="form-label">Alamat Lengkap<sup>*</sup></label>
                        <input type="text" class="form-control" id="alamat_lengkap" name="alamat_lengkap" value="{{ Auth::user()->address }}" required>
                    </div>



                    <div class="form-group mb-4">
                        <label class="form-label">Jumlah<sup>*</sup></label>
                        <input type="Number" class="form-control" id="jumlah">
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label">Provinsi</label>
                        <select class="form-control" id="provinsi" name="provinsi">
                            @php
                            $provinces = ['Aceh', 'Bali', 'Sumatera Barat', 'Riau', 'Jambi'];
                            @endphp
                            @foreach ($provinces as $province)
                            <option value="{{ $province }}" {{ Auth::user()->province == $province ? 'selected' : '' }}>
                                {{ $province }}
                            </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group mb-4">
                        <label class="form-label">Pilih Opsi Pengiriman</label>
                        <select class="form-control" id="opsi_pengiriman" name="opsi_pengiriman">
                            <option value="">Pilih Opsi Pengiriman</option>
                            <option value="JNE" selected>JNE (Jalur Nugraha Ekakurir)</option>
                            <option value="J&T">J&T Express</option>
                            <option value="SiCepat">SiCepat Express</option>
                            <!-- Tambahkan opsi pengiriman lainnya sesuai kebutuhan -->
                        </select>
                    </div>

                    <!-- Menampilkan subtotal pengiriman -->
                    <div class="card" style="background-color: #E2F4E4; border-radius: 10px;">
                        <div class="card-body">
                            <div style="display: flex; justify-content: space-between;">
                                <div>Subtotal Pengiriman</div>
                                <div id="subtotal_pengiriman">Rp. 0.00</div>
                            </div>
                        </div>
                    </div>

                    <div class="card" style="background-color: #E2F4E4; border-radius: 10px;">
                        <div class="card-body">
                            <div style="display: flex; justify-content: space-between;">
                                <div>Subtotal Produk</div>
                                <div id="subtotal_produk">Rp. 0.00</div>
                            </div>
                        </div>
                    </div>

                    <div class="card" style="background-color: #E2F4E4; border-radius: 10px;">
                        <div class="card-body">
                            <div style="display: flex; justify-content: space-between;">
                                <div>Total Pembayaran</div>
                                <div id="total_pembayaran">Rp. 0.00</div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="/produk" class="btn border-secondary text-primary" style="background-color: #E2F4E4; width: 45%; display: block; text-align: center; text-decoration: none;">
                            Batal
                        </a>
                        <button type="submit" class="btn border-secondary text-primary" style="background-color: #E2F4E4; width: 45%; display: block; text-align: center; text-decoration: none;" name="buat_pesanan">
                            Buat Pesanan
                        </button>

                        <button type="submit" class="btn border-secondary text-primary" style="background-color: #E2F4E4; width: 45%; display: block; text-align: center; text-decoration: none;" name="keranjang">
                            Keranjang
                        </button>
                    </div>

                    <script>
                        // Logika untuk menghitung subtotal pengiriman
                        document.getElementById('provinsi').addEventListener('change', function() {
                            calculateShipping();
                        });

                        document.getElementById('opsi_pengiriman').addEventListener('change', function() {
                            calculateShipping();
                        });


                        document.getElementById('provinsi').addEventListener('change', function() {
                            calculateShipping();
                        });

                        document.getElementById('opsi_pengiriman').addEventListener('change', function() {
                            calculateShipping();
                        });

                        document.getElementById('jumlah').addEventListener('input', function() {
                            calculateShipping();
                        });

                        document.getElementById('alamat_lengkap').addEventListener('input', function() {
                            document.getElementById('alamat_lengkap_input').value = this.value;
                        });

                        document.getElementById('jumlah').addEventListener('input', function() {
                            document.getElementById('jumlah_produk_input').value = this.value;
                        });

                        document.getElementById('provinsi').addEventListener('change', function() {
                            document.getElementById('provinsi_input').value = this.value;
                        });

                        document.getElementById('opsi_pengiriman').addEventListener('change', function() {
                            document.getElementById('opsi_pengiriman_input').value = this.value;
                        });


                        function calculateShipping() {
                            // Ambil nilai jumlah dari input
                            var jumlah = parseInt(document.getElementById('jumlah').value);

                            // Ambil harga produk dari variabel PHP
                            var harga_produk = parseFloat('{{ $produk->harga }}');

                            // Ambil subtotal pengiriman dari elemen HTML
                            var subtotal_pengiriman = parseFloat(document.getElementById('subtotal_pengiriman').textContent.replace('Rp. ', ''));

                            // Lakukan pengecekan berdasarkan provinsi dan opsi pengiriman yang dipilih
                            var provinsi = document.getElementById('provinsi').value;
                            var opsi_pengiriman = document.getElementById('opsi_pengiriman').value;
                            var subtotal_pengiriman = 0;

                            switch (provinsi) {
                                case 'Aceh':
                                    switch (opsi_pengiriman) {
                                        case 'JNE':
                                            subtotal_pengiriman = 50000;
                                            break;
                                        case 'J&T':
                                            subtotal_pengiriman = 48000;
                                            break;
                                            // Tambahkan opsi pengiriman lainnya di Aceh
                                        default:
                                            break;
                                    }
                                    break;
                                case 'Bali':
                                    switch (opsi_pengiriman) {
                                        case 'JNE':
                                            subtotal_pengiriman = 45000;
                                            break;
                                        case 'J&T':
                                            subtotal_pengiriman = 43000;
                                            break;
                                            // Tambahkan opsi pengiriman lainnya di Bali
                                        default:
                                            break;
                                    }
                                    break;
                                case 'Sumatera Barat':
                                    switch (opsi_pengiriman) {
                                        case 'JNE':
                                            subtotal_pengiriman = 52000;
                                            break;
                                        case 'J&T':
                                            subtotal_pengiriman = 51000;
                                            break;
                                            // Tambahkan opsi pengiriman lainnya di Sumatera Barat
                                        default:
                                            break;
                                    }
                                    break;
                                case 'Riau':
                                    switch (opsi_pengiriman) {
                                        case 'JNE':
                                            subtotal_pengiriman = 48000;
                                            break;
                                        case 'J&T':
                                            subtotal_pengiriman = 47000;
                                            break;
                                            // Tambahkan opsi pengiriman lainnya di Riau
                                        default:
                                            break;
                                    }
                                    break;
                                case 'Jambi':
                                    switch (opsi_pengiriman) {
                                        case 'JNE':
                                            subtotal_pengiriman = 49000;
                                            break;
                                        case 'J&T':
                                            subtotal_pengiriman = 48000;
                                            break;
                                            // Tambahkan opsi pengiriman lainnya di Jambi
                                        default:
                                            break;
                                    }
                                    break;
                                    // Tambahkan case untuk provinsi lainnya di sini
                                default:
                                    break;
                            }

                            // Hitung subtotal produk
                            var subtotal_produk = jumlah * harga_produk;

                            // Hitung total pembayaran
                            var total_pembayaran = subtotal_produk + subtotal_pengiriman;

                            // Tampilkan subtotal produk
                            document.getElementById('subtotal_produk').textContent = 'Rp. ' + subtotal_produk.toFixed(2);

                            // Tampilkan subtotal pengiriman
                            document.getElementById('subtotal_pengiriman').textContent = 'Rp. ' + subtotal_pengiriman.toFixed(2);

                            // Tampilkan total pembayaran
                            document.getElementById('total_pembayaran').textContent = 'Rp. ' + total_pembayaran.toFixed(2);


                            document.getElementById('subtotal_pengiriman_input').value = subtotal_pengiriman.toFixed(2);
                            document.getElementById('subtotal_produk_input').value = subtotal_produk.toFixed(2);
                            document.getElementById('total_pembayaran_input').value = total_pembayaran.toFixed(2);
                        }
                    </script>

                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Fruits Shop End-->

@endsection