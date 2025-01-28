<?php
namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\GeneralSetting;
use App\Models\Item;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class GenralSettingRepository
{
    public $colors=['blue','orange','red'];
    public function __construct(public GeneralSetting $generalSetting )
    {
       // $query = Cache::remember('GeneralSetting', 86400, function ()use($generalSetting) {
           // return $generalSetting->first();
        //});
        $query=$generalSetting->first();
        $this->generalSetting=$query;
    }
    public function getLang(){
        return Config::get('app.locale');
    }
    public  function getCurrency(){
      return $this->getLang()=='en'?$this->generalSetting->currency->EN:$this->generalSetting->currency->AR;
    }
    public function getColor($i=0){
        $i=$i>count($this->colors)-1?0:$i;
        return $this->colors[$i];
    }
    public function getCouponActive(){
        return $this->generalSetting->Coupon;
    }
    public function getDeliveryFirstOrderActive(){
            return $this->generalSetting->DeliveryFirstOrder;
        }
}
