<?php

declare(strict_types=1);

namespace GeoffroyRiou\NrCMS\Providers;

use GeoffroyRiou\NrCMS\Services\MenuService;
use GeoffroyRiou\NrCMS\Services\ReflectionService;
use Illuminate\Support\ServiceProvider;

class NrCMSServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        // Bind the ReflectionService
        $this->app->singleton(ReflectionService::class, function ($app) {
            return new ReflectionService();
        });

        // Bind the MenuService
        $this->app->singleton(MenuService::class, function ($app) {
            return new MenuService($app->make(ReflectionService::class));
        });
    }

    public function boot(): void
    {

        /**
         * Configuration
         */
        $this->publishes([
            __DIR__ . '/../config/nrcms.php' => config_path('nrcms.php'),
        ], 'nrcms');
        $this->mergeConfigFrom(
            __DIR__ . '/../config/nrcms.php',
            'nrcms'
        );

        /**
         * Migrations
         */
        $this->publishesMigrations([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'nrcms');

        /**
         * Views
         */
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'nrcms');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/nrcms'),
        ], ['nrcms','nrcms-views']);

        /**
         * Routes
         */
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }
}
