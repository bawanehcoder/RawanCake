<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApplicationGiftResource\Pages;
use App\Models\ApplicationGift;
use App\Models\Item;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ApplicationGiftResource extends Resource
{
    protected static ?string $model = ApplicationGift::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';

    protected static ?string $navigationLabel = 'Application Gifts';
    protected static ?string $navigationGroup = 'Offers and Discounts';

    protected static ?int $navigationSort = 13;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('GiftMessage')
                    ->label('Gift Message')
                    ->required(),
                Forms\Components\Toggle::make('Enabled')
                    ->label('Enabled')
                    ->default(true)
                    ->required(),
                Forms\Components\Select::make('GiftType')
                    ->label('Gift Type')
                    ->options([
                        0 => 'Discount',
                        1 => 'Product',
                    ])
                    ->required(),
                Select::make('ProductID')
                ->searchable()
                    ->options(function (callable $get) {
                        
                        return Item::all()->pluck('Name', 'id');
                    })
                    ->dehydrateStateUsing(fn ($state) => $state),
                Forms\Components\TextInput::make('FixedDiscount')
                    ->label('Fixed Discount')
                    ->numeric()
                    ->nullable(),
                Forms\Components\TextInput::make('RelativeDiscount')
                    ->label('Relative Discount (%)')
                    ->numeric()
                    ->nullable(),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('GiftMessage')->label('Gift Message')->limit(50),
                Tables\Columns\IconColumn::make('Enabled')
                    ->label('Enabled')
                    ->boolean(),
                Tables\Columns\TextColumn::make('GiftType')->label('Gift Type'),
                Tables\Columns\TextColumn::make('ProductID')->label('Product ID')->sortable(),
                Tables\Columns\TextColumn::make('FixedDiscount')->label('Fixed Discount')->sortable(),
                Tables\Columns\TextColumn::make('RelativeDiscount')->label('Relative Discount (%)')->sortable(),
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
            // يمكنك إضافة علاقات أخرى هنا إذا كانت موجودة
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListApplicationGifts::route('/'),
            'create' => Pages\CreateApplicationGift::route('/create'),
            'edit' => Pages\EditApplicationGift::route('/{record}/edit'),
        ];
    }
}
