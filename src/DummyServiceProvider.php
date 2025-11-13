<?php

namespace Bithoven\Dummy;

use Illuminate\Support\ServiceProvider;

class DummyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Merge config
        $this->mergeConfigFrom(
            __DIR__.'/../config/dummy.php',
            'dummy'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Load routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        // Load migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // Load views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'dummy');

        // Publish config
        $this->publishes([
            __DIR__.'/../config/dummy.php' => config_path('dummy.php'),
        ], 'dummy-config');

        // Publish views
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/dummy'),
        ], 'dummy-views');

        // Publish migrations
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'dummy-migrations');
    }
}
