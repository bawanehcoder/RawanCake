<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MobileSliderResource\Pages;
use App\Filament\Resources\MobileSliderResource\RelationManagers;
use App\Models\MobileSlider;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MobileSliderResource extends Resource
{
    protected static ?string $model = MobileSlider::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                SpatieMediaLibraryFileUpload::make('image')
                    ->collection('mobile_slider'),
                TextInput::make('title'),
                Select::make('item_id')
                    ->relationship('item', 'Name')
                    ->searchable()
                    ->preload(),
                    Select::make('category_id')
                    ->relationship('category', 'Name')
                    ->searchable()
                    ->preload(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('image')
                    ->collection('mobile_slider'),

                TextColumn::make('title')

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
            'index' => Pages\ListMobileSliders::route('/'),
            'create' => Pages\CreateMobileSlider::route('/create'),
            'edit' => Pages\EditMobileSlider::route('/{record}/edit'),
        ];
    }
}
