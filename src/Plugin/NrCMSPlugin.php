<?php

declare(strict_types=1);

namespace GeoffroyRiou\NrCms\Plugin;

use Filament\Contracts\Plugin;
use Filament\Navigation\NavigationGroup;
use Filament\Panel;
use GeoffroyRiou\NrCms\Filament\Resources\ArticleResource;
use GeoffroyRiou\NrCms\Filament\Resources\CategoryResource;
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
                CategoryResource::class,
                MenuResource::class,
            ])
            ->navigationGroups([
                NavigationGroup::make()
                    ->label(__('Editorial content'))
                    ->icon('heroicon-o-pencil'),
                NavigationGroup::make()
                    ->label(fn(): string => __('navigation.settings'))
                    ->icon('heroicon-o-cog-6-tooth')
                    ->collapsed(),
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
