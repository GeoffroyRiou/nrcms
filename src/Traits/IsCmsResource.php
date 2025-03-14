<?php

declare(strict_types=1);

namespace GeoffroyRiou\NrCMS\Traits;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use GeoffroyRiou\NrCMS\Fields\PageBuilder;
use Illuminate\Support\Str;

trait IsCmsResource
{

    public static function getPageBuilderSection(): Section
    {
        return Section::make('Page Builder')->schema([
            PageBuilder::make('page_blocks')
                ->columnSpanFull()
        ]);
    }

    public static function getCmsSection(): Section
    {
        return Section::make('')
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
            ]);
    }

    public static function getIllustrationField(): FileUpload{
        return FileUpload::make('illustration')
            ->label(__('Illustration'))
            ->image()
            ->maxSize(5*1024)
            ->imagePreviewHeight('250')
    ->loadingIndicatorPosition('left')
    ->panelAspectRatio('2:1.2')
    ->panelLayout('integrated')
    ->removeUploadedFileButtonPosition('right')
    ->uploadButtonPosition('left')
    ->uploadProgressIndicatorPosition('left');
    }
}
