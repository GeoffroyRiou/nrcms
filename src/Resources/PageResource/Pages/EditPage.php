<?php

namespace GeoffroyRiou\NrCMS\Resources\PageResource\Pages;

use GeoffroyRiou\NrCMS\Resources\PageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPage extends EditRecord
{
    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
