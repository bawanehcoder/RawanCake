<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;


use App\Http\Requests\Admin\SliderRequest;
use App\Models\Slide;
use App\Services\SliderService;
use Illuminate\Http\Request;
use DataTables;

class SliderController extends Controller
{
    public function index()
    {
        $query = Slide::select('*')->orderBy('index','ASC');
        return responder()->success($query)->respond();
    }



}
