<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id_from',
        'user_id_to',
        'text',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'user_id_from', 'id');
    }
    public function receiver()
    {
        return $this->belongsTo(User::class, 'user_id_to', 'id');
    }
}
