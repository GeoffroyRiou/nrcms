<?php

declare(strict_types=1);

namespace GeoffroyRiou\NrCMS\Providers;

use Illuminate\Support\ServiceProvider;

class NrCMSServiceProvider extends ServiceProvider{

    public function boot(): void
    {
        /**
         * Configuration
         */
        $this->publishes([
            __DIR__ . '/../config/nrcms.php' => config_path('nrcms.php'),
        ]);
        $this->mergeConfigFrom(
            __DIR__ . '/../config/nrcms.php',
            'nrcms'
        );
    }
}