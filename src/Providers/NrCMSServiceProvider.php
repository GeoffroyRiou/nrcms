<?php

declare(strict_types=1);

namespace GeoffroyRiou\NrCMS\Providers;

use Illuminate\Support\Facades\Blade;
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
        
        /**
         * Publish views
         */
        $this->publishes([
            __DIR__ . '/../components' => resource_path('views/components'),
        ], 'nrcms');

        //Blade::anonymousComponentPath(__DIR__.'/../components','nrcms');
    
    }
}