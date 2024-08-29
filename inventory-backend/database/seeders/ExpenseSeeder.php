<?php

namespace Database\Seeders;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $expenses = [
            [
                'expense_category_id'=>ExpenseCategory::select('id')->get()->pluck('id')->random(),
                'staff_id'=>User::select('id')->get()->pluck('id')->random(),
                'amount'=>rand(50,5000),
            ],
            [
                'expense_category_id'=>ExpenseCategory::select('id')->get()->pluck('id')->random(),
                'staff_id'=>User::select('id')->get()->pluck('id')->random(),
                'amount'=>rand(50,5000),
            ],
            [
                'expense_category_id'=>ExpenseCategory::select('id')->get()->pluck('id')->random(),
                'staff_id'=>User::select('id')->get()->pluck('id')->random(),
                'amount'=>rand(50,5000),
            ],
            [
                'expense_category_id'=>ExpenseCategory::select('id')->get()->pluck('id')->random(),
                'staff_id'=>User::select('id')->get()->pluck('id')->random(),
                'amount'=>rand(50,5000),
            ],
        ];

        Expense::insert($expenses);
    }
}
