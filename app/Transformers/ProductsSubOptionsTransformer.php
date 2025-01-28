<?php

namespace App\Transformers;

use App\Models\Category;
use App\Models\Item;
use Flugg\Responder\Transformers\Transformer;

class ProductsSubOptionsTransformer extends Transformer
{
    protected $relations = [];
    protected $load = [];
    public function transform(Item $item)
    {
        return [
                'id'=>$item->id,
                'CatID'=>$item->CatID,
                'Name'=>$item->Name,
                'NameEN'=>$item->NameEN,
                'Description'=>$item->Description,
                'DescriptionEN'=>$item->DescriptionEN,
                'Available'=>$item->Available,
                'Price'=>$item->Price,
                'NewPrice'=>$item->NewPrice,
                'Views'=>$item->Views,
                'Rating'=>$item->Rating,
                'RatingCount'=>$item->RatingCount,
                'Sales'=>$item->Sales,
                'Special'=>$item->Special,
            'main_image'=>[
                'large'=>asset($item->getFirstMediaUrl('products', 'large')),
                'medium'=>asset($item->getFirstMediaUrl('products', 'medium')),
                'small'=>asset($item->getFirstMediaUrl('products', 'small')),
            ],
            'other_image'=>[
                'large'=>asset($item->getFirstMediaUrl('attached_products', 'large')),
                'medium'=>asset($item->getFirstMediaUrl('attached_products', 'medium')),
                'small'=>asset($item->getFirstMediaUrl('attached_products', 'small')),
            ],
        ];
    }
}
