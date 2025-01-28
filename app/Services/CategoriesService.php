<?php

namespace App\Services;

use App\Models\Category;

class CategoriesService
{
    public static function storeFromRequest($request)
    {
        $data = [
            'CatID' => $request->CatID,
            'blob' => $request->blob,
            'Name' => $request->section_title_ar,
            'NameEN' => $request->section_title_en,
            'ShortcutName' => $request->ShortcutName,
            'ShortcutNameEN' => $request->ShortcutNameEN,
        ];
        $cat = new Category($data);
        $cat->save();
        MediaService::addMediaFromRequest($cat, 'category_image', 'categories');
        return $cat;
    }
    public static function updateFromRequest($entity,$request)
    {
        $data = [
            'CatID' => $request->CatID,
            'blob' => $request->blob,
            'Name' => $request->section_title_ar,
            'NameEN' => $request->section_title_en,
            'ShortcutName' => $request->ShortcutName,
            'ShortcutNameEN' => $request->ShortcutNameEN,
            'Visible' => $request->Visible,
            'SortIndex' => $request->SortIndex,
        ];
        $entity->update($data);
        $entity->save();
         if(!empty($request['category_image'])){
             //add new category_image image
             $entity->clearMediaCollection('categories');
             MediaService::addMediaFromRequest($entity, 'category_image', 'categories');
         }
        return $entity;
    }
    public static function getMainCategories(){

        return Category::where('CatID',0)->get();
    }
    public static function getSubCategories(){
        return Category::where('CatID','>',0)->get();
    }
}
