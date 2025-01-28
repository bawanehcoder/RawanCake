<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConditionalDeliveryResource\Pages;
use App\Models\ConditionalDeliverie;
use App\Models\ConditionalDelivery;
use App\Models\Item;
use App\Models\Zones;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ConditionalDeliveryResource extends Resource
{
    protected static ?string $model = ConditionalDeliverie::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationLabel = 'Conditional Deliveries';
    protected static ?string $navigationGroup = 'Offers and Discounts';

    protected static ?int $navigationSort = 12;


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
                

                    Select::make('items')
                    ->options(function (callable $get) {
                        
                        return Item::all()->pluck('Name', 'id');
                    })
                    ->multiple() // لجعل الحقل يقبل خيارات متعددة
                    ->dehydrateStateUsing(fn ($state) => $state),




                    Select::make('zone_ids')
                    ->options(function (callable $get) {
                        
                        return Zones::all()->pluck('AddresAr', 'id');
                    })
                    ->multiple() // لجعل الحقل يقبل خيارات متعددة
                    ->dehydrateStateUsing(fn ($state) => $state),
                
                Forms\Components\TimePicker::make('start_time')
                    ->label('Start Time')
                    ->required(),
                Forms\Components\TimePicker::make('end_time')
                    ->label('End Time')
                    ->required(),
                Forms\Components\TextInput::make('delivery')
                    ->label('Delivery Cost')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('purchase_value')
                    ->label('Minimum Purchase Value')
                    ->numeric()
                    ->required(),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title_ar')->label('Title (Arabic)')->searchable(),
                Tables\Columns\TextColumn::make('title_en')->label('Title (English)')->searchable(),
                Tables\Columns\TextColumn::make('start_time')->label('Start Time'),
                Tables\Columns\TextColumn::make('end_time')->label('End Time'),
                Tables\Columns\TextColumn::make('delivery')->label('Delivery Cost')->money('USD'),
                Tables\Columns\TextColumn::make('purchase_value')->label('Minimum Purchase Value')->money('USD'),
                Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime(),
            ])
            ->filters([
                // يمكنك إضافة فلاتر هنا إذا كان لديك معايير معينة لتصفيتها
            ])
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
        return [
            // إضافة أي علاقات مرتبطة هنا إن وجدت
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListConditionalDeliveries::route('/'),
            'create' => Pages\CreateConditionalDelivery::route('/create'),
            'edit' => Pages\EditConditionalDelivery::route('/{record}/edit'),
        ];
    }
}
