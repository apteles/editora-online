<?php

namespace Users\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Jrean\UserVerification\UserVerificationServiceProvider;

class UsersServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerMigrationAndSeeds();
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(UserVerificationServiceProvider::class);
        $this->app->register(RepositoryServiceProvider::class);
        $this->app->register(ReaderServiceProvider::class);
        $this->app->register(AuthServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
        $this->registerAnnotations();
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__ . '/../Config/config.php' => config_path('users.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/config.php',
            'users'
        );
    }

    public function registerAnnotations()
    {
        $autoload = require __DIR__ . '/../../../vendor/autoload.php';
        AnnotationRegistry::registerLoader([$autoload, 'loadClass']);
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('resources/views/modules/users');

        $sourcePath = __DIR__ . '/../resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ]);

        $this->loadViewsFrom(\array_merge(\array_map(function ($path) {
            return $path . '/modules/users';
        }, Config::get('view.paths')), [$sourcePath]), 'users');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = base_path('resources/lang/modules/users');

        if (\is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'users');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'users');
        }
    }

    public function registerMigrationAndSeeds()
    {
        $sourcePath = __DIR__ . '/../database/migrations';

        $this->publishes([
            $sourcePath => database_path('migrations')
        ], 'migrations');

        $sourcePath = __DIR__ . '/../database/seeders';

        $this->publishes([
            $sourcePath => database_path('seeds')
        ], 'seeders');
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
