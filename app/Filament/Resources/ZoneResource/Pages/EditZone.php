<?php

namespace App\Filament\Resources\ZoneResource\Pages;

use App\Filament\Resources\ZoneResource;
use Filament\Actions;

use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\EditRecord;

class EditZone extends EditRecord
{
    protected static string $resource = ZoneResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            ButtonAction::make('back')
                ->label('Back')
                ->url(url()->previous())// Replace with your route name
                ->icon('heroicon-o-arrow-left')
        ];
    }
}
