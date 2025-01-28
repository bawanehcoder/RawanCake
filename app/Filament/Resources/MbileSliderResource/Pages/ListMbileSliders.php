<?php

namespace App\Filament\Resources\MbileSliderResource\Pages;

use App\Filament\Resources\MbileSliderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMbileSliders extends ListRecords
{
    protected static string $resource = MbileSliderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
