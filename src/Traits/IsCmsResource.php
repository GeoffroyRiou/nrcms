<?php

declare(strict_types=1);

namespace GeoffroyRiou\NrCMS\Traits;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use GeoffroyRiou\NrCMS\Fields\PageBuilder;
use Illuminate\Support\Str;

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
                        Section::make('')
                            ->schema([
                                Toggle::make('published')
                                    ->label(__('Published'))
                                    ->default(true)
                                    ->columnSpanFull(),
                                TextInput::make('title')
                                    ->label(__('Title'))
                                    ->required()
                                    ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state)))
                                    ->live(onBlur: true),
                                TextInput::make('slug')
                                    ->label(__('Slug'))
                                    ->required()
                            ])->columns(2),
                        Section::make('Page Builder')->schema([
                            PageBuilder::make('page_blocks')
                                ->columnSpanFull()
                        ])
                    ]
                )
            );
    }
}
