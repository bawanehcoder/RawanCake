<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderRejectedResource\Pages;
use App\Filament\Resources\OrderRejectedResource\Pages\ViewOrderReject;
use App\Filament\Resources\OrderRejectedResource\RelationManagers;
use App\Filament\Resources\OrderResource\Pages\ViewUser;
use App\Filament\Resources\OrderResource\RelationManagers\OrderDetailsRelationManager;
use App\Models\Order;
use App\Models\OrderRejected;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderRejectedResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Orders';
    protected static ?string $navigationLabel = 'Rejected';

    protected static ?int $navigationSort = 19;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('Name')
                    ->required(),
                Forms\Components\TextInput::make('Phone')
                    ->required(),

                Hidden::make('UserID')->default(151),
                Forms\Components\Select::make('delivery_type')
                    ->options([
                        'personal_pickup' => 'Personal Pickup',
                        'delivery_address' => 'Delivery Address',
                    ])
                    ->required()
                    ->reactive(), // لتفعيل التفاعل الديناميكي

                Forms\Components\Select::make('ZoneID')
                    ->label('Zone')
                    ->relationship('zone', 'AddresEn')
                    ->required()
                    ->visible(fn(callable $get) => $get('delivery_type') === 'delivery_address'), // يظهر إذا كان نوع الطلب delivery_address

                Forms\Components\Select::make('BranchID')
                    ->label('Branch')
                    ->relationship('branch', 'AddresEn')
                    ->required()
                    ->visible(fn(callable $get) => $get('delivery_type') === 'personal_pickup'), // يظهر إذا كان نوع الطلب personal_pickup
                Forms\Components\DateTimePicker::make('OrderDate')
                    ->required(),
                // Forms\Components\TimePicker::make('DeliveryTime')
                //     ->required(),

                // Forms\Components\TextInput::make('Phone2'),
                Forms\Components\TextInput::make('address')
                    ->required(),



                
                // Forms\Components\TextInput::make('ZonePrice')
                //     ->numeric()
                //     ->required(),
                // Forms\Components\TextInput::make('Total')
                //     ->numeric()
                //     ->required(),
                // Forms\Components\TextInput::make('AddValue')
                //     ->numeric(),
                // Forms\Components\TextInput::make('Discount')
                //     ->numeric(),
                // Forms\Components\TextInput::make('Points')
                //     ->numeric(),
                // Forms\Components\Select::make('Status')
                //     ->options([
                //         0 => 'Waiting',
                //         1 => 'Accepted',
                //         2 => 'Rejected',
                //         3 => 'Cancel',
                //         4 => 'invoiced',
                //     ])
                //     ->disabled()
                //     ->default('pending'),
                Forms\Components\Select::make('PaymentMethod')
                
                    ->options([
                        0 => 'Cash',
                        1 => 'Credit Card',
                    ]),
                // Forms\Components\TextInput::make('PaymentNo'),
                // Forms\Components\TextInput::make('PaymentData'),
                // Forms\Components\Select::make('PaymentStatus')
                //     ->options([
                //         'paid' => 'Paid',
                //         'unpaid' => 'Unpaid',
                //     ])
                //     ->default('unpaid'),
                // Forms\Components\TextInput::make('BranchID'),
                // Forms\Components\TextInput::make('Source'),
                Forms\Components\Textarea::make('Note'),
                // Forms\Components\Hidden::make('blob'), // استخدام حقل مخفي 
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::query()->where('Status', 2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('5s')
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                // Tables\Columns\TextColumn::make('zone.name')->label('Zone ID'),
                // Tables\Columns\TextColumn::make('delivery_type')->label('Delivery Type'),
                Tables\Columns\TextColumn::make('OrderDate')->label('Order Date'),
                Tables\Columns\TextColumn::make('DeliveryTime')->label('Delivery Time'),
                Tables\Columns\TextColumn::make('Name')->label('Customer Name'),
                Tables\Columns\TextColumn::make('Phone')->label('Phone'),
                // Tables\Columns\TextColumn::make('Phone2')->label('Alternate Phone'),
                // Tables\Columns\TextColumn::make('address')->label('Address'),
                // Tables\Columns\TextColumn::make('ZonePrice')->label('Zone Price'),
                Tables\Columns\TextColumn::make('Total')->label('Total Amount'),
                // Tables\Columns\TextColumn::make('Discount')->label('Discount'),
                Tables\Columns\TextColumn::make('Status')->label('Status'),
                Tables\Columns\TextColumn::make('PaymentMethod')->label('Payment Method'),
                Tables\Columns\TextColumn::make('Source')->label('Source')

                // Tables\Columns\TextColumn::make('PaymentStatus')->label('Payment Status'),
            ])
            ->filters([


                SelectFilter::make('Branch')->relationship('Branch', 'AddresAr'),
                Filter::make('created_at')
                    ->form([
                        TextInput::make('name'),
                        TextInput::make('phone_number'),
                        DatePicker::make('created_from'),
                        DatePicker::make('created_until'),
                    ])->columnSpan(4)->columns(4)
                    ->query(function (Builder $query, array $data): Builder {
                        return $query

                            ->when(
                                $data['name'],
                                fn(Builder $query, $date): Builder => $query->where(
                                    'name',
                                    'LIKE',
                                    "%{$data['name']}%",
                                ),
                            )

                            ->when(
                                $data['phone_number'],
                                fn(Builder $query, $date): Builder => $query->where(
                                    'phone',
                                    'LIKE',
                                    "%{$data['phone_number']}%",
                                ),
                            )

                            ->when(
                                $data['created_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })

            ], FiltersLayout::AboveContent)
            ->actions([
                // Tables\Actions\EditAction::make(),
                Action::make('reactivate')
                    ->label('Reactivate')
                    ->button()
                    ->color('success')
                    ->icon('heroicon-o-check')
                    // ->modalHeading('Select Branch')
                    ->action(function ($record, array $data) {
                        $record->update([
                            'Status' => 'waiting',
                            // 'BranchID' => $data['branch_id'],
                        ]);
                    })
                    ->requiresConfirmation(),

                    Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            OrderDetailsRelationManager::class

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrderRejecteds::route('/'),
            // 'create' => Pages\CreateOrderRejected::route('/create'),
            // 'edit' => Pages\EditOrderRejected::route('/{record}/edit'),
            'view' => ViewOrderReject::route('/order/{record}'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return count(Order::where('status',2)->get());
    }
}
