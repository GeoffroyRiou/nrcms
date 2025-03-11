<?php

namespace GeoffroyRiou\NrCMS\Resources\PageResource\Pages;

use GeoffroyRiou\NrCMS\Resources\PageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPages extends ListRecords
{
    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
