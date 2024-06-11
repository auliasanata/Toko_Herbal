<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanansTable extends Migration
{
    public function up()
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->text('deskripsi_produk');
            $table->decimal('harga_produk', 10, 2);
            $table->string('alamat_lengkap');
            $table->integer('jumlah_produk');
            $table->string('provinsi');
            $table->string('opsi_pengiriman');
            $table->decimal('subtotal_pengiriman', 10, 2);
            $table->decimal('subtotal_produk', 10, 2);
            $table->decimal('total_pembayaran', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pesanans');
    }
}
