<?php

namespace App\Transformers;

use App\Models\ApplicationGift;
use Flugg\Responder\Transformers\Transformer;

class ApplicationGiftTransformer extends Transformer
{
    protected $relations = [];
    protected $load = [];
    public function transform(ApplicationGift $gift){
        return [
           'status'=>$gift->Enabled==1?'active':'inactive',
           'message'=>$gift->GiftMessage,
           'type'=>$gift->GiftType,
           'product_id'=>$gift->ProductID,
           'fixed_discount'=>$gift->FixedDiscount,
           'relative_discount'=>$gift->RelativeDiscount,
        ];
    }
}
