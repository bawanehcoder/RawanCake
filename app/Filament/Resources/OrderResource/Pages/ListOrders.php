<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Services\Payment\PaytabsConfig;
use App\Services\Payment\PaytabsService;
use Filament\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
            Action::make('gen')
                ->label('Custom payment')
                ->form([

                    TextInput::make('amount')

                ])
                ->action(function (array $data) {

                    // $data['amount'] = 50;
                    // return;

                    $dataa = [
                        "tran_type" => "sale",
                        "tran_class" => "ecom",
                        "cart_id" =>'"'. rand(99999, 9999999999) .'"',
                        "cart_currency" => "JOD",
                        "cart_amount" => $data['amount'],
                        "cart_description" => "Custom payment",
                        "paypage_lang" => "en",
                        "callback" => "https://rawancake.jo/",
                        "return" => "https://rawancake.jo/thank-you",
                    ];
                    $plugin = new PaytabsService();
                    $response = $plugin->send_api_request('payment/request', $dataa, 'POST');
                    $redirect_url = $response["redirect_url"];

                    dd($redirect_url);




                }),
        ];
    }
}
