<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;



use App\Models\Page;


use Illuminate\Http\Request;


class PagesController extends Controller
{
    public function index(Request $request)
    {
        $query = Page::select('*');
        if($request->filled('page')){
         $query=$query->where('route_name',$request->page);
        }


        return responder()->success($query)->respond();
    }





    public function show(Page $entity)
    {
        //
    }



}
