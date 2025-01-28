<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OccasionResource\Pages;
use App\Models\Occasion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OccasionResource extends Resource
{
    protected static ?string $model = Occasion::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationLabel = 'Occasions';
    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 34;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title_ar')
                    ->label('Title (Arabic)')
                    ->required(),
                Forms\Components\TextInput::make('title_en')
                    ->label('Title (English)')
                    ->required(),
                Forms\Components\Textarea::make('description_ar')
                    ->label('Description (Arabic)')
                    ->required(),
                Forms\Components\Textarea::make('description_en')
                    ->label('Description (English)')
                    ->required(),
                Forms\Components\DatePicker::make('date')
                    ->label('Date')
                    ->required(),
                
                Forms\Components\Toggle::make('active')
                    ->label('Active')
                    ->default(true)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title_ar')->label('Title (Arabic)')->searchable(),
                Tables\Columns\TextColumn::make('title_en')->label('Title (English)')->searchable(),
                Tables\Columns\TextColumn::make('date')->label('Date')->date(),
                Tables\Columns\IconColumn::make('active')
                    ->label('Active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')->label('Updated At')->dateTime(),
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
            'index' => Pages\ListOccasions::route('/'),
            'create' => Pages\CreateOccasion::route('/create'),
            'edit' => Pages\EditOccasion::route('/{record}/edit'),
        ];
    }
}
