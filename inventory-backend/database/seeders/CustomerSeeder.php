<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User as Customer;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [
                'role_id' => Customer::CUSTOMER,
                'name' => "Customer1",
                'email' => "customer1@gmail.com",
                'phone' => '0158888888',
                'password' => Hash::make('password'),
            ],
            [
                'role_id' => Customer::CUSTOMER,
                'name' => "Customer2",
                'email' => "customer2@gmail.com",
                'phone' => '0158888889',
                'password' => Hash::make('password'),
            ],
        ];
        Customer::insert($customers);
    }
}
