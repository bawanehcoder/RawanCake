<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GeneralSettingResource\Pages;
use App\Models\GeneralSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GeneralSettingResource extends Resource
{
    protected static ?string $model = GeneralSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static ?string $navigationLabel = 'General Settings';
    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 20;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('Currency')
                    ->label('Currency'),
                Forms\Components\Hidden::make('Visitors')
                    ->label('Visitors Count'),
                Forms\Components\TextInput::make('WhatsApp')
                    ->label('WhatsApp Number')
                    ->tel(),
                Forms\Components\Toggle::make('Coupon')
                    ->label('Enable Coupon')
                    ->required(),
                Forms\Components\Toggle::make('DeliveryFirstOrder')
                    ->label('Free Delivery on First Order')
                    ->required(),
                Forms\Components\TimePicker::make('OrderTime')
                    ->label('Order Time')
                    ->required(),
                Forms\Components\Textarea::make('OrderMessage')
                    ->label('Order Message (Arabic)')
                    ->required(),
                Forms\Components\Textarea::make('OrderMessageEN')
                    ->label('Order Message (English)')
                    ->required(),
                Forms\Components\Textarea::make('Thanks')
                    ->label('Thank You Message (Arabic)')
                    ->required(),
                Forms\Components\Textarea::make('ThanksEN')
                    ->label('Thank You Message (English)')
                    ->required(),
                Forms\Components\TextInput::make('AppVersion')
                    ->label('Application Version')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('Currency')->label('Currency'),
                Tables\Columns\TextColumn::make('Visitors')->label('Visitors'),
                Tables\Columns\TextColumn::make('WhatsApp')->label('WhatsApp Number'),
                Tables\Columns\IconColumn::make('Coupon')
                    ->label('Coupon Enabled')
                    ->boolean(),
                Tables\Columns\IconColumn::make('DeliveryFirstOrder')
                    ->label('Free Delivery on First Order')
                    ->boolean(),
                Tables\Columns\TextColumn::make('OrderTime')->label('Order Time'),
                Tables\Columns\TextColumn::make('AppVersion')->label('App Version'),
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
            'index' => Pages\ListGeneralSettings::route('/'),
            'create' => Pages\CreateGeneralSetting::route('/create'),
            'edit' => Pages\EditGeneralSetting::route('/{record}/edit'),
        ];
    }
}
