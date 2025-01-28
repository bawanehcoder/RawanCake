<?php

namespace App\Models\Traits;

use App\Models\Referral;
use App\Models\UserReferralCode;
use App\Services\ReferralService;

trait ReferralTrait
{
    public function referralCode()
    {
        return $this->hasOne(UserReferralCode::class, 'UserID');
    }

    public function generateNewReferralCode()
    {
        $this->referralCode()->updateOrCreate(
            ['UserID' => $this->id,],
            ['code' => ReferralService::generateUniqueReferralCode()]
        );
    }

    public function getReferralCode()
    {
        return $this->referralCode->code ?? '';
    }

    public function getReferralUrl()
    {
        return url('') . '/ref/' . $this->getReferralCode();
    }
    public function usersIReferred()
    {
        return $this->hasMany(Referral::class,'referrer_id');
    }


}
