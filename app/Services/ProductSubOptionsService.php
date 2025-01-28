<?php

namespace App\Services;


use App\Models\ItemOption;
use App\Models\SubOption;

class ProductSubOptionsService
{
    public static function storeFromRequest($request)
    {
        $data = [
            'Name' => $request->name_ar,
            'NameEN' => $request->name_en,
            'blob' => $request->blob,
            'Type' => $request->type,
            'OptID' => $request->OptID,
        ];
        $cat = new SubOption($data);
        $cat->save();
        return $cat;
    }

    public static function updateFromRequest($entity, $request)
    {
        $data = [
            'Name' => $request->name_ar,
            'NameEN' => $request->name_en,
            'Type' => $request->type,
            'OptID' => $request->OptID,
            'Available' => $request->Available??0,
        ];
        $entity->update($data);
        $entity->save();
        return $entity;
    }
}
