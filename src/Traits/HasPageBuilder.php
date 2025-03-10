<?php

declare(strict_types=1);

namespace GeoffroyRiou\NrCMS\Traits;

use Filament\Forms\Form;
use GeoffroyRiou\NrCMS\Fields\PageBuilder;

trait HasPageBuilder
{

    abstract protected static function getResourceFields(): array;

    public static function form(Form $form): Form
    {
        return $form
            ->schema(
                array_merge(
                    self::getResourceFields(),
                    [
                        PageBuilder::make('content')
                            ->columnSpanFull()
                    ]
                )
            );
    }
}
