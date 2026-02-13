<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
   public function definition(): array
    {
        $kategori = $this->faker->randomElement(['Iphone', 'Samsung', 'Xiaomi', 'Oppo', 'Vivo']);

        $nama_produk = match($kategori) {
            'Iphone'  => 'iPhone ' . $this->faker->randomElement(['13', '14', '15', '16']) . ' ' . $this->faker->randomElement(['Pro', 'Pro Max', 'Plus']),
            'Samsung' => 'Samsung Galaxy ' . $this->faker->randomElement(['S23', 'S24', 'A55', 'Z Fold 5']),
            'Xiaomi'  => 'Xiaomi ' . $this->faker->randomElement(['14 Ultra', 'Redmi Note 13', 'Poco F6']),
            'Oppo'    => 'Oppo ' . $this->faker->randomElement(['Reno 11', 'Find X7', 'A78']),
            'Vivo'    => 'Vivo ' . $this->faker->randomElement(['V30', 'X100', 'Y100']),
        };

        $thumbnail_produk = match($kategori){
            'Iphone' => '1770855199.jpg' ,
            'Samsung' => '1770855210.jpg' ,
            'Xiaomi' => '1770855216.jpg' ,
            'Oppo' => '1770982283.jpg' ,
            'Vivo' => '1770982304.webp' ,
        };

        return [
            'kategori'    => $kategori,
            'nama_produk' => $nama_produk,
            'harga'       => $this->faker->numberBetween(1000000, 20000000),
            'thumbnail'   => $thumbnail_produk,
            'created_at'  => $this->faker->dateTimeBetween('-6 months', 'now'),
            'updated_at'  => now()
        ];
    }
}
