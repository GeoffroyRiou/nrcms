<?php

namespace GeoffroyRiou\NrCMS\Filament\Resources;

use GeoffroyRiou\NrCMS\Filament\Resources\ArticleResource\Pages;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use GeoffroyRiou\NrCMS\Models\Article;
use GeoffroyRiou\NrCMS\Traits\IsCmsResource;

class ArticleResource extends Resource
{

    use IsCmsResource;

    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-bookmark';

    protected static function getResourceFields(): array
    {
        return [];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label(__('Title'))
                    ->sortable()
                    ->searchable(),
                ToggleColumn::make('published')
                    ->label(__('Published'))
                    ->sortable(),
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
