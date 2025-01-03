<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    protected $fillable = [
        'kode',
        'nama',
        'foto',
        'deskripsi',
        'harga',
        'stock',
        'stock_ready',
        'stock_booking',
    ];
}
