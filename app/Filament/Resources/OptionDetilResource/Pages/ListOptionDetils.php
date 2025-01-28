<?php

namespace App\Filament\Resources\OptionDetilResource\Pages;

use App\Filament\Resources\OptionDetilResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOptionDetils extends ListRecords
{
    protected static string $resource = OptionDetilResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
