<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $faker = \Faker\Factory::create();

        // for ($i = 0; $i < 15; $i++) {
        //     DB::table('products')->insert([
        //         'name' => $faker->word, // Generate a random word for product name
        //         'price' => $faker->randomFloat(2, 1000, 50000), // Generate a price between 1000 and 50000
        //         'stock' => $faker->numberBetween(1, 100), // Generate stock between 1 and 100
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // }
        $now = now();
        DB::table('products')->insert([
            'name' => 'Miso sup',
            'category_id'=> 1,
            'brand_id' => 2,
            'price' => 5000,
            'stock' => 50,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('products')->insert([
            'name' => 'Teh Pucuk',
            'category_id'=> 2,
            'brand_id' => 1,
            'price' => 15000,
            'stock' => 40,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
