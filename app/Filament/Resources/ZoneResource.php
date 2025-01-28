<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ZoneResource\Pages;
use App\Filament\Resources\ZoneResource\RelationManagers;
use App\Models\Zones;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ZoneResource extends Resource
{
    protected static ?string $model = Zones::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 30;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('RegionID')
                    ->relationship('region', 'name_en') // assuming a Region model with a "name_en" field exists
                    ->required()
                    ->label('Region'),
                Forms\Components\TextInput::make('AddresAr')
                    ->label('Address (Arabic)')
                    ->required(),
                Forms\Components\TextInput::make('AddresEn')
                    ->label('Address (English)')
                    ->required(),
                Forms\Components\TextInput::make('delivery')
                    ->label('Delivery Cost')
                    ->numeric()
                    ->required(),
                // Forms\Components\FileUpload::make('blob')
                //     ->label('Image'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('region.name_en')->label('Region'),
                Tables\Columns\TextColumn::make('AddresAr')->label('Address (Arabic)'),
                Tables\Columns\TextColumn::make('AddresEn')->label('Address (English)'),
                Tables\Columns\TextColumn::make('delivery')->label('Delivery Cost'),
                Tables\Columns\ImageColumn::make('blob')->label('Image'),
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
            'index' => Pages\ListZones::route('/'),
            'create' => Pages\CreateZone::route('/create'),
            'edit' => Pages\EditZone::route('/{record}/edit'),
        ];
    }
}
