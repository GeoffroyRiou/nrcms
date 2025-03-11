<?php

namespace GeoffroyRiou\NrCMS\Resources;

use GeoffroyRiou\NrCMS\Resources\PageResource\Pages;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use GeoffroyRiou\NrCMS\Models\Page;
use GeoffroyRiou\NrCMS\Traits\IsCmsResource;
use Filament\Forms\Set;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Support\Str;

class PageResource extends Resource
{

    use IsCmsResource;

    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static function getResourceFields(): array
    {
        return [
            Toggle::make('published')
                ->label(__('Published'))
                ->columnSpanFull(),
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
                TextColumn::make('title')->label(__('Title'))
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
