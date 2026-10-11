<?php

namespace Database\Seeders;

use App\Models\Peralatan;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class PeralatanSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // [nama, kategori]
        $daftar = [
            ['Tenda Dome 2 Orang', 'Tenda'],
            ['Tenda Dome 4 Orang', 'Tenda'],
            ['Carrier 60 Liter', 'Tas'],
            ['Carrier 45 Liter', 'Tas'],
            ['Sleeping Bag', 'Tidur'],
            ['Matras Gulung', 'Tidur'],
            ['Kompor Portable', 'Masak'],
            ['Nesting Set', 'Masak'],
            ['Headlamp', 'Penerangan'],
            ['Trekking Pole', 'Aksesori'],
            ['Jas Hujan Ponco', 'Pakaian'],
            ['Matras Tiup', 'Tidur'],
        ];

        foreach ($daftar as [$nama, $kategori]) {
            Peralatan::create([
                'nama_peralatan' => $nama,
                'kategori'       => $kategori,
                'stok'           => $faker->numberBetween(2, 25),
                'harga_sewa'     => $faker->numberBetween(5, 60) * 1000,
            ]);
        }
    }
}