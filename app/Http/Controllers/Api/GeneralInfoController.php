<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GenralInfoRequest;
use App\Models\Category;
use App\Models\GeneralInfo;
use App\Services\GeneralInfoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class GeneralInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = GeneralInfoService::getGeneralInfo();
        return responder()->success($query)->respond();
    }


}
