<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use App\Models\Item;
use App\Models\ItemOption;
use App\Models\OptionDetil;
use App\Models\Order;
use App\Models\SubOption;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\Summarizers\Summarizer;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\Component;


class OrderDetailsRelationManager extends RelationManager
{
    protected static string $relationship = 'order_details';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('ItemID')
                    ->searchable()
                    ->getOptionLabelUsing(fn ($value): ?string => Item::find($value)?->Name)
                    ->getSearchResultsUsing(function (string $search) {
                        return Item::where('Name', 'LIKE', '%' . $search . '%')
                        
                            ->orWhere('NameEN', 'LIKE', '%' . $search . '%')
                            ->get()
                            ->mapWithKeys(function ($item) {
                                return [
                                    $item->id => "<div style='display: flex; align-items: center;'>
                                            <img src='{$item->getFirstMediaUrl('products', 'small')}' style='width: 40px; height: 40px; border-radius: 4px; margin-right: 10px;' />
                                            <span>{$item->Name}</span>
                                          </div>",
                                ];
                            })->toArray();
                    })->allowHtml()
                    ->reactive()
                    ->afterStateUpdated(function (callable $get, callable $set) {
                        $itemId = $get('ItemID');


                        $optId = OptionDetil::where('ItemID', $itemId)->first() ?? null;


                        $set('OptID', $optId->id ?? null);

                        // جلب السعر الأساسي للمنتج
                        $basePrice = $itemId ? Item::find($itemId)?->Price : 0;

                        $quantity = $get('Quantity') ?? 1;
                        $selectedOptIds = $get('OptID') ?? null;

                        // جلب السعر الأساسي للمنتج
                        $basePrice = $itemId ? Item::find($itemId)?->Price : 0;

                        // حساب القيمة الإضافية للخيارات
                        $additionalValue = OptionDetil::find( $selectedOptIds)->AdditionalValue ?? 0;

                        // تحديث حقل السعر بالسعر الإجمالي
                        $set('Price', ($basePrice + $additionalValue) * $quantity);
                        
                    }),

                TextInput::make('Quantity')
                    ->numeric()
                    ->default(1)
                    ->reactive()
                    ->afterStateUpdated(function (callable $get, callable $set) {
                        $itemId = $get('ItemID');
                        $quantity = $get('Quantity') ?? 1;
                        $selectedOptIds = $get('OptID') ?? null;

                        // جلب السعر الأساسي للمنتج
                        $basePrice = $itemId ? Item::find($itemId)?->Price : 0;

                        // حساب القيمة الإضافية للخيارات
                        $additionalValue = OptionDetil::find( $selectedOptIds)->AdditionalValue ?? 0;

                        // تحديث حقل السعر بالسعر الإجمالي
                        $set('Price', ($basePrice + $additionalValue) * $quantity);

                        




                    }),

                Select::make('OptID')
                    // ->dehydrated(true)
                    ->label('Option')
                    ->getOptionLabelUsing(fn ($value): ?string =>  OptionDetil::whereIn('id',json_decode($value))?->first()?->subOption?->Name ?? '')

                    ->options(function (callable $get) {
                        $itemId = $get('ItemID');
                        if ($itemId) {
                        return OptionDetil::where('ItemID', $itemId)
                            ->get()
                            ->mapWithKeys(function ($item) {
                                return [
                                    $item->id => "<div style='display: flex; align-items: center;'>
                                           
                                            <span>{$item->subOption->Name}</span>
                                            <span> - (+{$item->AdditionalValue})</span>
                                          </div>",
                                ];
                            })->toArray();
                        }
                        return [];
                    })->allowHtml()
                    // ->preload()
                    // ->options(function (callable $get, callable $set) {
                    //     $itemId = $get('ItemID');
                    //     if ($itemId) {
                    //         // الحصول على كل قيم OptID المرتبطة بالـ ItemID من جدول OptionDetil
                    //         $optIds = OptionDetil::where('ItemID', $itemId)->pluck('OptID');

