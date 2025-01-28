<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\ChangePasswordRequest;
use App\Http\Requests\Site\ProfuleUserRequest;
use App\Http\Requests\Site\StoreImageRequest;
use App\Models\User;
use App\Services\MediaService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function logout(Request $request)
    {
        if (auth('sanctum')->user()) {
            auth('sanctum')->user()->tokens()->delete();
            return response(['message' => @langucw('Successfully logged out')], 200);
        }
        return response(['message' => @langucw('You are logged out')], 200);
    }

    public function whoAmI()
    {
        return responder()->success(getLogged())->respond();
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        UserService::changePassword(getLogged(), $request->old_password, $request->new_password);
        return responder()->success()->meta(['message' => 'Password changed successfully.'])->respond();
    }

    public function updateAvatar(StoreImageRequest $request)
    {

        UserService::updateAvatarFromRequest(getLogged(), $request);
        return responder()->success([
            'avatar' => [
                'small' => getLogged()->avatar('smal'),
                'medium' => getLogged()->avatar('medium'),
                'large' => getLogged()->avatar('large'),
            ]

        ])->meta([
            'message' => 'avatar updated successfully',
        ])->respond();
    }

    public function completeMyProfile(ProfuleUserRequest $request)
    {
        UserService::updateFromRequest(getLogged(),$request);
        return $this->whoAmI();
    }

    public function delete(){

        try {
            User::find(getLogged()->id)->delete();
            return response(['message' => @langucw('your account deleted successfully')], 200);
        } catch (\Throwable $th) {
            return response(['message' => @langucw('user not found')], 500);
            
        }


    }

}
