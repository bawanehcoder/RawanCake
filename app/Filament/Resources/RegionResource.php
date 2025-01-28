<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegionResource\Pages;
use App\Filament\Resources\RegionResource\RelationManagers;
use App\Models\Region;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RegionResource extends Resource
{
    protected static ?string $model = Region::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 31;

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('name_ar')
                ->label('Name (Arabic)')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('name_en')
                ->label('Name (English)')
                ->required()
                ->maxLength(255),
            // Forms\Components\TextInput::make('blob')
            //     ->label('Blob')
            //     ->maxLength(255),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('id')->sortable(),
            Tables\Columns\TextColumn::make('name_ar')->label('Name (Arabic)'),
            Tables\Columns\TextColumn::make('name_en')->label('Name (English)'),
            Tables\Columns\TextColumn::make('blob')->label('Blob'),
            Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime(),
            Tables\Columns\TextColumn::make('updated_at')->label('Updated At')->dateTime(),
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListRegions::route('/'),
            'create' => Pages\CreateRegion::route('/create'),
            'edit' => Pages\EditRegion::route('/{record}/edit'),
        ];
    }
}