                    //         // استخدام قيم OptID لجلب أسماء subOption من جدول suboption
                    //         return OptionDetil::where('ItemID', $itemId)->pluck('OptID');

                    //         return SubOption::whereIn('id', $optIds)->pluck('Name', 'id');
                    //     }
                    //     return [];
                    // })
                    ->searchable()
                    // ->multiple()
                    ->dehydrateStateUsing(fn($state) => "[".json_encode($state)."]")
                    ->reactive()
                    ->afterStateUpdated(function (callable $get, callable $set) {
                        $itemId = $get('ItemID');
                        $quantity = $get('Quantity') ?? 1;
                        $selectedOptIds = $get('OptID') ?? null;

                        // جلب السعر الأساسي للمنتج
                        $basePrice = $itemId ? Item::find($itemId)?->Price : 0;

                        // حساب القيمة الإضافية للخيارات
                        $additionalValue = OptionDetil::find( $selectedOptIds)->AdditionalValue ?? 0;

                        // تحديث حقل السعر بالسعر الإجمالي
                        $set('Price', ($basePrice + $additionalValue) * $quantity);
                    }),

                TextInput::make('Price')
                    ->numeric()
                    ->readOnly(), // جعل الحقل للعرض فقط

                Textarea::make('Note'),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
        ->poll('5s')
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                SpatieMediaLibraryImageColumn::make('item.main_product')->label('Image')->collection('products'),
                Tables\Columns\TextColumn::make('item.Name'),
                Tables\Columns\TextColumn::make('option_detil')->html(),
                Tables\Columns\TextColumn::make('Note')->html(),

                Tables\Columns\TextColumn::make('Quantity')->summarize(
                    Summarizer::make()->money('JOD')
                        ->label('Total')
                        ->using(function($query){
                            $order = $this->ownerRecord;
                            return $query->sum('Price') + $order->ZonePrice ;
                        })

                    ),
                Tables\Columns\TextColumn::make('Price')->summarize(
                    Summarizer::make()->money('JOD')
                        ->label('Sub Total')
                        ->using(function($query){
                            $order = $this->ownerRecord;
                            return $query->sum('Price')  ;
                        })

                ),

                Tables\Columns\TextColumn::make('Delevery')->summarize(
                    Summarizer::make()->money('JOD')
                        ->label('Delevery')
                        ->using(function($query){
                            $order = $this->ownerRecord;
                            return $order->ZonePrice;
                        })

                ),

                Tables\Columns\TextColumn::make('paid')->summarize(
                    Summarizer::make()->money('JOD')
                        ->label('Paid Amount')
                        ->using(function($query){
                            $order = $this->ownerRecord;
                            if($this->ownerRecord->PaymentMethod == 'pay by credit card'){
                                return $order->before_amount;

                            }
                            return 0;
                        })

                ),
                
                
                

                
                

                

                Tables\Columns\TextColumn::make('add_value')->summarize(
                    Summarizer::make()->money('JOD')
                        ->label('Unpaid Amount')
                        ->using(function($query){
                            $order = $this->ownerRecord;
                            if($this->ownerRecord->PaymentMethod == 'pay by credit card'){
                            
                                return $order->add_value;
                            }
                            return $order->Total;

                        })

                ),
            ])
            // ->summarizers()
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->after(function (Component $livewire) {
                    $livewire->dispatch('refresh');
                    $this->updateOwnerRecord();

                }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->after(function (Component $livewire) {
                    $this->updateOwnerRecord();
                    $livewire->dispatch('refresh');
                }),
                Tables\Actions\DeleteAction::make()->after(function (Component $livewire) {
                    $this->updateOwnerRecord();
                    
                    $livewire->dispatch('refresh');
                }),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }
    protected function updateOwnerRecord(){
        $order = Order::find($this->ownerRecord->id);
        $order->Total = 0;
        $order->save();
        $order->add_value = 0;
        $order->save();
        redirect(request()->header('Referer'));

    }
}
