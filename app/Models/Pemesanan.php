<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;
    protected $table = 'pemesanans';


    protected $fillable = [
        'id',
        'id_customer',
        'id_obat',
        'kualitas',
        'alamat',
        'provinsi',
        'pengirim',
        'opsi_bayar',
        'sub_harga',
        'sub_kirim',
        'total_bayar',
        'tanggal',
        'status',
        'status_pemesanan',


    ];
}
