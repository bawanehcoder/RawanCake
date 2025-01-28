<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GenralSettingRequest;
use App\Models\Currencie;
use App\Models\GeneralSetting;
use App\Services\GenralSettingService;
use Illuminate\Http\Request;

class GeneralSettingController extends Controller
{

    public function edit()
    {
        if(!Admin()->can('general settings edit')){
            abort(401);
        }
        $entity=GeneralSetting::first();
        $currencies=Currencie::all();
        return view('admin.general-settings.edit',['entity'=>$entity,'currencies'=>$currencies]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GenralSettingRequest $request,GeneralSetting $entity)
    {
        if(!Admin()->can('general settings edit')){
            abort(401);
        }
        $entity=GenralSettingService::updateFromRequest($request);
        return redirect()->route('dashboard.generalSetting.edit')->with('message', __('updated successfully'));

    }


}
