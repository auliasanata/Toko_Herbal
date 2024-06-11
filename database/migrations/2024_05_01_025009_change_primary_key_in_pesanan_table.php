<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePrimaryKeyInPesananTable extends Migration
{
    public function up()
    {
        // Tambahkan kolom user_id
        Schema::table('pesanans', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('id');
        });

        // Hapus primary key pada kolom id
        Schema::table('pesanans', function (Blueprint $table) {
            $table->dropPrimary('pesanans_id_primary');
        });

        // Tambahkan primary key pada kolom user_id
        Schema::table('pesanans', function (Blueprint $table) {
            $table->primary('user_id');
        });

        // Tambahkan foreign key constraint untuk user_id
        Schema::table('pesanans', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        // Hapus foreign key constraint untuk user_id
        Schema::table('pesanans', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        // Hapus primary key pada kolom user_id
        Schema::table('pesanans', function (Blueprint $table) {
            $table->dropPrimary(['user_id']);
        });

        // Tambahkan primary key pada kolom id
        Schema::table('pesanans', function (Blueprint $table) {
            $table->primary('id', 'pesanans_id_primary');
        });

        // Hapus kolom user_id
        Schema::table('pesanans', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}

