<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Paymen;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'verified' => true,
            'role' => 'admin',
            'no_telp' => '00000',
            'no_wa' => '0000',
            'password' => '12345'
        ]);

        Paymen::create([
            'bank' => 'bni',
            'nomor_rekening' => '120121012',
            'pemilik_rekening' => 'john doe',
        ]);
    }
}
