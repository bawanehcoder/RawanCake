<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CouponResource\Pages;
use App\Filament\Resources\CouponResource\RelationManagers;
use App\Models\Coupon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CouponResource extends Resource
{
    protected static ?string $model = Coupon::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('Serial')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('UsedLimit')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('UsedCount')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('FixedDiscount')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('RelativeDiscount')
                    ->numeric()
                    ->default(null),
                Forms\Components\DateTimePicker::make('Expiration')
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('Serial')
                    ->searchable(),
                Tables\Columns\TextColumn::make('UsedLimit')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('UsedCount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('FixedDiscount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('RelativeDiscount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('Expiration')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('blob')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListCoupons::route('/'),
            'create' => Pages\CreateCoupon::route('/create'),
            'edit' => Pages\EditCoupon::route('/{record}/edit'),
        ];
    }
}
