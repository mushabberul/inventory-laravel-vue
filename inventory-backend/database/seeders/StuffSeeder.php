<?php

namespace Database\Seeders;

use App\Models\User as Stuff;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StuffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stuffs = [
            [
                'role_id' => Stuff::STUFF,
                'name' => "Stuff1",
                'email' => "stuff@gmail.com",
                'phone' => '0178888810',
                'nid' => 'nid-1',
                'address' => 'Gulshan-1',
                'status' => 1,
                'company_name' => "Aracex",
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ],
            [
               'role_id' => Stuff::STUFF,
                'name' => "Stuff2",
                'email' => "stuff2@gmail.com",
                'phone' => '0178888811',
                'nid' => 'nid-1',
                'address' => 'Gulshan-1',
                'status' => 1,
                'company_name' => "Aracex",
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ],
        ];
        Stuff::insert($stuffs);
    }
}
