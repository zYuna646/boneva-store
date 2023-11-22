<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produks extends Model
{
    use HasFactory;

    protected $fillable = [
        'catalog_id',
        'jumlah_produksi'
    ];

    public function catalog()
    {
        return $this->belongsTo(Catalog::class);
    }
}
