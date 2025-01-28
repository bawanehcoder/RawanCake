<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\ViewRecord;

class ViewUser extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
            ButtonAction::make('pdf')
                ->label('PDF')
                ->url(fn($record) => route('alaa.pdf', $record))
                ->openUrlInNewTab(),
        ];
    }
}
