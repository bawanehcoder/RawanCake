<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SliderResource\Pages;
use App\Models\Slide;
use App\Models\Slider;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;

class SliderResource extends Resource
{
    protected static ?string $model = Slide::class;

    protected static ?string $navigationLabel = 'Sliders';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    

    protected static ?int $navigationSort = 22;


    public static function form(Form $form): Form
    {   
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Title'),
                Forms\Components\TextInput::make('url')
                    ->label('Text')
                    ->nullable(),
                Forms\Components\TextInput::make('index')
                    ->label('Order Index')
                    ->numeric()
                    ->default(0)
                    ->required(),
                    SpatieMediaLibraryFileUpload::make('image')
                    ->collection('slider')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Title')->searchable(),
                Tables\Columns\TextColumn::make('url')->label('URL'),
                Tables\Columns\TextColumn::make('index')->label('Order Index')->sortable(),
                SpatieMediaLibraryImageColumn::make('Image')->collection('slider'),
                Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime()->sortable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSliders::route('/'),
            'create' => Pages\CreateSlider::route('/create'),
            'edit' => Pages\EditSlider::route('/{record}/edit'),
        ];
    }
}
