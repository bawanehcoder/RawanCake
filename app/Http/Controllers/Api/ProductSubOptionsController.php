<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductOptionsRequest;
use App\Http\Requests\Admin\ProductsRequest;

use App\Http\Requests\Admin\ProductSubOptionsRequest;
use App\Http\Requests\Admin\UpdateProductsRequest;

use App\Models\Item;
use App\Models\ItemOption;
use App\Models\Photo;
use App\Models\SubOption;
use App\Services\CategoriesService;
use App\Services\MainCategoriesService;

use App\Services\ProductOptionsService;
use App\Services\ProductsService;
use App\Services\ProductSubOptionsService;
use Illuminate\Http\Request;

use DataTables;

class ProductSubOptionsController extends Controller
{
    public function index(Request $request)
    {
        $query = SubOption::select('*');
        return responder()->success($query)->respond();
       // __($row->getStatusName('Available'))
    }

    public function create()
    {

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductSubOptionsRequest $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(SubOption $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubOption $entity)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductSubOptionsRequest $request, SubOption $entity)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, SubOption $entity)
    {

    }

}
