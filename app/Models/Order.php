<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'items',
        'alamat',
        'bukti',
        'method',
    ];

    public function catalog()
    {
        return $this->belongsTo(Catalog::class);
    }
}
