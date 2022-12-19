<?php

namespace App\Providers;

use App\Repositories\Seller\SellerRepositoryInterface;
use App\Repositories\Seller\EloquentSellerRepository;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Repositories\Customer\EloquentCustomerRepository;
use App\Repositories\Role\EloquentRoleRepository;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\SellerProduct\EloquentSellerProductRepository;
use App\Repositories\SellerProduct\SellerProductRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            RoleRepositoryInterface::class,
            EloquentRoleRepository::class
        );

        $this->app->bind(
            CustomerRepositoryInterface::class,
            EloquentCustomerRepository::class
        );

        $this->app->bind(
            SellerRepositoryInterface::class,
            EloquentSellerRepository::class
        );

        $this->app->bind(
            SellerProductRepositoryInterface::class,
            EloquentSellerProductRepository::class
        );
    }
}
