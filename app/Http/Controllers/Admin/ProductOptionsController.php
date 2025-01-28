<?php

namespace App\Http\Controllers\Admin;

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
        if (!Admin()->can('option products view')) {
            abort(401);
        }
        if ($request->ajax()) {
            $data = ItemOption::basic();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return view('components.table_crud', [
                        'entity' => $row,
                        'showViewButton' => false,
                        'showEditButton' => true,
                        'showDeleteButton' => true,
                    ])->render();
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.product-options.index');
    }

    public function create()
    {
        if (!Admin()->can('option products create')) {
            abort(401);
        }
        return view('admin.product-options.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductOptionsRequest $request)
    {
        if (!Admin()->can('option products create')) {
            abort(401);
        }
        ProductOptionsService::storeFromRequest($request);
        return redirect()->back()->with('message', __('created successfully'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ItemOption $entity)
    {
        if (!Admin()->can('option products edit')) {
            abort(401);
        }
        return view('admin.product-options.edit', ['entity' => $entity]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductOptionsRequest $request, ItemOption $entity)
    {
        if (!Admin()->can('option products edit')) {
            abort(401);
        }
        ProductOptionsService::updateFromRequest($entity, $request);

        return redirect()->back()->with('message', __('updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, ItemOption $entity)
    {
        if (!Admin()->can('option products delete')) {
            abort(401);
        }
        $entity->delete();
        return redirect()->back()->with('message', __('deleted successfully'));
    }

}
