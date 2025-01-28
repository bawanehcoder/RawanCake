<?php

namespace App\Filament\Resources\ConditionalDeliveryResource\Pages;

use App\Filament\Resources\ConditionalDeliveryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditConditionalDelivery extends EditRecord
{
    protected static string $resource = ConditionalDeliveryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
