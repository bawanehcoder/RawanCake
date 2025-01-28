<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Exports\InvoicesExport;
use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Actions;
use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\EditRecord;
use Maatwebsite\Excel\Facades\Excel;


class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            ButtonAction::make('pdf')
                ->label('PDF')
                ->url(fn($record) => route('alaa.pdf', $record))
                ->openUrlInNewTab(),
        ];
    }
}
