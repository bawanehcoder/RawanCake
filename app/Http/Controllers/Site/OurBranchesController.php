<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\ContactRequest;
use App\Models\Branche;
use App\Services\BranchesService;
use App\Services\ContactService;


class OurBranchesController extends Controller
{
    public function show(){
        $branches=  BranchesService::getOurBranches();

        return view('site.our-branches',['branches'=>$branches]);

    }


}
