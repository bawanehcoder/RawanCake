<?php

namespace App\Services;

use App\Models\Zones;

class ZonesService
{
    public static function storeFromRequest($request)
    {
        $data = [
            'AddresAr' => $request->AddresAr,
            'AddresEn' => $request->AddresEn,
            'RegionID' => $request->RegionID,
            'delivery' =>json_encode($request->delivery) ,
            'blob' => $request->blob,
        ];
        $entity = new Zones($data);
        $entity->save();
        return $entity;
    }
    public static function updateFromRequest($entity,$request)
    {

        $data = [
            'AddresAr' => $request->AddresAr,
            'AddresEn' => $request->AddresEn,
            'RegionID' => $request->RegionID,
            'delivery' =>json_encode($request->delivery) ,
        ];
        $entity->update($data);
        $entity->save();
        return $entity;
    }
}
