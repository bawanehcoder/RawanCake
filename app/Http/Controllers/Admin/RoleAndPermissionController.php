<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleAndPermissionRequest;
use App\Models\Admin;


use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use DataTables;
class RoleAndPermissionController extends Controller
{



    public function show(Admin $entity)
    {
        if(!Admin()->can('users admin edit')){
            abort(401);
        }
        $permissions_all=Permission::all()->groupBy('group_name');
        $permissions=[];
        return view('admin.authorization.show',['entity'=>$entity,'permissions'=>$permissions_all,'permissions_user'=>$permissions]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $entity)
    {
        if(!Admin()->can('users admin edit')){
            abort(401);
        }
        $permissions_all=Permission::all()->groupBy('group_name');
        $permissions=[];
        return view('admin.authorization.edit',['entity'=>$entity,'permissions'=>$permissions_all,'permissions_user'=>$permissions]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleAndPermissionRequest $request, Admin $entity)
    {


        if(!Admin()->can('users admin edit')){
            abort(401);
        };

        $entity->syncPermissions($request['permissions_ids'],[]);

//        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();


        return redirect()->route('dashboard.user-admin-permission.edit',$entity);
    }


}
