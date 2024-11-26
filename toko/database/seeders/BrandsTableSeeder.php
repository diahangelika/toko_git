<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        DB::table('brands')->insert([
            'brand_name' => 'Indofood',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('brands')->insert([
            'brand_name' => 'Miso',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('brands')->insert([
            'brand_name' => 'Ramen',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
