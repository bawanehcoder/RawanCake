<?php

namespace App\Filament\Resources\ConditionalDeliveryResource\Pages;

use App\Filament\Resources\ConditionalDeliveryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListConditionalDeliveries extends ListRecords
{
    protected static string $resource = ConditionalDeliveryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
