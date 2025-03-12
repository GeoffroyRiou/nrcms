<?php

declare(strict_types=1);

namespace GeoffroyRiou\NrCMS\Plugin;

use Filament\Contracts\Plugin;
use Filament\Panel;
use GeoffroyRiou\NrCMS\Filament\Resources\MenuResource;
use GeoffroyRiou\NrCMS\Filament\Resources\PageResource;

class NrCMSPlugin implements Plugin
{

    public function getId(): string
    {
        return 'nrcms';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources([
                PageResource::class,
                MenuResource::class,
            ])
            ->pages([
                //
            ]);
    }
 
    public function boot(Panel $panel): void
    {
        //
    }

}
