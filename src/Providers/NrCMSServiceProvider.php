<?php

declare(strict_types=1);

namespace GeoffroyRiou\NrCMS\Providers;

use Illuminate\Support\ServiceProvider;

class NrCMSServiceProvider extends ServiceProvider
{

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
         * Components
         */
        $this->publishes([
            __DIR__ . '/../components' => resource_path('views/components'),
        ], 'nrcms');
    }
}
