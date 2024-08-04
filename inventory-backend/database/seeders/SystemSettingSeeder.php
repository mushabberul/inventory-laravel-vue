<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SystemSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('system_settings')->insert([
            'site_name' => 'Example Site',
            'site_logo' => 'logo.png',
            'site_favicon' => 'favicon.ico',
            'phone' => '123-456-7890',
            'email' => 'info@example.com',
            'address' => '123 Example Street, City, Country',
            'facebook_url' => 'https://facebook.com/example',
            'meta_keywords' => 'example, site, settings',
            'meta_description' => 'This is an example site description.',
        ]);
    }
}
