<?php

namespace App\Services;

use App\Models\GeneralSetting;

class GenralSettingService
{
    public static function updateFromRequest($request)
    {
        $data=[
            'Currency'=>$request->Currency,
            'WhatsApp'=>$request->whatsApp_number,
            'Coupon'=>$request->activate_coupons==null?0:1,
            'DeliveryFirstOrder'=>$request->delivery_first_order==null?0:1,
            'AppVersion'=>$request->app_version,
            'OrderTime'=>$request->minimum_order_delivery_time,
            'OrderMessage'=>$request->order_message_ar,
            'OrderMessageEN'=>$request->order_message_en,
            'Thanks'=>$request->order_completion_message_ar,
            'ThanksEN'=>$request->order_completion_message_en,
        ];
        $entity=GeneralSetting::first();
        if($entity==null){
            $entity=new GeneralSetting($data);
            $entity->save();
        }else{
            $entity->update($data) ;
            $entity->save();
        }
        return $entity;
    }
}
