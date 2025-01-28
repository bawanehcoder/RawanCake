<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductOptionsRequest;
use App\Http\Requests\Admin\ProductsRequest;

use App\Http\Requests\Admin\UpdateProductsRequest;

use App\Models\Item;
use App\Models\ItemOption;
use App\Models\Photo;
use App\Services\CategoriesService;
use App\Services\MainCategoriesService;

use App\Services\ProductOptionsService;
use App\Services\ProductsService;
use Illuminate\Http\Request;

use DataTables;

class ProductOptionsController extends Controller
{
    public function index(Request $request)
    {

        $query = ItemOption::select('*');
        return responder()->success($query)->respond();

    }

    public function create()
    {
        return view('admin.product-options.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductOptionsRequest $request)
    {

        ProductOptionsService::storeFromRequest($request);
        return redirect()->back()->with('message', __('created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ItemOption $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ItemOption $entity)
    {

        return view('admin.product-options.edit', ['entity' => $entity]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductOptionsRequest $request, ItemOption $entity)
    {
        ProductOptionsService::updateFromRequest($entity, $request);

        return redirect()->back()->with('message', __('updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, ItemOption $entity)
    {
        $entity->delete();
        return redirect()->back()->with('message', __('deleted successfully'));
    }

}
