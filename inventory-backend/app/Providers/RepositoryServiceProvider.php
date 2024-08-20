<?php

namespace App\Providers;

use App\Repositories\Brand\BrandInterface;
use App\Repositories\Brand\BrandRepository;
use App\Repositories\Category\CategoryInterface;
use App\Repositories\Category\CategoryRepository;
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
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
