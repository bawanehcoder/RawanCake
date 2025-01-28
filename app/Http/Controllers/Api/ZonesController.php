<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ZonesRequest;
use App\Models\Zones;
use App\Services\ZonesService;
use Illuminate\Http\Request;
use DataTables;
class ZonesController extends Controller
{
    public function index(Request $request)
    {
        $query = Zones::select('*');
        return responder()->success($query)->respond();
    }
}
