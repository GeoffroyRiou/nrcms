<?php

namespace GeoffroyRiou\NrCms\Filament\Resources\ArticleResource\Pages;

use GeoffroyRiou\NrCms\Filament\Resources\ArticleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditArticle extends EditRecord
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
