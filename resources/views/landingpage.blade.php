
@extends('pembeli.masterpembeli')

@section('pembeli')

    <!-- Hero Start -->
    <div class="container-fluid py-5 mb-5 hero-header">
        <div class="container py-12" style="width: 100%;">
            <div class="col-md-12 col-lg-12 mx-auto">
                <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active rounded">
                        <img src="{{ asset('assets/images/iklan3.jpg') }}" class="img-fluid w-100 bg-secondary rounded" alt="First slide" style="height: 500px;">
                        <a href="#" class="btn px-4 py-2 text-white rounded">Herbal Medicine</a>
                    </div>
                    <div class="carousel-item rounded">
                        <img src="{{ asset('assets/user/img/iklan2.jpeg') }}" class="img-fluid w-100 rounded" alt="Second slide" style="height: 500px;">
                        <a href="#" class="btn px-4 py-2 text-white rounded">Herbal Products</a>
                    </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>










  
    <div class="container-fluid vesitable py-5">
        <div class="container py-5">
            <h1 class="mb-0">Best Seller</h1>
            <div class="owl-carousel vegetable-carousel justify-content-center">
                @foreach($pesanans as $pesanan)
                    <div class="border border-primary rounded position-relative vesitable-item">
                        <div class="vesitable-img">
                        @if($pesanan->image_produk)
                        <img src="data:image/jpeg;base64,{{ $pesanan->image_produk }}" alt="logo" style="height: 200px; width:250px;">
                        @else
                        <p>No image available</p>
                        @endif
                        </div>
                        <div class="p-4 rounded-bottom">
                            <h4>{{ $pesanan->nama_produk }}</h4>
                            <p>{{ $pesanan->deskripsi_produk }}</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">Rp{{ $pesanan->harga_produk }} / kg</p>
                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Beli</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection


