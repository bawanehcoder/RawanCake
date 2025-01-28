<?php

namespace App\Filament\Resources\ApplicationGiftResource\Pages;

use App\Filament\Resources\ApplicationGiftResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListApplicationGifts extends ListRecords
{
    protected static string $resource = ApplicationGiftResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
