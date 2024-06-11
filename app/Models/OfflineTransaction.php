<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfflineTransaction extends Model
{
    use HasFactory;
    protected $fillable = ['obat_id', 'kuantitas', 'sub_harga', 'total_bayar', 'tanggal', 'no_transaksi'];

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'obat_id');
    }
}
