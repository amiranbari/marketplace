<?php

namespace App\Providers;

use App\Repositories\Role\EloquentRoleRepository;
use App\Repositories\Role\RoleRepositoryInterface;
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
