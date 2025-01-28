<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Item;
use App\Repositories\GenralSettingRepository;
use App\Repositories\ItemRepository;
use App\Services\CartService;
use App\Services\ReferralService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReferralController extends Controller
{
    public function index(){
        return view('site.referral.index', [
            'usersIReferred' => getLogged()->usersIReferred()->orderBy('id', 'desc')->paginate(10),
            'countOfReferrals' => getLogged()->usersIReferred()->count(),
            'profits' => getLogged()->referralProfits(),
        ]);
    }
    public function detectReferral($code){
        ReferralService::detectReferals($code);
        return redirect()->to("/");
    }

}
