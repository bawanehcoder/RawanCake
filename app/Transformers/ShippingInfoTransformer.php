<?php

namespace App\Transformers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Item;
use App\Models\ShippingInfo;
use App\Models\Zones;
use Flugg\Responder\Transformers\Transformer;

class ShippingInfoTransformer extends Transformer
{
    protected $relations = ['zone'=>ZonesTransformer::class];
    protected $load = ['zone'=>ZonesTransformer::class];

    public function transform(ShippingInfo $item)
    {
        return [
            'id' => $item->id,
            'address' => $item->address,
            'phone' => $item->phone,
            'country_code' => (string)$item->country_code,
            'title' => $item->title,
            'name' => $item->name,
        ];
    }
}
