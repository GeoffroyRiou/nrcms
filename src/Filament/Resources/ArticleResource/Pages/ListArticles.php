<?php

namespace GeoffroyRiou\NrCMS\Filament\Resources\ArticleResource\Pages;

use GeoffroyRiou\NrCMS\Filament\Resources\ArticleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListArticles extends ListRecords
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
