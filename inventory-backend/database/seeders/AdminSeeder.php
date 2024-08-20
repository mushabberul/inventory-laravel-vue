<?php

namespace Database\Seeders;

use App\Models\User as Admin;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            [
                'role_id' => Admin::ADMIN,
                'name' => "Admin",
                'email' => "admin@gmail.com",
                'phone' => '0178888887',
                'nid' => 'nid-1',
                'address' => 'Gulshan-1',
                'status' => 1,
                'company_name' => "Araced",
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ],

        ];
        Admin::insert($admins);
    }
}
