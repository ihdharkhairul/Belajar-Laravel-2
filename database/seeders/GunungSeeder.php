<?php

namespace Database\Seeders;

use App\Models\Gunung;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class GunungSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // [nama, lokasi, ketinggian mdpl]
        $daftar = [
            ['Gunung Papandayan', 'Garut', 2665],
            ['Gunung Gede', 'Cianjur', 2958],
            ['Gunung Pangrango', 'Cianjur', 3019],
            ['Gunung Ciremai', 'Kuningan', 3078],
            ['Gunung Cikuray', 'Garut', 2821],
            ['Gunung Burangrang', 'Bandung Barat', 2064],
            ['Gunung Tangkuban Parahu', 'Subang', 2084],
            ['Gunung Guntur', 'Garut', 2249],
            ['Gunung Galunggung', 'Tasikmalaya', 2167],
            ['Gunung Salak', 'Bogor', 2211],
        ];

        foreach ($daftar as [$nama, $lokasi, $tinggi]) {
            $level = $faker->randomElement(['Mudah', 'Sedang', 'Sulit']);

            Gunung::create([
                'nama_gunung'       => $nama,
                'lokasi'            => $lokasi . ', Jawa Barat',
                'ketinggian'        => $tinggi,
                'tingkat_kesulitan' => $level,
                'harga_tiket'       => $faker->numberBetween(15, 50) * 1000,
                'deskripsi'         => 'Jalur pendakian ' . $nama . ' dengan tingkat kesulitan ' . strtolower($level) . '.',
            ]);
        }
    }
}