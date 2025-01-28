<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MainCategoriesRequest;
use App\Http\Requests\Admin\SubCategoriesRequest;
use App\Http\Requests\Admin\UpdateMainCategoriesRequest;
use App\Models\Category;
use App\Models\Photo;
use App\Services\CategoriesService;
use App\Services\MainCategoriesService;
use App\Services\MediaService;
use Illuminate\Http\Request;
use App\Services\B2UrlGenerator;
use DataTables;

class SubCategoriesController extends Controller
{
    public function index(Request $request)
    {
        $query =Category::where('CatID','>',0);
        if($request->filled('main')){
            $query=$query->where('CatID',$request->main);
        }
        return responder()->success($query)->respond();
    }

    public function create()
    {
            }


    /**
     * Store a newly created resource in storage.
     */
    public function store(SubCategoriesRequest $request)
    {
           }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $entity)
    {
           }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMainCategoriesRequest $request, Category $entity)
    {
            }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Category $entity)
    {
    }

}
