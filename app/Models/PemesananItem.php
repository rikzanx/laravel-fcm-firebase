<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananItem extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    protected $fillable = [
        'pemesanan_id',
        'barang_id',
        'harga',
        'jumlah',
        'jumlah_hari',
        'sub_total',
    ];

    public function pemesanan(){
        return $this->hasOne(Pemesanan::class,'id','pemesanan_id');
    }
    public function barang(){
        return $this->hasOne(Barang::class,'id','barang_id');
    }
}
