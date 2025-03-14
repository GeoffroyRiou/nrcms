<?php

namespace GeoffroyRiou\NrCMS\Filament\Resources;

use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('')->schema([
                    self::getCmsSection()
                        ->columnSpan(2),
                    Select::make('parent_id')
                        ->label(__('Parent'))
                        ->options(function (Get $get) {
                            return self::$model::query()
                                ->where('id', '!=', $get('id'))
                                ->get()
                                ->pluck('title', 'id');
                        })
                        ->searchable()
                        ->columnSpan(1)
                ])->columns(3),
                self::getPageBuilderSection(),
            ]);
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
                    ->label(__('Parent path'))
                    ->formatStateUsing(function ($record): string {
                        return $record->getUrlPath(includeSelf: false);
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
                Action::make('go')
                    ->label(__('View'))
                    ->icon('heroicon-o-eye')
                    ->url(fn($record) => $record->getUrl()),
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
