<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'no_pemesanan',
        'total_harga',
        'jumlah_hari',
        'catatan',
        'status'
    ];

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function items()
    {
        return $this->hasMany(PemesananItem::class,'pemesanan_id','id');
    }
}
