<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderAcceptResource\Pages;
use App\Filament\Resources\OrderAcceptResource\Pages\ViewOrderAccept;
use App\Filament\Resources\OrderAcceptResource\RelationManagers;
use App\Filament\Resources\OrderResource\RelationManagers\OrderDetailsRelationManager;
use App\Http\Controllers\Admin\OrdersController;
use App\Models\Branche;
use App\Models\Order;
use App\Models\OrderAccept;
use App\Models\Zones;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\Component;

class OrderAcceptResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Orders';
    protected static ?string $navigationLabel = 'Accepted';

    protected static ?int $navigationSort = 17;

    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::query()->where('status', 1);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('Name')
                    ->required(),
                    Forms\Components\TextInput::make('Phone')
                    ->required(),

                    Forms\Components\TextInput::make('user_email')
                    ->readonly(),

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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),

                Tables\Columns\TextColumn::make('created_at')->label('Order Date'),
                Tables\Columns\TextColumn::make('OrderDate')->label('Delivery Date'),
                Tables\Columns\TextColumn::make('DeliveryTime')->label('Delivery Time'),
                Tables\Columns\TextColumn::make('Name')->label('Customer Name'),
                Tables\Columns\TextColumn::make('Phone')->label('Phone'),
                Tables\Columns\TextColumn::make('user_email')->label('User Email'),
                Tables\Columns\TextColumn::make('Total')->label('Total Amount'),
                Tables\Columns\TextColumn::make('Status')->label('Status'),
                Tables\Columns\TextColumn::make('PaymentMethod')->label('Payment Method'),
                Tables\Columns\TextColumn::make('PaymentNo')->label('Payment No'),

                Tables\Columns\TextColumn::make('Source')->label('Source')

            ])
            ->filters([
                Filter::make('created_at')
                    ->form([
                        Forms\Components\Select::make('zone')
                            ->searchable(true)
                            ->preload(true)
                            ->options(fn() => Zones::pluck('AddresEn', 'id')),

                        Forms\Components\Select::make('Branch')
                            ->searchable(true)
                            ->preload(true)
                            ->options(fn() => Branche::pluck('AddresEn', 'id')),

                        TextInput::make('name'),
                        Forms\Components\Select::make('delivery_type')
                            ->options([
                                'personal_pickup' => 'Personal Pickup',
                                'delivery_address' => 'Delivery Address',
                            ]),
                        TextInput::make('phone_number'),
                        DatePicker::make('created_from'),
                        DatePicker::make('created_until'),
                        DatePicker::make('del_from')->label('Delivery Form'),
                        DatePicker::make('del_until')->label('Delivery Until'),
                    ])->columnSpan(5)->columns(3)
                    ->query(function (Builder $query, array $data): Builder {
                        return $query

                            ->when(
                                $data['zone'],
                                fn(Builder $query, $date): Builder => $query->where(
                                    'ZoneID',
                                    '=',
                                    $data['zone'],
                                ),
                            )

                            ->when(
                                $data['Branch'],
                                fn(Builder $query, $date): Builder => $query->where(
                                    'BranchID',
                                    '=',
                                    $data['Branch'],
                                ),
                            )

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
                            )
                            ->when(
                                $data['delivery_type'],
                                fn(Builder $query, $date): Builder => $query->where('delivery_type', $date),
                            )
                            

                            ->when(
                                $data['del_from'] ?? null,
                                fn(Builder $query, $date) => $query->where('OrderDate', '>=', $date)
                            )
                            ->when(
                                $data['del_until'] ?? null,
                                fn(Builder $query, $date) => $query->where('OrderDate', '<=', $date)
                            );
                            
                    })

            ], FiltersLayout::AboveContent)
            ->actions([
                // Tables\Actions\EditAction::make(),

                Action::make('invoice')
                ->label('invoice')
                
                ->button()
                ->color('success')
                ->icon('heroicon-o-check')
                ->modalHeading('Accept Order')
                ->action(function ($record, array $data) {
                    $record->update([
                        'Status' => 'invoiced',
                    ]);
                    OrdersController::closebill($record);
                    // \Log::info('alaa');
                })

                ->requiresConfirmation(),



                Action::make('reject')
                    ->label('Reject')
                    ->button()
                    ->color('danger')
                    ->icon('heroicon-o-exclamation-triangle')
                    // ->modalHeading('Select Branch')
                    ->action(function ($record, array $data) {
                        $record->update([
                            'Status' => 'rejected',
                            // 'BranchID' => $data['branch_id'],
                        ]);
                    })
                    // ->form([
                    //     Forms\Components\Select::make('branch_id')
                    //         ->label('Branch')
                    //         ->options(fn() => \App\Models\Branche::pluck('AddresEn', 'id'))
                    //         ->required()
                    //         ->searchable()
                    //         ->placeholder('Select Branch'),
                    // ])
                    ->requiresConfirmation(),

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
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),

                BulkAction::make('Print Labels')

                    ->action(
                        function (Collection $records, Component $livewire) {
                            $recordIds = $records->pluck('id')->toArray();
                            $ids = implode('-', $recordIds);


                            // dd($ids);
                            $livewire->js('window.open(\' ' . route('orders.prints', $ids) . ' \', \'_blank\');');
                            // return redirect()->route('orders.prints',$ids);
                        }
                    )
                    ->openUrlInNewTab(),
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
            'index' => Pages\ListOrderAccepts::route('/'),
            'create' => Pages\CreateOrderAccept::route('/create'),
            // 'edit' => Pages\EditOrderAccept::route('/{record}/edit'),
            'view' => ViewOrderAccept::route('/order/{record}'),

        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return count(Order::where('status',1)->get());
    }
}
