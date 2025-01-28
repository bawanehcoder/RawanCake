<?php

namespace App\Services;

use App\Models\ShippingInfo;

class ShippingInfoService
{
    public static function storeFromRequest($request)
    {
        $data = [
            'user_id' => getLogged()->id,
            'zone_id' => $request->zone,
            'phone' => $request->phone,
            'country_code' => $request->country_code,
            'title' => $request->title,
            'name' => $request->name,
            'address' => $request->shipping_info,
        ];
        $entity = new ShippingInfo($data);
        $entity->save();
        return $entity;
    }

    public static function updateFromRequest($request)
    {
        $entity = ShippingInfo::find($request->id);
        $data = [
            'zone_id' => $request->zone,
            'phone' => $request->phone,
            'title' => $request->title,
            'name' => $request->name,
            'address' => $request->shipping_info,
        ];
        $entity->update($data);
        $entity->save();
        return $entity;
    }
}
