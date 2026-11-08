<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 5; $i++) {
            DB::table('users')->insert([
                'name'       => $faker->name,
                'email'      => $faker->unique()->safeEmail,
                'password'   => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        DB::table('users')->updateOrInsert(
            ['email' => 'admin@hikerbest.com'],
            [
                'name'       => 'Admin HikerBest',
                'role'       => 'admin',
                'password'   => Hash::make('admin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('users')->updateOrInsert(
            ['email' => 'user@hikerbest.com'],
            [
                'name'       => 'User HikerBest',
                'role'       => 'user',
                'password'   => Hash::make('user123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}