<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\RegisterUserRequest;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Services\auth\RegisterUserService;
use App\Services\UserService;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(RegisterUserRequest $request){

        //create user
        $user = RegisterUserService::register($request->validated());
        UserService::logUser($user->id,$request->source,'register');
        $accessToken = $user->createToken('authToken')->plainTextToken;
        return responder()->success($user)->meta([
            'access_token' => $accessToken,
        ])->respond();

    }

}
