<?php

namespace App\Providers;

use App\Http\Resources\CustomarResource;
use App\Http\Resources\ExpenseCategoryResource;
use App\Repositories\Brand\BrandInterface;
use App\Repositories\Brand\BrandRepository;
use App\Repositories\Category\CategoryInterface;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Customar\CustomarInterface;
use App\Repositories\Customar\CustomarRepository;
use App\Repositories\Expense\ExpenseInterface;
use App\Repositories\Expense\ExpenseRepository;
use App\Repositories\ExpenseCategory\ExpenseCategoryInterface;
use App\Repositories\ExpenseCategory\ExpenseCategoryRepository;
use App\Repositories\Product\ProductInterface;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Salary\SalaryInterface;
use App\Repositories\Salary\SalaryRepository;
use App\Repositories\Staff\StaffInterface;
use App\Repositories\Staff\StaffRepository;
use App\Repositories\Supplier\SupplierInterface;
use App\Repositories\Supplier\SupplierRepository;
use App\Repositories\SystemSetting\SystemSettingInterface;
use App\Repositories\SystemSetting\SystemSettingRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            SystemSettingInterface::class,
            SystemSettingRepository::class,
        );

        app()->bind(
            CategoryInterface::class,
            CategoryRepository::class
        );
        app()->bind(
            BrandInterface::class,
            BrandRepository::class
        );
        app()->bind(
            SupplierInterface::class,
            SupplierRepository::class
        );
        app()->bind(
            CustomarInterface::class,
             CustomarRepository::class
        );
        app()->bind(
            StaffInterface::class,
            StaffRepository::class
        );
        app()->bind(
            ProductInterface::class,
            ProductRepository::class
        );
        app()->bind(
            ExpenseCategoryInterface::class,
            ExpenseCategoryRepository::class
        );
        app()->bind(
            ExpenseInterface::class,
            ExpenseRepository::class
        );
        app()->bind(
            SalaryInterface::class,
            SalaryRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
