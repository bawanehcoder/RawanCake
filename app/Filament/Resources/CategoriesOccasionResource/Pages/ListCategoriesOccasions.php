<?php

namespace App\Filament\Resources\CategoriesOccasionResource\Pages;

use App\Filament\Resources\CategoriesOccasionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCategoriesOccasions extends ListRecords
{
    protected static string $resource = CategoriesOccasionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
