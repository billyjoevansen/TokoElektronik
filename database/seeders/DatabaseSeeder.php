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
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678')
        ]);

        Product::create([
            'kategori' => 'Iphone',
            'nama_produk' => 'Iphone 13 Pro',
            'harga' => 12000000
        ]);

        Product::create([
            'kategori' => 'Samsung',
            'nama_produk' => 'Samsung X Flip',
            'harga' => 20000000
        ]);

        Product::create([
            'kategori' => 'Xiaomi',
            'nama_produk' => 'Xiaomi Redmi Note 11 Pro',
            'harga' => 3200000
        ]);
        Product::factory()->count(10)->create();
    }
}
