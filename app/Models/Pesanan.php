<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanans';

    protected $fillable = [
        'nama_produk',
        'deskripsi_produk',
        'harga_produk',
        'alamat_lengkap',
        'jumlah_produk',
        'provinsi',
        'opsi_pengiriman',
        'subtotal_pengiriman',
        'subtotal_produk',
        'total_pembayaran',
        'image_produk',
        'bukti_pembayaran',
        'user_id', // Kolom yang akan digunakan untuk kunci asing ke tabel users
        'nama_pengguna',
        'status',
        'no_transaksi',
        'metode_pembayaran',



    ];

    /**
     * Get the user that owns the pesanan.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
