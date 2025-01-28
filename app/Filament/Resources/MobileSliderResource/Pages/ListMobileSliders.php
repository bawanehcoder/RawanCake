<?php

namespace App\Filament\Resources\MobileSliderResource\Pages;

use App\Filament\Resources\MobileSliderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMobileSliders extends ListRecords
{
    protected static string $resource = MobileSliderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
