<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produksi_Bahan_Baku extends Model
{
    use HasFactory;

    protected $fillable = [
        'bahan_id',
        'jumlah_produksi'
    ];

    public function bahan()
    {
        return $this->belongsTo(Bahan::class);
    }
}
