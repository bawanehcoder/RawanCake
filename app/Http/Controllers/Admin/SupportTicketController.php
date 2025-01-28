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
class SupportTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {


        if(!Admin()->can('users admin view')){
            abort(401);
        }



        return view('admin.support-ticket.index');




    }


}
