<?php

use Carbon\Carbon;
use \Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

function getAvailableGuards($exclude = [])
{
    $newGuards = [];

    foreach (array_keys(config('auth.guards')) as $guard) {
        if (!in_array($guard, $exclude)) {
            $newGuards[] = $guard;
        }
    }

    return $newGuards;
}

function getAliassOfMorphedClass($obj)
{
    //if class name given
    if (is_string($obj)) {
        return array_search($obj, \Illuminate\Database\Eloquent\Relations\Relation::morphMap());
    }
    //if object given

    return $obj->getMorphClass();
}

function getGuardOfUser($user)
{

    return getAliassOfMorphedClass($user);
}

function getLogged()
{
    $guards = getAvailableGuards();
    // dd($guards);
    foreach ($guards as $guard) {

        if (Auth::guard($guard)->check()) {
            $user = Auth::guard($guard)->user();
            // \Illuminate\Support\Facades\Log::info($guard);
            // \Illuminate\Support\Facades\Log::info($user->id);
            try {
                $user->UpdateLastSeen();
            } catch (Exception $ex) {

            }
            return $user;
        }
    }
}

function getLoggedId()
{
    $guards = getAvailableGuards();
    foreach ($guards as $guard) {
        if (Auth::guard($guard)->check()) {
            return Auth::guard($guard)->id();
        }
    }
}

function isLogged()
{
    if (!isUser()) return false;
    $guards = getAvailableGuards();
    foreach ($guards as $guard) {
        if (Auth::guard($guard)->check()) {
            return true;
        }
    }

}

function hasAnyPermission(...$permissions): bool
{


    $permissions = collect($permissions)->flatten();

    foreach ($permissions as $permission) {

        if (authorizeCheck($permission)) {

            return true;
        }
    }

    return false;
}

function authorizeCheck($permission)
{

    $role_user = Role::find(Auth::guard('admin')->user()->role);
    if ($role_user) {
        $permissions = $role_user->permissions->pluck('name')->toArray();
        if (!in_array($permission, $permissions)) {
            return false;
        }
    }
    return true;
}

function Admin()
{

    return Auth::guard('admin')->user();
}

function isAdmin()
{
    return Auth::guard('admin')->check();
}

function isUser()
{
    return Auth::guard('web')->check();
}

function isAnyGuardLogged()
{
    $guards = getAvailableGuards();
    foreach ($guards as $guard) {
        if (Auth::guard($guard)->check()) {
            return true;
        }
    }
}

function getGuardName()
{
    $guards = getAvailableGuards();
    foreach ($guards as $guard) {
        if (Auth::guard($guard)->check()) {
            $foundGuard = $guard;
            break;
        }
    }
    return str_replace('api-', '', $foundGuard);
}

function getUser($guard, $id)
{
    $guard = $guard == 'web' ? 'user' : $guard;
    $guard = strtolower($guard);

    $className = getClassNameOfAlias('user');
    return $className::find($id);
}

function print_sql($query)
{

    dd(str_replace_array('?', $query->getBindings(), $query->toSql()));
}
