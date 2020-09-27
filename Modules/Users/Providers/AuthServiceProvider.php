<?php

namespace Users\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('user-admin', function ($user) {
            return $user->isAdmin();
        });

        Gate::before(function ($user) {
            if ($user->isAdmin()) {
                return true;
            }
        });

        if (!app()->runningInConsole() || app()->runningUnitTests()) {
            $permissionRepository = app(\Users\Repositories\PermissionRepository::class);

            $permissionRepository->pushCriteria(new \Users\Criteria\FindPermissionResourceCriteria());
            $permissions = $permissionRepository->all();

            foreach ($permissions as $p) {
                Gate::define("{$p->name}/{$p->resource_name}", function ($user) use ($p) {
                    return $user->hasRole($p->roles);
                });
            }
        }
    }
}
