<?php

namespace App\Models\Traits;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
trait AuthorizeCheckTrait
{

    public function authorizeCheck($permission)
    {

        $role_user = Role::find(Admin()->role);

        if($role_user){
            $permissions = $role_user->permissions->pluck('name')->toArray();

            if (!in_array($permission, $permissions)) {
                return false;
            }
        }
        return true;

//        if (!Auth::guard('admin')->user()->can($permission)) {

    }

//    public function authorizeGroubCheck($permission): bool
//    {
//        $role_user = Role::find(Auth::guard('admin')->user()->role);
//        if($role_user){
//            $permissions = $role_user->permissions->pluck('name')->toArray();
//            $m_array = preg_grep('/^'.$permission.'\s.*/', $permissions);
//            if ($m_array<1) {
//                return false;
//            }
//        }
//        return true;
//    }



//    public function hasAnyPermission(...$permissions): bool
//    {
//        $permissions = collect($permissions)->flatten();
//
//        foreach ($permissions as $permission) {
//            if ($this->authorizeCheck($permission)) {
//                return true;
//            }
//        }
//
//        return false;
//    }
}
