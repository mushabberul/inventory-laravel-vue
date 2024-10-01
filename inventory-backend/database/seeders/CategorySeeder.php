<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Cloths',
                'slug' => Str::slug('Cloths'),
                'code'=>101,
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Electronic',
                'slug' => Str::slug('Electronic'),
                'code'=>102,
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Man',
                'slug' => Str::slug('man'),
                'code'=>103,
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Woman',
                'slug' => Str::slug('woman'),
                'code'=>104,
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Grocery',
                'slug' => Str::slug('Grocery'),
                'code'=>105,
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
