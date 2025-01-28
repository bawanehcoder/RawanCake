<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoriesOccasionResource\Pages;
use App\Models\CategoriesOccasion;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;

class CategoriesOccasionResource extends Resource
{
    protected static ?string $model = CategoriesOccasion::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationLabel = 'Categories for Occasions';
    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 33;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name_ar')
                    ->label('Name (Arabic)')
                    ->required(),
                Forms\Components\TextInput::make('name_en')
                    ->label('Name (English)')
                    ->required(),
                
                Forms\Components\TextInput::make('sortIndex')
                    ->label('Sort Index')
                    ->numeric()
                    ->required(),
                Forms\Components\Toggle::make('visible')
                    ->label('Visible')
                    ->default(true)
                    ->required(),

                
                SpatieMediaLibraryFileUpload::make('image')
                    ->collection('categories_occasion')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name_ar')->label('Name (Arabic)')->searchable(),
                Tables\Columns\TextColumn::make('name_en')->label('Name (English)')->searchable(),
                Tables\Columns\TextColumn::make('sortIndex')->label('Sort Index')->sortable(),
                Tables\Columns\IconColumn::make('visible')
                    ->label('Visible')
                    ->boolean(),
                SpatieMediaLibraryImageColumn::make('categories_occasion')->collection('slider'),

                // Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime(),
                // Tables\Columns\TextColumn::make('updated_at')->label('Updated At')->dateTime(),
            ])
            ->filters([])
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
            // أضف العلاقات هنا إذا كانت موجودة
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategoriesOccasions::route('/'),
            'create' => Pages\CreateCategoriesOccasion::route('/create'),
            'edit' => Pages\EditCategoriesOccasion::route('/{record}/edit'),
        ];
    }
}
