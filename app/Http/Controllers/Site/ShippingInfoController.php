<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ZonesRequest;
use App\Http\Requests\Site\ShippingInfoRequest;
use App\Models\Zones;
use \App\Models\ShippingInfo;
use App\Services\CartService;
use App\Services\ShippingInfoService;

use Illuminate\Http\Request;
use DataTables;
use Illuminate\Http\Response;

class ShippingInfoController extends Controller
{
    public function index(Request $request)
    {
        if (($request->ajax())) {
            CartService::updateAmount($request);
            return responder()->success()->respond();
        }
        $zones = Zones::select('*')->get();
        $shipping_info=ShippingInfo::where('user_id',getLogged()->id)->get();
        return view('site.cart.shipping-info',['zones'=>$zones,'shipping_info'=>$shipping_info]);
    }
    public function store(ShippingInfoRequest $request)
    {

          $request->id==null?ShippingInfoService::storeFromRequest($request):ShippingInfoService::updateFromRequest($request);
        return  redirect()->back()->with('message', __('the message has been sent successfully'));
    }
    public function destroy(Request $request, ShippingInfo $entity)
    {
        $entity->delete();
        return redirect()->back()->with('message', __('deleted successfully'));
    }
}
