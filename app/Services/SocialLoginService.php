<?php

namespace App\Services;

use App\Models\User;
use App\Services\auth\RegisterUserService;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginService
{
    public static function ProviderCallback($authProvider)
    {

        try {
            switch ($authProvider) {
                case 'twitter':
                    $userFromProvider = Socialite::driver($authProvider)->user();
                    break;
                case 'facebook':
                case 'google':
                    $userFromProvider = Socialite::driver($authProvider)->stateless()->user();
                    // dd($userFromProvider, $userFromProvider->getId());
                    break;
                default:
                    abort(500);
                    break;
            }
        } catch (\Laravel\Socialite\Two\InvalidStateException $e) {
            return redirect()->route(config('socialLogin.redirect_on_failed_to'))->withErrors([__('please try login again')]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if ($e->getCode() == 400) {
                return redirect()->route(config('socialLogin.redirect_on_failed_to'))->withErrors([__('please give permission to our app throuh :provider to be able to login', ['provider' => __($authProvider)])]);
            }
            throw $e;
        }
        $authId = $userFromProvider->getId();
        $email = $userFromProvider->getEmail();
        $guard = 'web';
        //filter name
        $filteredName = $userFromProvider->getName();
        $filteredName = preg_replace('/\d+/u', '', $filteredName); //remove any numbers (arabic, english)
        $filteredName = preg_replace('/([_-])+/u', ' ', $filteredName);
        //if user registered before, login him(checking using authId, authProvider)
        if (
            //login user using their social account id
            (in_array($authProvider, ['google', 'twitter', 'facebook']) && $user = SocialLoginService::getUserRegisteredWithProvider($guard, $authProvider, $authId)) ||
            (
                //link existing old accounts registered before with email of social account
                !empty($userFromProvider->email) && $user = SocialLoginService::getUserRegisteredWithEmail($guard, $userFromProvider->email)
            )
        ) {

            //verify user if not verified
            if (!empty($user->email) && empty($user->email_verified_at)) {
                $user->email_verified_at = now();
                $user->save();

            }

            //save email form social account if not exist in our side
            if (empty($user->email) && !empty($userFromProvider->email) && !$user->where('email', $userFromProvider->email)->exists()) {
                $user->email = $userFromProvider->email;
                $user->save();
            }
            UserService::logUser($user->id,0,'logIn by '.$authProvider);
            //login him
            \Auth::login($user, true);
            return redirect()->route(config('socialLogin.redirect_after_login_to'));
        }

        $user = RegisterUserService::register([
            "name" => $userFromProvider->getName(),
            "email" => $userFromProvider->getEmail(),
            "ProviderID" => $authId,
            "LoginProvider" => $authProvider,
        ]);
        $point=ActionPointService::getActionPoint('new_account_points');
        if($point>0){
            $user->chargePoints($point, 'new_account_points');
        }
        //upload avatar

        $user->addAvatarFromUrl($userFromProvider->avatar_original);
        UserService::logUser($user->id,0,'logIn by '.$authProvider);
        //login user
        \Auth::login($user, false);
        //redirect to user dashboard
        return redirect()->route(config('socialLogin.redirect_after_register_to'));
    }

    public static function getUserRegisteredWithEmail($guard, $email)
    {
        // $userClassName = getClassNameOfAlias($guard);
        $userObj = new User();
        return $userObj->where([
            'email' => $email,
        ])->first();
    }

    public static function getUserRegisteredWithProvider($guard, $authProvider, $authId)
    {
        // $userClassName = getClassNameOfAlias($guard);

        $userObj = new User();
        return $userObj->where([
            'LoginProvider' => $authProvider,
            'ProviderID' => $authId,
        ])->first();
    }
}
