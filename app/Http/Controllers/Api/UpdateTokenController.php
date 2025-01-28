<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UpdateTokenController extends Controller
{
    public function update(Request $request){
        if(getLogged()){
            $accessToken = getLogged()->device_token= $request['token'];

                    return responder()->success(getLogged())->meta([

                    ])->respond();
        }else{
            return responder()->error('400', __('user not found'))->respond(400);
        }

    }
}
