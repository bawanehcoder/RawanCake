<?php

namespace App\Models;


use App\Transformers\GenralInfoTransformer;
use App\Transformers\GenralSettingTransformer;
use Flugg\Responder\Contracts\Transformable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model implements Transformable
{
    use HasFactory;

    protected $fillable = [
        'Currency',
        'WhatsApp',
        'Coupon',
        'Coupon',
        'DeliveryFirstOrder',
        'OrderTime',
        'OrderMessage',
        'OrderMessageEN',
        'Thanks',
        'ThanksEN',
        'AppVersion',
    ];


    public function getCouponAttribute($value)
    {
        switch ($value) {
            case 0:
                return 'ineffective';
            case 1:
                return 'effective';
        }
    }
   public function getDeliveryFirstOrderAttribute($value)
    {
        switch ($value) {
            case 0:
                return 'ineffective';
            case 1:
                return 'effective';
        }
    }

    public function transformer()
    {
        return  GenralSettingTransformer::class;
    }
    public function currency(){
        return $this->belongsTo(Currencie::class,'Currency');
    }

}
