<?php

namespace App\Transformers;

use App\Models\Category;
use App\Models\Item;
use App\Models\OptionDetil;
use Flugg\Responder\Transformers\Transformer;

class OptionDetilTransformer extends Transformer
{
    protected $relations = [];
    protected $load = [];
    public function transform(OptionDetil $item)
    {
        return [
           'id'=>$item->id,
           'POptID'=>$item->POptID,
           'OptID'=>$item->OptID,
           'ItemID'=>$item->ItemID,
           'AdditionalValue'=>$item->AdditionalValue,

        ];
    }
}
