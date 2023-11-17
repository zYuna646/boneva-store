<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paymen extends Model
{
    use HasFactory;
    protected $fillable = [
        'bank',
        'nomor_rekening',
        'pemilik_rekening',
    ];
}
