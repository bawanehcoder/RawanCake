<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\LoginUserRequest;
use App\Http\Requests\Site\RedirectToProviderRequest;
use App\Http\Requests\Site\RegisterUserRequest;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Services\ActionPointService;
use App\Services\auth\RegisterUserService;
use App\Services\UserService;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(LoginUserRequest $request)
    {
        //validate user credentials
        if (!Auth::guard('web')->attempt($request->validated())) {
            return responder()->error('400', __('invalid credentials'))->respond(400);
        }
        //get user
        $user = auth()->guard('web')->user();
        UserService::logUser($user->id, $request->source, 'logIn');
        $accessToken = $user->createToken('authToken')->plainTextToken;
        return responder()->success($user)->meta([
            'access_token' => $accessToken,
        ])->respond();
    }
    public function socialLogin(RedirectToProviderRequest $request)
    {
        $provider = $request->input('provider'); //for multiple providers
        $token = $request->input('access_token');    // get the provider's user. (In the provider server)
        $id = $request->input('id');
        $name = $request->input('name');
        $email = $request->input('email');
        $source = $request->input('source');

        $user = User::where('LoginProvider', $provider)->where('ProviderID', $id)->first();    // if there is no record with these data, create a new user
        if ($user == null) {
            $user = User::where('email', $email)->first(); // if there is no record with these data
        }
        if ($user == null) {
            $user = RegisterUserService::register([
                "name" => $name,
                "email" => $email,
                "ProviderID" => $id,
                "LoginProvider" => $provider,

            ]);
            $point = ActionPointService::getActionPoint('new_account_points');
            if ($point > 0) {
                $user->chargePoints($point, 'new account points');
            }
        }    // create a token for the user, so they can login
        $accessToken = $user->createToken('authToken')->plainTextToken;
        Auth::login($user);
        UserService::logUser($user->id, $source, 'logIn by ' . $provider);
        return responder()->success($user)->meta([
            'access_token' => $accessToken,
        ])->respond();



    }
}
