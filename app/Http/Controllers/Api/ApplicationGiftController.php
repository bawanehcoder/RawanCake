<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ApplicationGift;

use Illuminate\Http\Request;

class ApplicationGiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ApplicationGift::select('*');
        return responder()->success($query)->respond();
    }


}
