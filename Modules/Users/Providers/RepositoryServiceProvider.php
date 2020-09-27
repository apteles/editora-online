<?php

namespace Users\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\Users\Repositories\UserRepository::class, \Users\Repositories\UserRepositoryEloquent::class);
        $this->app->bind(\Users\Repositories\PermissionRepository::class, \Users\Repositories\PermissionRepositoryEloquent::class);
        $this->app->bind(\Users\Repositories\RoleRepository::class, \Users\Repositories\RoleRepositoryEloquent::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
