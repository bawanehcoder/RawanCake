<?php


namespace App\Services\auth;

use App\Models\User;
use App\Services\ActionPointService;
use App\Services\ReferralService;
use App\Services\UserService;

class RegisterUserService
{
    public static function register(array $data){

        if(isset($data['password'])&&!empty($data['password'])){
            $data['password'] = \Hash::make($data['password']);
        }else{
            $data['password'] = \Hash::make('password');
        }
        if(isset($data['email'])&&!empty($data['email'])){
            $data['email'] = $data['email'];
        }

        if(isset($data['country_code'])&&!empty($data['country_code'])){
            // dd($data['country_code']);
            $data['country_code'] = $data['country_code'];
        }

        if(isset($data['ProviderID'])&&!empty($data['ProviderID'])){
            $data['ProviderID'] = $data['ProviderID'];
        }
        if(isset($data['LoginProvider'])&&!empty($data['LoginProvider'])){
            $data['LoginProvider'] = $data['LoginProvider'];
        }
        $user = User::create($data);

        if(isset($data['country_code'])&&!empty($data['country_code'])){
            $user->country_code = $data['country_code'];
            $user->save();
        }



        $point=ActionPointService::getActionPoint('new_account_points');

        if($point>0){
            $user->chargePoints($point, 'new_account_points');
        }
        //generate referral code
        $user->generateNewReferralCode();
        //check if user registered with referral
        return $user;
        ReferralService::registerReferralIfExists($user);
        return $user;
    }
}
