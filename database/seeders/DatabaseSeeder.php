<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('12345678'),
                'photo' => '1770982207.png'
            ]
        );

        User::firstOrCreate(
            ['email' => 'billsky14@gmail.com'],
            [
                'name' => 'Billy',
                'password' => Hash::make('12345678'),
                'photo' => '1770982207.png'
            ]
        );

        // Product::truncate();
        Product::factory()->count(10)->create();
    }
}
