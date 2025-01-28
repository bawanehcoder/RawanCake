<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateAdminRequest;
use App\Http\Requests\Admin\RoleAndPermissionRequest;
use App\Models\Admin;
use App\Models\Role;
use App\Models\Traits\AuthorizeCheckTrait;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use DataTables;
class UserAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {


        if(!Admin()->can('users admin view')){
            abort(401);
        }

        if ($request->ajax()) {

            $data = Admin::query();

            return Datatables::of($data)
                ->addIndexColumn()


                ->addColumn('avatar', function ($row) {
                    return view('components.avatar', [
                        'entity' => $row,
                    ])->render();
                })

                ->addColumn('action', function ($row) {
                    return view('components.table_crud', [
                        'entity' => $row,
                        'showViewButton' => true,
                        'showEditButton' => true,
                        'showDeleteButton' => true,
                        'otherUrls' => [[
                            'title' => 'update permisitons',
                            'url' => route('dashboard.user-admin-permission.edit', ['entity' => $row]),
                            'icon' => 'fas fa-bars'
                        ],
                            [
                                'title' => 'show permisitons',
                                'url' => route('dashboard.user-admin-permission.show', ['entity' => $row]),
                                'icon' => 'fas fa-bars'
                            ]
                        ],

                    ])->render();
                })

                ->rawColumns(['action', 'avatar'])
                ->make(true);
        }

        return view('admin.user-admin.index');




    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!Admin()->can('users admin create')){
            abort(401);
        }

        return view('admin.user-admin.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateAdminRequest $request)
    {
        if(!Admin()->can('users admin create')){
            abort(401);
        }
        $request=$request->all();
        $user=new Admin(['name'=>$request['name'],'email'=>$request['email'],'password'=>$request['password'],'avatar'=>'']);
        $user->save();
        return redirect()->back()->with('message', __('created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $entity)
    {

        if(!Admin()->can('users admin view')){
            abort(401);
        }
        return view('admin.user-admin.show',['entity'=>$entity]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $entity)
    {

        if(!Admin()->can('users admin edit')){
            abort(401);
        }
        return view('admin.user-admin.edit',['entity'=>$entity]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateAdminRequest $request, Admin $entity)
    {

        if(!Admin()->can('users admin edit')){
            abort(401);
        }
        $entity->update(['name'=>$request['name'],'email'=>$request['email'],'password'=>$request['password'],'avatar'=>'']);
        $entity->save();
        return redirect()->back()->with('message', __('created successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $entity)
    {

        if(!Admin()->can('users admin delete')){
            abort(401);
        }
        $role_user= \Spatie\Permission\Models\Role::find($entity->role);
        if($role_user) {
            $permissions = $role_user->permissions;
            $role_user->revokePermissionTo($permissions);
            $role_user->delete();
        }
        $entity->delete();
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        return redirect()->back()->with('message', __('deleted successfully'));
    }
}
