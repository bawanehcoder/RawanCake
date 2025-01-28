<?php

namespace App\Filament\Resources\MbileSliderResource\Pages;

use App\Filament\Resources\MbileSliderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMbileSlider extends EditRecord
{
    protected static string $resource = MbileSliderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
