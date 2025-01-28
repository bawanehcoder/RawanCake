<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\ProfuleUserRequest;
use App\Models\Cart;
use App\Models\Item;
use App\Repositories\GenralSettingRepository;
use App\Repositories\ItemRepository;
use App\Services\CartService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MyprofileController extends Controller
{

    public function index(Request $request){
        return view('site.myprofile.index');
    }
    public function completeMyProfile(ProfuleUserRequest $request)
    {

        UserService::updateFromRequest(getLogged(),$request);
        if($request['current-pwd']!=null && !empty($request['current-pwd'])  ){
            UserService::changePassword(getLogged(),$request['current-pwd'], $request['new-pwd']);

        }

        return responder()->success()->respond();
    }

}
