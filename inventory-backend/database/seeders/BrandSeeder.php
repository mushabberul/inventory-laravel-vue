<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            ['name'=>'HP','slug'=>'hp','code'=>'101'],
            ['name'=>'A4Tech','slug'=>'a4tech','code'=>'102'],
            ['name'=>'Apple','slug'=>'apple','code'=>'103'],
            ['name'=>'Asus','slug'=>'asus','code'=>'104'],
            ['name'=>'Walton','slug'=>'walton','code'=>'105'],
            ['name'=>'Natural','slug'=>'natural','code'=>'106'],
            ['name'=>'Non-Brand','slug'=>'non-brand','code'=>'107'],
            ['name'=>'Unilever','slug'=>'unilever','code'=>'108'],
            ['name'=>'Polar','slug'=>'polar','code'=>'109'],
        ];

        Brand::insert($brands);
    }
}
