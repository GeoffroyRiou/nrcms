<?php

namespace GeoffroyRiou\NrCMS\Filament\Resources;

use Dom\Text;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use GeoffroyRiou\NrCMS\Filament\Resources\MenuResource\Pages;

use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use GeoffroyRiou\NrCMS\Models\Menu;
use GeoffroyRiou\NrCMS\Services\MenuService;
use Saade\FilamentAdjacencyList\Forms\Components\AdjacencyList;
use Illuminate\Support\Str;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';

    public static function form(Form $form): Form
    {
        $menuableeModels = (new MenuService)->getMenuableModels();
        $typesOptions  = [
            'external_link' => __('External link'),
        ];
        $selects = [];
        
        
        foreach ($menuableeModels as $label => $models) {
            $slug = Str::slug($label);
            $typesOptions[$slug] = $label;
            $selects[] = 
            Select::make($slug)
                ->label($label)
                ->options($models)
                ->required()
                ->searchable()
                ->visible(function(Get $get) use ($slug): bool { return  $get('type') == $slug;})
                ->columnSpanFull();
        }
        $itemSchema = array_merge(
            [
                TextInput::make('label')
                    ->label(__('Label'))
                    ->required(),
                ToggleButtons::make('type')
                    ->label(__('Type'))
                    ->options($typesOptions)
                    ->live()
                    ->inline()
                    ->required(),
                TextInput::make('url')
                    ->label(__('Url'))
                    ->required()
                    ->visible(fn(Get $get): bool => $get('type') == 'external_link'),
                Toggle::make('blank')
                    ->label(__('Open in a new tab')),
            ],
            $selects
        );

        return $form
            ->schema([
                TextInput::make('title')
                    ->label(__('Title'))
                    ->required()
                    ->columnSpanFull(),
                AdjacencyList::make('items')
                    ->labelKey('label')
                    ->childrenKey('children')
                    ->form($itemSchema)
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label(__('Title'))
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
