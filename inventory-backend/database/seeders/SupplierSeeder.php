<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\User as Supplier;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            [
                'role_id' => Supplier::SIPPLIER,
                'name' => "Supplier1",
                'email' => "supplier1@gmail.com",
                'phone' => '0178888888',
                'nid' => 'nid-1',
                'address' => 'Gulshan-1',
                'status' => 1,
                'company_name' => "Aracex",
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ],
            [
                'role_id' => Supplier::SIPPLIER,
                'name' => "Supplier2",
                'email' => "supplier2@gmail.com",
                'phone' => '0178888889',
                'nid' => 'nid-1',
                'address' => 'Gulshan-1',
                'status' => 1,
                'company_name' => "Araced",
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ],
        ];
        Supplier::insert($suppliers);
    }
}
