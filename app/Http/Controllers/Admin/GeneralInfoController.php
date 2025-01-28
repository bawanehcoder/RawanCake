<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GenralInfoRequest;
use App\Models\Category;
use App\Models\GeneralInfo;
use App\Services\GeneralInfoService;
use Illuminate\Http\Request;

class GeneralInfoController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        if(!Admin()->can('general information edit')){
            abort(401);
        }
        $entity=GeneralInfo::first();
        return view('admin.general-info.edit',['entity'=>$entity]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GenralInfoRequest $request,GeneralInfo $entity)
    {
        if(!Admin()->can('general information edit')){
            abort(401);
        }
        $entity=GeneralInfoService::updateFromRequest($request);
        return view('admin.general-info.edit', ['entity' => $entity]);
    }


}
