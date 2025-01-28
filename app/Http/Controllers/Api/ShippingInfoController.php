<?php

namespace App\Http\Controllers\Api;

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
        $query = ShippingInfo::where('user_id', getLogged()->id);
        return responder()->success($query)->respond();

    }

    public function store(ShippingInfoRequest $request)
    {
        $request->id == null ? ShippingInfoService::storeFromRequest($request) : ShippingInfoService::updateFromRequest($request);
        return responder()->success([__('created successfully')])->respond();
    }

    public function destroy($entity)
    {
        try {
            $entity = ShippingInfo::where('id', $entity)->first();
            if ($entity) {
                $entity->delete();
                return responder()->success('message', __('deleted successfully'))->respond();
            }
            return responder()->error(200, __('not found or already deleted'))->respond();
        } catch (\Exception $ex) {
            return responder()->error(200, __('not found or already deleted'))->respond();
        }

    }
}
