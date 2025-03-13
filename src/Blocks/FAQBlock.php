<?php

namespace GeoffroyRiou\NrCMS\Blocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;

class FAQBlock
{
    public static function make(): Block
    {
        return Block::make('nrcms::page-builder.faq')
            ->label(__('FAQ'))
            ->icon('heroicon-o-question-mark-circle')
            ->schema([
                TextInput::make('title')->label(__('Title')),
                RichEditor::make('text')->label(__('Text')),
                Repeater::make('questions')
                    ->label('')
                    ->itemLabel(fn(array $state): ?string => $state['title'] ?? 'Question')
                    ->schema([
                        TextInput::make('title')->label(__('Title'))->required(),
                        RichEditor::make('text')->label(__('Text'))->required(),
                    ])
                    ->cloneable()
                    ->collapsed()
                    ->collapsible()
                    ->addActionLabel(__('Add another question'))
            ]);
    }
}
