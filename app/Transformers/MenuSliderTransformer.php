<?php

namespace App\Transformers;

use App\Models\Category;
use App\Models\Item;
use App\Models\MenuSlide;
use App\Models\Slide;
use Flugg\Responder\Transformers\Transformer;

class MenuSliderTransformer extends Transformer
{
    protected $relations = [];
    protected $load = [];
    public function transform(MenuSlide $slide)
    {
        return [
                'title'=>$slide->title,
                'url'=>$slide->url,
            'image'=>[
                'large'=>asset($slide->getFirstMediaUrl('menu_slider', 'large')),
                'medium'=>asset($slide->getFirstMediaUrl('menu_slider', 'medium')),
                'small'=>asset($slide->getFirstMediaUrl('menu_slider', 'small')),
            ],
        ];
    }
}
