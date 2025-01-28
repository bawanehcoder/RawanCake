<?php

namespace App\Filament\Resources\ActionPointResource\Pages;

use App\Filament\Resources\ActionPointResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditActionPoint extends EditRecord
{
    protected static string $resource = ActionPointResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
