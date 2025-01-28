<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MainCategoriesRequest;
use App\Http\Requests\Admin\UpdateMainCategoriesRequest;
use App\Interfaces\RepositoryInterface;
use App\Models\Category;
use App\Models\Photo;
use App\Services\CategoriesService;
use DataTables;
use Illuminate\Http\Request;

class MainCategoriesController extends Controller
{
    public function __construct(RepositoryInterface $repository)
    {
        $this->mainCategoriesRepository = $repository;
    }

    public function index()
    {
        $query = Category::where('CatID', 0)->where('ShortcutName', '<',1000)->orderBy('ShortcutName','ASC')->where('Visible',1);
        return responder()->success($query)->respond();
    }

    public function create()
    {

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(MainCategoriesRequest $request)
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
