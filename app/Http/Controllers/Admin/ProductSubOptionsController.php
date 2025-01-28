<?php

namespace App\Http\Controllers\Admin;

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
        if (!Admin()->can('option products view')) {
            abort(401);
        }
        if ($request->ajax()) {
            $data = SubOption::select('*');
            if($request->filled('basic_options')){
                $data=$data->where('OptID',$request->basic_options);
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('Available', function ($row) {
                    return'<span class="badge badge-linesuccess">' . __($row->getStatusName('Available')) . '</span>';
                })
                ->addColumn('image', function ($row) {
                    return '<img src="' . $row->getFirstMediaUrl('product_sub_options', 'small') . '">';
                })
                ->addColumn('action', function ($row) {
                    return view('components.table_crud', [
                        'entity' => $row,
                        'showViewButton' => false,
                        'showEditButton' => true,
                        'showDeleteButton' => true,
                    ])->render();
                })
                ->rawColumns(['action', 'image','Available'])
                ->make(true);
        }

        return view('admin.product-sub-options.index',['basic_options'=>ItemOption::asc()->get()]);
    }

    public function create()
    {
        if (!Admin()->can('option products create')) {
            abort(401);
        }
        return view('admin.product-sub-options.create',['basic_options'=>ItemOption::asc()->get()]);
    }

    public function getSubOptionByParent(ItemOption $entity){
        return responder()->success(['subOption'=>$entity->subOption])->respond();

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductSubOptionsRequest $request)
    {
        if (!Admin()->can('option products create')) {
            abort(401);
        }
        ProductSubOptionsService::storeFromRequest($request);
        return redirect()->back()->with('message', __('created successfully'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubOption $entity)
    {
        if (!Admin()->can('option products edit')) {
            abort(401);
        }
        return view('admin.product-sub-options.edit', ['basic_options'=>ItemOption::asc()->get(),'entity' => $entity]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductSubOptionsRequest $request, SubOption $entity)
    {
        if (!Admin()->can('option products edit')) {
            abort(401);
        }
        ProductSubOptionsService::updateFromRequest($entity,$request);

        return redirect()->back()->with('message', __('updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, SubOption $entity)
    {
        if (!Admin()->can('option products delete')) {
            abort(401);
        }
        $entity->delete();
        return redirect()->back()->with('message', __('deleted successfully'));
    }

}
