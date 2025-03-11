<?php

namespace GeoffroyRiou\NrCMS\Blocks;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Builder\Block;

class RichContentBlock
{
    public static function make(): Block
    {
        return Block::make('page-builder.rich_content')
            ->label(__('Rich Content'))
            ->icon('heroicon-o-newspaper')
            ->schema([
                RichEditor::make('content')->label('')
                    ->required()
                    ->disableToolbarButtons([
                        'attachFiles',
                    ]),
            ]);
    }
}
