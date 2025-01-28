<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\CouponsRequest;


use App\Models\Coupon;
use App\Services\CouponsService;



use Illuminate\Http\Request;

use DataTables;

class CouponsController extends Controller
{




    /**
     * Display the specified resource.
     */
    public function check(CouponsRequest $request)
    {
        $check= CouponsService::check($request->code);
        return responder()->success(['coupons'=>$check])->respond();
         }









}
