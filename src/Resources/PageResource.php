<?php

namespace GeoffroyRiou\NrCMS\Resources;

use GeoffroyRiou\NrCMS\Resources\PageResource\Pages;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use GeoffroyRiou\NrCMS\Models\Page;
use GeoffroyRiou\NrCMS\Traits\HasPageBuilder;
use Filament\Forms\Set;
use Illuminate\Support\Str;

class PageResource extends Resource
{

    use HasPageBuilder;

    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static function getResourceFields(): array
    {
        return [
            TextInput::make('title')
                ->label(__('Title'))
                ->required()
                ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state)))
                ->live(onBlur: true),
            TextInput::make('slug')
                ->label(__('Slug'))
                ->required(),
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
