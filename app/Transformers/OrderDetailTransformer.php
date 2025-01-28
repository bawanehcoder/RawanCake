<?php

namespace App\Transformers;

use App\Models\Order;

use App\Models\OrderDetail;
use Flugg\Responder\Transformers\Transformer;

class OrderDetailTransformer extends Transformer
{
    protected $relations = [];
    protected $load = [];
    public function transform(OrderDetail $orderDetail){
        return [
            "id"=>$orderDetail->id,

        ];
    }
}
