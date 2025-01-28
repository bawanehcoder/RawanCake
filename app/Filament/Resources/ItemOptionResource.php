<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemOptionResource\Pages;
use App\Filament\Resources\ItemOptionResource\RelationManagers;
use App\Filament\Resources\SubOptionsResource\RelationManagers\SubOptionRelationManager;
use App\Models\ItemOption;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemOptionResource extends Resource
{
    protected static ?string $model = ItemOption::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Products and Categories';

    protected static ?string $navigationLabel = 'Products Options';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('Name')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('NameEN')
                ->required()
                ->maxLength(255),
            
                // Forms\Components\TextInput::make('Type')
                // ->maxLength(255),
            // Forms\Components\TextInput::make('DishsetID')
            //     ->numeric()
            //     ->label('Dish Set ID'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('id')->sortable(),
            Tables\Columns\TextColumn::make('Name'),
            Tables\Columns\TextColumn::make('NameEN'),
            // Tables\Columns\TextColumn::make('blob'),
            Tables\Columns\TextColumn::make('Type'),
            // Tables\Columns\TextColumn::make('DishsetID'),
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime(),
            Tables\Columns\TextColumn::make('updated_at')
                ->dateTime(),
        ])
        ->filters([
            //
        ])
        ->actions([
            // Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            // Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            SubOptionRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListItemOptions::route('/'),
            // 'create' => Pages\CreateItemOption::route('/create'),
            // 'edit' => Pages\EditItemOption::route('/{record}/edit'),
        ];
    }
}
