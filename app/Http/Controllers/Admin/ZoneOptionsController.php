<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ZoneOptionsRequest;
use App\Http\Requests\Admin\ZonesRequest;
use App\Models\ZoneOption;
use App\Models\Zones;
use App\Services\ZoneOptionsService;
use App\Services\ZonesService;
use Illuminate\Http\Request;
use DataTables;
class ZoneOptionsController extends Controller
{


    /**
     * Store a newly created resource in storage.
     */
    public function store(ZoneOptionsRequest $request,Zones $entity)
    {
        if (!Admin()->can('delivery locations view')) {
            abort(401);
        }
        ZoneOptionsService::storeFromRequest($request);
        return redirect()->route('dashboard.zones.edit',$entity)->with('message', __('created successfully'));
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ZoneOption $entity)
    {
        if (!Admin()->can('delivery locations delete')) {
            abort(401);
        }
        $entity->delete();
        return redirect()->back()->with('message', __('deleted successfully'));
    }
}
