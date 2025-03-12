<?php

namespace GeoffroyRiou\NrCMS\Filament\Resources;

use Filament\Forms\Components\TextInput;
use GeoffroyRiou\NrCMS\Filament\Resources\MenuResource\Pages;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use GeoffroyRiou\NrCMS\Models\Menu;
use Saade\FilamentAdjacencyList\Forms\Components\AdjacencyList;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label(__('Title'))
                    ->required()
                    ->columnSpanFull(),
                AdjacencyList::make('items')
                    ->labelKey('label')
                    ->childrenKey('children')
                    ->form([
                        TextInput::make('label')
                            ->label(__('Label'))
                            ->required(),
                        TextInput::make('url')
                            ->label(__('Url'))
                            ->required(),
                    ])
                    ->columnSpanFull()
            ]);
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
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}
