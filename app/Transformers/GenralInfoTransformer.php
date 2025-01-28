<?php

namespace App\Transformers;

use App\Models\GeneralInfo;
use App\Models\Page;
use Flugg\Responder\Transformers\Transformer;

class GenralInfoTransformer extends Transformer
{
    protected $relations = [];
    protected $load = [];
    public function transform(GeneralInfo $info){
        return [
            'e-mail'=>$info->EMail,
            'Facebook'=>$info->Facebook,
            'Twitter'=>$info->Twitter,
            'LinkedIn'=>$info->LinkedIn,
            'Instagram'=>$info->Instagram,
            'YouTube'=>$info->YouTube,
            'Pinterest'=>$info->Pinterest,
            'FourSquare'=>$info->FourSquare,
            'Tumblr'=>$info->Tumblr,

        ];
    }
}
