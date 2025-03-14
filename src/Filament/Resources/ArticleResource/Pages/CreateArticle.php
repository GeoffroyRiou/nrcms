<?php

namespace GeoffroyRiou\NrCms\Filament\Resources\ArticleResource\Pages;

use GeoffroyRiou\NrCms\Filament\Resources\ArticleResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateArticle extends CreateRecord
{
    protected static string $resource = ArticleResource::class;
}
