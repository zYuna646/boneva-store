<?php

namespace Database\Seeders;

use App\Models\Paymen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Paymen::create([
            'bank' => 'bni',
            'nomor_rekening' => '120121012',
            'pemilik_rekening' => 'john doe 12345',
        ]);
    }
}
