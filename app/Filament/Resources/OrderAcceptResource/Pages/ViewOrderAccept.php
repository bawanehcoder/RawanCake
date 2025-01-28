<?php

namespace App\Filament\Resources\OrderAcceptResource\Pages;

use App\Filament\Resources\OrderAcceptResource;
use Filament\Actions;
use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\ViewRecord;

class ViewOrderAccept extends ViewRecord
{
    protected static string $resource = OrderAcceptResource::class;


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
