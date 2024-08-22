<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User as Customar;
use Illuminate\Support\Facades\Hash;

class CustomarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customars = [
            [
                'role_id' => Customar::CUSTOMAR,
                'name' => "Customar1",
                'email' => "customar1@gmail.com",
                'phone' => '0158888888',
                'password' => Hash::make('password'),
            ],
            [
                'role_id' => Customar::CUSTOMAR,
                'name' => "Customar2",
                'email' => "customar2@gmail.com",
                'phone' => '0158888889',
                'password' => Hash::make('password'),
            ],
        ];
        Customar::insert($customars);
    }
}
