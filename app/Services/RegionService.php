<?php

namespace App\Services;

use App\Models\Operator;
use App\Models\Region;

class RegionService
{
    public static function storeFromRequest($request)
    {
        $data = [
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'blob' => $request->blob,
        ];
        $entity = new Region($data);
        $entity->save();

        return $entity;
    }
    public static function updateFromRequest($entity,$request)
    {
        $data = [
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,

        ];
        $entity->update($data);
        $entity->save();

        return $entity;
    }
}
