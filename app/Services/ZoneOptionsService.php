<?php

namespace App\Services;

use App\Models\ZoneOption;
use App\Models\Zones;

class ZoneOptionsService
{
    public static function storeFromRequest($request)
    {
          $data = [
            'zone_id' => $request->zone_id,
            'start_time' => $request->start_time,
            'end_time' =>$request->end_time ,
            'delivery' =>$request->delivery ,
            'blob' => $request->blob,
        ];
        $entity = new ZoneOption($data);
        $entity->save();
        return $entity;
    }
    public static function updateFromRequest($entity,$request)
    {


    }
}
