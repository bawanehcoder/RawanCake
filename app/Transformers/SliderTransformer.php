<?php

namespace App\Transformers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Slide;
use Flugg\Responder\Transformers\Transformer;

class SliderTransformer extends Transformer
{
    protected $relations = [];
    protected $load = [];
    public function transform(Slide $slide)
    {
        return [
                'title'=>$slide->title,
                'url'=>$slide->url,
            'image'=>[
                'large'=>asset($slide->getFirstMediaUrl('slider', 'large')),
                'medium'=>asset($slide->getFirstMediaUrl('slider', 'medium')),
                'small'=>asset($slide->getFirstMediaUrl('slider', 'small')),
            ],
        ];
    }
}
