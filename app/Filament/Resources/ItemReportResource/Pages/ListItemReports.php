<?php

namespace App\Filament\Resources\ItemReportResource\Pages;

use App\Filament\Resources\ItemReportResource;
use App\Models\OrderDetail;
use DB;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListItemReports extends ListRecords
{
    protected static string $resource = ItemReportResource::class;


    protected function getTableQuery(): Builder
    {
        return OrderDetail::select(
            DB::raw('MIN(id) as id'),
            'ItemID', 
            DB::raw('SUM(Quantity) as Quantity'), 
            'Price', 
            DB::raw('(Price * SUM(Quantity)) as `blob`') // Escape 'blob' with backticks
        )->groupBy('ItemID','Price', 'id') ?? [];
    }
    
    protected function resolveTableRecord(?string $key): ?OrderDetail
    {
        return OrderDetail::find($key);
    }


    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
