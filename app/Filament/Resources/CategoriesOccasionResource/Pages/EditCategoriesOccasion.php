<?php

namespace App\Filament\Resources\CategoriesOccasionResource\Pages;

use App\Filament\Resources\CategoriesOccasionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCategoriesOccasion extends EditRecord
{
    protected static string $resource = CategoriesOccasionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
