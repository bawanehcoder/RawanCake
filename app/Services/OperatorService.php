<?php

namespace App\Services;

use App\Models\Operator;

class OperatorService
{
    public static function storeFromRequest($request)
    {
        $data = [
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'blob' => $request->blob,
        ];
        $entity = new Operator($data);
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
