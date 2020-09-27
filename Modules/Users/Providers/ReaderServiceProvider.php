<?php

namespace Users\Providers;

use Doctrine\Common\Annotations\Reader;
use Illuminate\Support\ServiceProvider;

class ReaderServiceProvider extends ServiceProvider
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
        $this->app->bind(Reader::class, function () {
            return new \Doctrine\Common\Annotations\CachedReader(
                new \Doctrine\Common\Annotations\AnnotationReader,
                new \Doctrine\Common\Cache\FilesystemCache(storage_path('framework/cache/doctrine-annotations')),
                env('APP_DEBUG')
            );
        });
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
