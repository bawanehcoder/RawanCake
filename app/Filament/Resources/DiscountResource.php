<?php
namespace App\Filament\Resources;

use App\Filament\Resources\DiscountResource\Pages;
use App\Models\Category;
use App\Models\Discount;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;

class DiscountResource extends Resource
{
    protected static ?string $model = Discount::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationLabel = 'Discounts';
    protected static ?string $navigationGroup = 'Offers and Discounts';

    protected static ?int $navigationSort = 11;


    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([

                Select::make('Type')
                    ->label('Discount Type')
                    ->options([
                        'item' => 'Item',
                        'category' => 'Category',
                    ])
                    ->reactive() // يجعل الحقل يتفاعل عند تغيير القيمة
                    ->afterStateUpdated(fn(callable $set) => $set('Cats', null)), // لإعادة تعيين الحقل الآخر عند تغيير النوع

                Select::make('Cats')
                    ->label('Select Options')
                    ->options(function (callable $get) {
                        if ($get('Type') === 'item') {
                            return \App\Models\Item::all()->pluck('Name', 'id'); // استبدل `Item` بالنموذج المناسب للمنتجات
                        }

                        if ($get('Type') === 'category') {
                            return \App\Models\Category::all()->pluck('Name', 'id');
                        }

                        return [];
                    })
                    ->multiple() // لجعل الحقل يقبل خيارات متعددة
                    ->dehydrateStateUsing(fn($state) => json_encode($state))
                    ->reactive(),

                Forms\Components\DatePicker::make('BeginDate')
                    ->label('Begin Date'),
                Forms\Components\DatePicker::make('EndDate')
                    ->label('End Date'),
                Forms\Components\DatePicker::make('BeginDelivery')
                    ->label('Begin Delivery'),
                Forms\Components\DatePicker::make('EndDelivery')
                    ->label('End Delivery'),
                Forms\Components\TextInput::make('Value')
                    ->label('Discount Value')
                    ->numeric(),
                // Forms\Components\Textarea::make('blob')
                //     ->label('Additional Information'),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('Type')->label('Type'),
                Tables\Columns\TextColumn::make('BeginDate')->label('Begin Date'),
                Tables\Columns\TextColumn::make('EndDate')->label('End Date'),
                Tables\Columns\TextColumn::make('Value')->label('Value'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDiscounts::route('/'),
            'create' => Pages\CreateDiscount::route('/create'),
            'edit' => Pages\EditDiscount::route('/{record}/edit'),
        ];
    }
}
