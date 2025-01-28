<?php

namespace App\Services;


use App\Models\ItemOption;

class ProductOptionsService
{
    public static function storeFromRequest($request)
    {
        $data = [
            'Name' => $request->name_ar,
            'NameEN' => $request->name_en,
            'blob' => $request->blob,
            'Type' => $request->type,
        ];
        $cat = new ItemOption($data);
        $cat->save();
        return $cat;
    }

    public static function updateFromRequest($entity, $request)
    {
        $data = [
            'Name' => $request->name_ar,
            'NameEN' => $request->name_en,
            'Type' => $request->type,
        ];
        $entity->update($data);
        $entity->save();
        return $entity;
    }

}
