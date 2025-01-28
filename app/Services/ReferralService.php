<?php

namespace App\Services;

use App\Events\ReferralEvent;
use App\Models\Referral;
use App\Models\UserReferralCode;

class ReferralService
{
    public static function detectReferals($referralCode = null){
        //if user logged in, skip
        if(isLogged()) return false;

        //if referralCode saved before in session, skip
        if(empty($referralCode)){
            $referralCode = self::getReferralCodeFromRequest();
        }

        //if no referralCode assigned with request, skip
        if(empty($referralCode)){
            return 0;
        }

        if( self::isReferralCodeTheSameSavedInSession($referralCode) ) return false;

        //check if given referral code exists and linked with real user
        $referralFromDb = UserReferralCode::where('code', $referralCode)->first();

        //it mean the given referral code is false
        if( !$referralFromDb ) return false;


        //save code in session to be used later during registration
        return self::saveReferralCodeInSession($referralCode);
    }
    public static function saveReferralCodeInSession($referralCode){
        return \Request()->session()->put('referralCode', $referralCode);
    }
    public static function isReferralCodeTheSameSavedInSession($referralCode){
        return \Request()->session()->get('referralCode') == $referralCode;
    }
    public static function getReferralCodeFromRequest(){
        return \Request()->ref;
    }
    public static function generateUniqueReferralCode(){
        $code = self::generateReferralCode();
        while (UserReferralCode::where('code', $code)->exists()) {
            $code = self::generateReferralCode();
        }
        return $code;
    }
    public static function generateReferralCode(){
        return bin2hex(random_bytes(5));
    }
    public static function isUserCameFromReferralLink(){
        return \Request()->session()->has('referralCode');
    }
    public static function getSavedReferralCodeInSession(){
        return \Request()->session()->get('referralCode');
    }
    public static function registerReferralIfExists($registerer){
        // check if request session has referral code
        if( !self::isUserCameFromReferralLink() ) return false;

        //get referrer user data
        $referralCode = self::getSavedReferralCodeInSession();
        $referrer = UserReferralCode::where('code', $referralCode)

            ->first();

        // add to referrals table this data

        $referral = Referral::create([
            'referrer_id' => $referrer->UserID,
            'registerer_id' => $registerer->id,
        ]);

        event(new ReferralEvent($referral->referrer));

    }
}
