<?php

namespace App\Filament\Resources\ApplicationGiftResource\Pages;

use App\Filament\Resources\ApplicationGiftResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditApplicationGift extends EditRecord
{
    protected static string $resource = ApplicationGiftResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
