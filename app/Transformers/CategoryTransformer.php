<?php

namespace App\Transformers;

use App\Models\Category;
use Flugg\Responder\Transformers\Transformer;

class CategoryTransformer extends Transformer
{
    protected $relations = [];
    protected $load = [];
    public function transform(Category $category)
    {
        return [
            'id' => (int)$category->id,
            'CatID' => (int)$category->CatID,
            'blob' => $category->blob,
            'Name' => $category->Name,
            'NameEN' => $category->NameEN,
            'ShortcutName' => $category->ShortcutName,
            'ShortcutNameEN' => $category->ShortcutNameEN,
            'images'=>[
                'large'=>asset($category->getFirstMediaUrl('categories', 'large')),
                'medium'=>asset($category->getFirstMediaUrl('categories', 'medium')),
                'small'=>asset($category->getFirstMediaUrl('categories', 'small')),
            ],
        ];
    }
}
