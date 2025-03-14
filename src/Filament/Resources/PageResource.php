<?php

namespace GeoffroyRiou\NrCMS\Filament\Resources;

use Filament\Forms\Components\Select;
use GeoffroyRiou\NrCMS\Filament\Resources\PageResource\Pages;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use GeoffroyRiou\NrCMS\Models\Page;
use GeoffroyRiou\NrCMS\Traits\IsCmsResource;
use Filament\Tables\Actions\Action;
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
                    ->label(__('Parent.s'))
                    ->formatStateUsing(function ($record): string {
                        return $record->getPath(includeSelf: false);
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
                Action::make('view')
                    ->label(__('View page'))
                    ->icon('heroicon-o-eye')
                    ->color('green')
                    ->url(fn($record) => $record->getUrl()),
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
