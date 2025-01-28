<?php

namespace App\Filament\Resources\ItemResource\Pages;

use App\Events\SyncStarted;
use App\Filament\Resources\ItemResource;
use App\Models\GeneralInfo;
use App\Models\GeneralSetting;
use Artisan;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListItems extends ListRecords
{
    protected static string $resource = ItemResource::class;


    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
            Action::make('importt')
                ->label('Sync Now without Image')
                ->disabled((bool) GeneralSetting::first()->sync)
                ->action(function (array $data) {


                    $g = GeneralSetting::first();
                    $g->sync = 1;
                    $g->save();
                    redirect(request()->header('Referer'));


                    event(new SyncStarted());


                }),


                Action::make('importtt')
                ->label('Sync Now with Image')
                ->disabled((bool) GeneralSetting::first()->sync)
                ->action(function (array $data) {


                    $g = GeneralSetting::first();
                    $g->sync = 1;
                    $g->save();
                    redirect(request()->header('Referer'));


                    event(new SyncStarted());


                }),
        ];
    }
}
