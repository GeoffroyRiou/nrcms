<?php

namespace GeoffroyRiou\NrCMS\Resources\PageResource\Pages;

use GeoffroyRiou\NrCMS\Resources\PageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePage extends CreateRecord
{
    protected static string $resource = PageResource::class;
}
