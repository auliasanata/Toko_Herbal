@extends('pembeli.masterpembeli')

@section('pembeli')

<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5" style="margin-top: -100px;">
    <div class="container py-5">
        <div class="tab-class text-center">
            <div class="row g-4">
                <div class="col-lg-4 text-start">
                    <h1>Produk</h1>
                </div>
            </div>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4">
                                @foreach($produk as $produk)
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="rounded position-relative fruite-item">
                                        <div class="fruite-img">
                                            @if($produk->image)
                                            <img src="data:image/jpeg;base64,{{ base64_encode($produk->image) }}" alt="Gambar Obat" class="img-fluid w-100 rounded-top">
                                            @else
                                            Tidak Ada Gambar
                                            @endif
                                        </div>
                                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">{{ $produk->kategori }}</div>
                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                            <h4>{{ $produk->nama }}</h4>
                                            <p>{{ $produk->deskripsi }}</p>
                                            <div class="d-flex justify-content-between flex-lg-wrap">
                                                <p class="text-dark fs-5 fw-bold mb-0">{{ $produk->harga }}</p>
                                                <!-- Check if the user is authenticated -->
                                                @guest
                                                <a href="/login" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Beli</a>
                                                @else
                                                <a href="/pemesananpembeli/{{ $produk->id }}" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Beli</a>
                                                @endguest
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fruits Shop End-->

@endsection