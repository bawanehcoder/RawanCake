<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\ForgotPasswordRequest;
use App\Http\Requests\Site\LoginUserRequest;
use App\Http\Requests\Site\RegisterUserRequest;
use App\Http\Requests\Site\ResetPasswordRequest;
use App\Mail\SendCodeResetPassword;
use App\Models\ResetCodePassword;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Services\auth\RegisterUserService;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    public function forgot(ForgotPasswordRequest $request)
    {

        if(!User::where('email', $request->email)->exists()){
            return responder()->error('404', __('user not found'))->respond(400);
        }

        $data['email']=$request->email;
        // Delete all old code that user send before.
        ResetCodePassword::where('email', $request->email)->delete();

        // Generate random code
        $data['code'] = mt_rand(100000, 999999);

        // Create a new code
        $codeData = ResetCodePassword::create($data);

        // Send email to user
        Mail::to($request->email)->send(new SendCodeResetPassword($codeData->code));
        return responder()->success(['message'=>trans('passwords.sent')])->respond(200);

    }
    public function reset(ResetPasswordRequest $request)
    {

        $passwordReset = ResetCodePassword::where('code',$request->input('code') )->first();
        if ($passwordReset->isExpire()) {
            return $this->jsonResponse(null, __('code is expire'), 422);
        }

        $user = User::where('email', $passwordReset->email)->first();

        $user->update(['password'=>Hash::make($request->input('password'))]);
        $user->save();
        $passwordReset->delete();
        return responder()->success(['message'=>__('password changed successfully')])->respond(200);
    }
}
