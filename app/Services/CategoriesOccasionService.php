<?php

namespace App\Services;

use App\Models\CategoriesOccasion;

class CategoriesOccasionService
{
    public static function storeFromRequest($request)
    {
        $data = [
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
        ];
        $cat = new CategoriesOccasion($data);
        $cat->save();
        MediaService::addMediaFromRequest($cat, 'category_image', 'categories_occasion');
        return $cat;
    }
    public static function updateFromRequest($entity,$request)
    {
        $data = [
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,

        ];
        $entity->update($data);
        $entity->save();
        if(!empty($request['category_image'])){
            //add new category_image image
            $entity->clearMediaCollection('categories_occasion');
            MediaService::addMediaFromRequest($entity, 'category_image', 'categories_occasion');
        }
        return $entity;
    }
}
