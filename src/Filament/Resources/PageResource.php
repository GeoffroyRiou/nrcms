<?php

namespace GeoffroyRiou\NrCMS\Filament\Resources;

use Filament\Forms\Components\Select;
use GeoffroyRiou\NrCMS\Filament\Resources\PageResource\Pages;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use GeoffroyRiou\NrCMS\Models\Page;
use GeoffroyRiou\NrCMS\Traits\IsCmsResource;
use Filament\Forms\Set;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;

class PageResource extends Resource
{

    use IsCmsResource;

    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-duplicate';

    protected static function getResourceFields(): array
    {
        return [
            Select::make('parent_id')
                ->label(__('Parent'))
                ->options(function (Get $get) {
                    return self::$model::query()
                        ->where('id', '!=', $get('id'))
                        ->get()
                        ->pluck('title', 'id');
                })
                ->searchable(),
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label(__('Title'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('slug')
                    ->label(__('Path'))
                    ->formatStateUsing(function ($record): string {
                        return $record->ancestorsAndSelf()->pluck('slug')->implode('/');
                    })
                    ->size(TextColumn\TextColumnSize::ExtraSmall)
                    ->color('gray'),
                ToggleColumn::make('published')
                    ->label(__('Published'))
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
