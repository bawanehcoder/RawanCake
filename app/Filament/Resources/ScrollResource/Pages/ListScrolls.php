<?php

namespace App\Filament\Resources\ScrollResource\Pages;

use App\Filament\Resources\ScrollResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListScrolls extends ListRecords
{
    protected static string $resource = ScrollResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
