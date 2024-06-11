<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_customer');
            $table->unsignedBigInteger('id_obat');
            $table->integer('kualitas');
            $table->string('alamat');
            $table->string('provinsi');
            $table->string('pengirim');
            $table->string('opsi_bayar');
            $table->decimal('sub_harga', 10, 2);
            $table->decimal('sub_kirim', 10, 2);
            $table->decimal('total_bayar', 10, 2);
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pemesanans');
    }
};
