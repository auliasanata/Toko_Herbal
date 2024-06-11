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
                <div class="card-body" style="display: flex; justify-content: center;">
                    <img src="{{ asset('assets/user/img/fruite-item-5.jpg') }}" alt="logo" style="height: 170px; width: 100px;">
                </div>
            </div>
            <br>

            <div style="display: flex;">

                <div>
                    <p style="display: inline; margin-right: 50px;">Nama Produk </p>
                    <p style="display: inline;">Jati Belanda</p>
                    <br> <br>

                    <p style="display: inline; margin-right: 50px;">Harga produk </p>
                    <p style="display: inline;">Rp 50.000</p>
                    <br> <br>

                    <p style="display: inline; margin-right: 90px;">Kuantitas </p>
                    <p style="display: inline;">2 X</p>
                    <br><br>

                    <p style="display: inline; margin-right: 50px;">Total Harga </p>
                    <p style="display: inline;">Rp 50.00</p>
                    <br> <br>

                    <p style="display: inline; margin-right: 50px;">No Pesanan </p>
                    <p style="display: inline;">-</p>
                    <br> <br>
                </div>


                <div style="margin-right: 150px; margin-left: auto;">
                    <div style="width: 100%;">
                        <p style="display: inline;">Alamat :</p>
                        <p style="display: inline;">Jalan Arifin Ahmad</p>
                        <br> <br>

                        <p style="display: inline;">Metode Pembayaran :</p>
                        <p style="display: inline;">COD</p>
                        <br> <br>

                        <p style="display: inline;">Status Pengiriman :</p>
                        <p style="display: inline;">Sedang Diproses</p>
                        <br><br>

                        <p style="display: inline;">Estimasi :</p>
                        <p style="display: inline;">-</p>
                        <br> <br>
                    </div>


                </div>

            </div>

        </div>



    </div>

    @endsection