<?php

declare(strict_types=1);

namespace GeoffroyRiou\NrCms\Plugin;

use Filament\Contracts\Plugin;
use Filament\Panel;
use GeoffroyRiou\NrCms\Filament\Resources\ArticleResource;
use GeoffroyRiou\NrCms\Filament\Resources\MenuResource;
use GeoffroyRiou\NrCms\Filament\Resources\PageResource;

class NrCmsPlugin implements Plugin
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
                ArticleResource::class,
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
