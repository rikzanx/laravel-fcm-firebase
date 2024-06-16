<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'barang_id',
        'jumlah',
    ];

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function barang(){
        return $this->hasOne(Barang::class,'id','barang_id');
    }
}
