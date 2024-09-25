<?php

namespace App\Providers;

use App\Http\Resources\CustomerResource;
use App\Http\Resources\ExpenseCategoryResource;
use App\Repositories\Brand\BrandInterface;
use App\Repositories\Brand\BrandRepository;
use App\Repositories\Cart\CartInterface;
use App\Repositories\Cart\CartRepository;
use App\Repositories\Category\CategoryInterface;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Customer\CustomerInterface;
use App\Repositories\Customer\CustomerRepository;
use App\Repositories\Expense\ExpenseInterface;
use App\Repositories\Expense\ExpenseRepository;
use App\Repositories\ExpenseCategory\ExpenseCategoryInterface;
use App\Repositories\ExpenseCategory\ExpenseCategoryRepository;
use App\Repositories\Order\OrderInterface;
use App\Repositories\Order\OrderRepository;
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
            CustomerInterface::class,
             CustomerRepository::class
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
        app()->bind(
            CartInterface::class,
            CartRepository::class
        );
        app()->bind(
            OrderInterface::class,
            OrderRepository::class
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
