<?php

namespace App\Transformers;
use App\Models\Order;
use Flugg\Responder\Transformers\Transformer;

class OrderTransformer extends Transformer
{
    protected $relations = [];
    protected $load = [];

    public $tt = 0;

    public function transform(Order $order)
    {
        return [
            'id' => $order->id,
            'UserID' => $order->UserID,
            'ZoneID' => $order->ZoneID,
            'delivery_type' => $order->delivery_type,
            'OrderDate' => $order->OrderDate,
            'DeliveryTime' => $order->DeliveryTime,
            'Name' => $order->Name,
            'Phone' => $order->Phone,
            'country_code' => (string)$order->country_code,
            'ZonePrice' => $order->ZonePrice,
            'Total' => $order->Total,
            'AddValue' => $order->AddValue,
            'Discount' => $order->Discount,
            'Points' => $order->Points,
            'Status' => $order->Status,
            'Branch' => ['AddresAr' => $order?->branch?->AddresAr, 'AddresEn' => $order?->branch?->AddresEn],
            'Source' => $order->Source,
            'Note' => $order->Note,
            'optionDetil' => $this->order_details($order)
        ];
    }

    public function order_details(Order $order)
    {
        $data = [];
        foreach ($order->order_details ?? [] as $index => $item) {
            $data[$index]['item'] = [];
            $data[$index]['item']['images'] =[
                'large'=>asset($item->item->getFirstMediaUrl('products', 'large')),
                'medium'=>asset($item->item->getFirstMediaUrl('products', 'medium')),
                'small'=>asset($item->item->getFirstMediaUrl('products', 'small')),
            ];
            $data[$index]['item']['Title'] = $item->item->getTitle();
            $data[$index]['item']['Price'] = (string)$item->item->price();
            $data[$index]['item']['Quantity'] = $item->Quantity;
            $data[$index]['item']['Total'] = number_format((float)($item->item->price() * $item->Quantity), 2, '.', '');
            $this->tt += number_format((float)($item->item->price() * $item->Quantity), 2, '.', '');
            if ($item->optionDetil()) {
                foreach ($item->optionDetil()->get() ?? [] as $option) {
                    $data[$index]['item']['Option'][] = [
                        'title' => $option->subOption->getTitle(),
                        'value' => $option->AdditionalValue
                    ];
                }
            }
        }
        return $data;
    }

    public function order_details2(Order $order)
    {
        $data = 0;
        foreach ($order->order_details ?? [] as $index => $item) {
            
            $data += number_format((float)($item->item->price() * $item->Quantity), 2, '.', '');
            
        }
        return $data;
    }
}
