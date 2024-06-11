<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;

    protected $table = 'pengiriman';
    protected $fillable = ['id', 'pemesanan_id'];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }
}
