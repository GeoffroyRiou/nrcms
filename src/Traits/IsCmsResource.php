<?php

declare(strict_types=1);

namespace GeoffroyRiou\NrCMS\Traits;

use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use GeoffroyRiou\NrCMS\Fields\PageBuilder;

trait IsCmsResource
{

    abstract protected static function getResourceFields(): array;

    public static function form(Form $form): Form
    {
        return $form
            ->schema(
                array_merge(
                    self::getResourceFields(),
                    [
                        Section::make('Page Builder')->schema([
                            PageBuilder::make('page_blocks')
                                ->columnSpanFull()
                        ])
                    ]
                )
            );
    }
}
