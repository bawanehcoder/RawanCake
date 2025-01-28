<?php

namespace App\Filament\Resources\OrderAcceptResource\Pages;

use App\Filament\Resources\OrderAcceptResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrderAccepts extends ListRecords
{
    protected static string $resource = OrderAcceptResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
            
        ];
    }
}
