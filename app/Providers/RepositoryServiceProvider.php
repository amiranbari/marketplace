<?php

namespace App\Providers;

use App\Repositories\EloquentRoleRepository;
use App\Repositories\RoleRepositoryInterface;
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
    }
}
