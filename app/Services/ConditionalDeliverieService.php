<?php

namespace App\Services;

use App\Models\ConditionalDeliverie;
use App\Models\ShippingInfo;
use App\Repositories\CartRepository;

class ConditionalDeliverieService
{
    public static function storeFromRequest($request)
    {
        try {
            $data = [
                'zone_ids' => $request->zones ? $request->zones : [],
                'items' => $request->products ? $request->products : [],
                'start_time' => $request->start_time,
                'title_ar' => $request->title_ar,
                'title_en' => $request->title_en,
                'end_time' => $request->end_time,
                'delivery' => $request->delivery,
                'purchase_value' => $request->purchase_value,
                'blob' => $request->blob,
            ];
            $entity = new ConditionalDeliverie($data);
            $entity->save();
            return true;
        } catch (\Exception $ex) {
            return false;
        }
    }

    public static function updateFromRequest($entity, $request)
    {
        try {
            $data = [
                'zone_ids' => $request->zones ? $request->zones : [],
                'items' => $request->products ? $request->products : [],
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'delivery' => $request->delivery,
                'purchase_value' => $request->purchase_value,
                'title_ar' => $request->title_ar,
                'title_en' => $request->title_en,
            ];
            $entity->update($data);
            $entity->save();
            return $entity;
        } catch (\Exception $ex) {
            return false;
        }
    }

    public static function getConditionalDeliverie()
    {
        // dd(ConditionalDeliverie::whereRaw('(now() between start_time and end_time)')->get());
        return ConditionalDeliverie::whereRaw('(now() between start_time and end_time)')->get();
    }

    public static function isConditionalDeliverie($carts)
    {
        $conditionas = self::getConditionalDeliverie();
        if ($conditionas->count() < 1) {
            return false;
        }
        $total_price = app()->make(CartRepository::class)->getTotalPrice($carts);
        $product_ids = $carts->pluck('product_id');
        $flag_item = false;
        foreach ($conditionas as $condition) {
            $items = $condition->items;
            $zones = $condition->zone_ids;
            $purchase_value = $condition->purchase_value;
            $delivery = $condition->delivery;

            $count=0;
            foreach ($product_ids as $ids) {
                if (in_array($ids, $items)) {
                    $count++;
                }
            }
            if($count==count($items)){
                $flag_item = true;
            }
            if($flag_item && $purchase_value<=$total_price){

                return ['delivery'=>$delivery,'zones'=>$zones,'purchase_value'=>$purchase_value];
            }
        }


        return false ;
    }
}
