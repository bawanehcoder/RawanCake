<?php

namespace App\Transformers;

use App\Models\Branche;
use App\Models\GeneralInfo;
use App\Models\Page;
use Flugg\Responder\Transformers\Transformer;

class BrancheTransformer extends Transformer
{
    protected $relations = [];
    protected $load = [];
    public function transform(Branche $branche){





        return [
            'id'=>$branche->id,
            'AddresAr'=>$branche->AddresAr,
            'AddresEn'=>$branche->AddresEn,
            'Phone'=>$branche->Phone,
            'Map'=>$branche->Map,



        ];
    }
}
