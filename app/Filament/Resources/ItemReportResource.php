<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemReportResource\Pages;
use App\Filament\Resources\ItemReportResource\RelationManagers;
use App\Models\Category;
use App\Models\Item;
use App\Models\ItemReport;
use App\Models\OrderDetail;
use DB;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemReportResource extends Resource
{
    protected static ?string $model = OrderDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Products and Categories';

    protected static ?string $navigationLabel = 'Products Reports';
    protected static ?int $navigationSort = 4;

    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('item.main_product')->collection('products'),

                Tables\Columns\TextColumn::make('item.Name')->label('Name'),
                Tables\Columns\TextColumn::make('Price')->label('Price'),
                Tables\Columns\TextColumn::make('Quantity')->label('Quantity'),
                Tables\Columns\TextColumn::make('blob')->label('Total')->summarize(
                    Tables\Columns\Summarizers\Sum::make()
                        ->money()
                ),

            ])
            // ->defaultGroup('item.Name')
            ->filters([

                SelectFilter::make('CatID')
                    ->multiple()
                    ->label('Category')
                    ->options(function () {
                        return Category::whereNotNull('Name')->pluck('Name', 'id');
                    })
                    ->searchable()

                    ->query(function (Builder $query, array $data) {
                        if (isset($data['value'])) {
                            $data['value'] > 0 ? $query->where('CatID', $data['value']) : $query->where('CatID', $data['value'])->orWhere('CatID', $data['value']);
                        }
                    }),

                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from'),
                        DatePicker::make('created_until'),
                    ])->columnSpan(4)->columns(2)
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
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
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListItemReports::route('/'),
            // 'create' => Pages\CreateItemReport::route('/create'),
            // 'edit' => Pages\EditItemReport::route('/{record}/edit'),
        ];
    }
}
