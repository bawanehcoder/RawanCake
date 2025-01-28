<?php

namespace App\Models\Traits;

use App\Models\Point;
use App\Services\PointsService;

trait PointTrait
{
    public function points()
    {
        return $this->hasMany(Point::class, 'user_id')->orderBy('id','DESC');
    }

    public function totalPoints()
    {
        $points = $this->points()->sum('amount');
        return number_format($points, 0, '.', '');
    }
    public function chargePoints($amount, $details = null)
    {
        return PointsService::charge($this,$amount, $details);
    }
    public function canDeductPoints($amount)
    {
        return $this->totalPoints() >= $amount;
    }
    public function convertPointstoMoney($amount)
    {
        return  $amount>0?$amount*0.02:0;
    }
    public function referralProfits(){
        return $this->points()
            ->where('details', 'member_referral')
            ->sum('amount');
    }
    public function details($data){
        if($data=='member_referral'){
            return @langucw('member referral');


        }
    }
}
