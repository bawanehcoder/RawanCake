<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfferResource\Pages;
use App\Filament\Resources\OfferResource\RelationManagers;
use App\Models\Offer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OfferResource extends Resource
{
    protected static ?string $model = Offer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    protected static ?string $navigationGroup = 'Offers and Discounts';

    protected static ?string $navigationLabel = 'Offers';
    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('ItemID')
                ->searchable()
                ->relationship('item', 'Name')  // assuming an Item model with a "Name" field exists
                ->required()
                ->label('Item'),
            Forms\Components\DatePicker::make('BeginDate')
                ->required()
                ->label('Begin Date'),
            Forms\Components\DatePicker::make('EndDate')
                ->required()
                ->label('End Date'),
            Forms\Components\TextInput::make('FixedDiscount')
                ->numeric()
                ->label('Fixed Discount'),
            Forms\Components\TextInput::make('RelativeDiscount')
                ->numeric()
                ->label('Relative Discount (%)')
                ->placeholder('Enter as a percentage (e.g., 20 for 20%)'),
            // Forms\Components\TextInput::make('NewPrice')
            //     ->numeric()
            //     ->label('New Price'),
            // Forms\Components\FileUpload::make('blob')
            //     ->label('Image'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('item.Name')->label('Item'),
            Tables\Columns\TextColumn::make('BeginDate')->label('Begin Date')->date(),
            Tables\Columns\TextColumn::make('EndDate')->label('End Date')->date(),
            Tables\Columns\TextColumn::make('FixedDiscount')->label('Fixed Discount'),
            Tables\Columns\TextColumn::make('RelativeDiscount')->label('Relative Discount (%)'),
            Tables\Columns\TextColumn::make('NewPrice')->label('New Price'),
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
            'index' => Pages\ListOffers::route('/'),
            'create' => Pages\CreateOffer::route('/create'),
            'edit' => Pages\EditOffer::route('/{record}/edit'),
        ];
    }
}
