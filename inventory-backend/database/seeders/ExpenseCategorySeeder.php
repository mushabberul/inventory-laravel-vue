<?php

namespace Database\Seeders;

use App\Models\ExpenseCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ExpenseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $expenseCategories = [
            [
                'name'=>'Purchase',
                'slug'=>'purchase',
            ],
            [
                'name'=>'Snacks',
                'slug'=>'snacks',
            ],[
                'name'=>'Electricity Bill',
                'slug'=>'electricity-bill',
            ],[
                'name'=>'Weater Bill',
                'slug'=>'weater-bill',
            ],
        ];

        ExpenseCategory::insert($expenseCategories);
    }
}
