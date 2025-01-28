<?php

namespace App\Transformers;


use App\Models\GeneralSetting;

use Flugg\Responder\Transformers\Transformer;

class GenralSettingTransformer extends Transformer
{
    protected $relations = [];
    protected $load = [];
    public function transform(GeneralSetting $setting){
        return [
            'orderTime'=>$setting->OrderTime,
            'orderMessage'=>$setting->OrderMessage,
            'orderMessageEN'=>$setting->OrderMessageEN,
            'thanks'=>$setting->Thanks,
            'thanksEN'=>$setting->ThanksEN,
            'coupon'=>$setting->Coupon,
            'DeliveryFirstOrder'=>$setting->DeliveryFirstOrder,
            'whatsApp'=>$setting->WhatsApp,
            'points_rate'=>0.02,
        ];
    }
}
