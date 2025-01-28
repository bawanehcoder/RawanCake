<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\CouponsRequest;


use App\Models\Coupon;
use App\Services\CouponsService;



use Illuminate\Http\Request;

use DataTables;

class CouponsController extends Controller
{



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

       CouponsService::storeFromRequest($request);
        return redirect()->back()->with('message', __('created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function check(CouponsRequest $request)
    {
        $check= CouponsService::check($request->code);
        return responder()->success(['coupons'=>$check])->respond();
    }









}
