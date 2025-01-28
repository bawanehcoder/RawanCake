<?php

namespace App\Transformers;
use App\Models\CategoriesOccasion;
use Flugg\Responder\Transformers\Transformer;

class CategoriesOccasionTransformer extends Transformer
{
    protected $relations = [];
    protected $load = [];
    public function transform(CategoriesOccasion $item)
    {
        return [
            'id' => $item->id,
            'name_ar' => $item->name_ar,
            'name_en' => $item->name_en,
            'images'=>[
                'large'=>asset($item->getFirstMediaUrl('categories_occasion', 'large')),
                'medium'=>asset($item->getFirstMediaUrl('categories_occasion', 'medium')),
                'small'=>asset($item->getFirstMediaUrl('categories_occasion', 'small')),
            ],
        ];
    }
}
