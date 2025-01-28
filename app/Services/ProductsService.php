<?php

namespace App\Services;

use App\Models\Item;

class ProductsService
{
    public static function storeFromRequest($request)
    {
        $request->special_requests=$request->special_requests=='on'?1:$request->special_requests;
        $data = [
            'CatID' => $request->CatID,
            'blob' => $request->blob,
            'Name' => $request->product_ar,
            'NameEN' => $request->product_en,
            'Description' => $request->description_ar,
            'DescriptionEN' => $request->description_en,
            'Price' => $request->price,
            'stock' => $request->stock??0,
            'operator' => json_encode($request->operator),
            'Special' => $request->special_requests??0,
            'Date' => now(),
        ];
        $cat = new Item($data);
        $cat->save();
        MediaService::addMediaFromRequest($cat, 'main_product', 'products');
        if($request->has('attached_product')){
            MediaService::addMultipleMediaFromRequest($cat, 'attached_product', 'attached_products');
        }

        return $cat;
    }
    public static function updateFromRequest($entity,$request)
    {
        $data = [
            'CatID' => $request->CatID,
            'blob' => $request->blob,
            'Name' => $request->product_ar,
            'NameEN' => $request->product_en,
            'Description' => $request->description_ar,
            'DescriptionEN' => $request->description_en,
            'Price' => $request->price,
            'stock' => $request->stock??0,
            'Special' => $request->special_requests=='on'?1:0,
            'Available' => $request->Available??0,
            'operator' => json_encode($request->operator),
        ];
        $entity->update($data);
        $entity->save();

        if(!empty($request['main_product'])){
            //add new category_image image
            $entity->clearMediaCollection('products');
            MediaService::addMediaFromRequest($entity, 'main_product', 'products');
        }
        if(!empty($request['attached_product'])){
            //add new category_image image

            $entity->clearMediaCollection('attached_products');
            MediaService::addMultipleMediaFromRequest($entity, 'attached_product', 'attached_products');
        }
        return $entity;
    }

}
