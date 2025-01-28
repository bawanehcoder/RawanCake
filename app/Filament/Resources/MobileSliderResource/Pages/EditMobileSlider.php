<?php

namespace App\Filament\Resources\MobileSliderResource\Pages;

use App\Filament\Resources\MobileSliderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMobileSlider extends EditRecord
{
    protected static string $resource = MobileSliderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
