<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CouponsRequest;
use App\Http\Requests\Admin\MainCategoriesRequest;
use App\Http\Requests\Admin\ProductsRequest;
use App\Http\Requests\Admin\SubCategoriesRequest;
use App\Http\Requests\Admin\UpdateCouponsRequest;
use App\Http\Requests\Admin\UpdateMainCategoriesRequest;
use App\Http\Requests\Admin\UpdateOptionDetilRequest;
use App\Http\Requests\Admin\UpdateProductsRequest;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Item;
use App\Models\ItemOption;
use App\Models\OptionDetil;
use App\Models\Photo;

use App\Services\CategoriesService;
use App\Services\CouponsService;
use App\Services\MainCategoriesService;

use App\Services\ProductsService;

use Illuminate\Http\Request;

use DataTables;

class CouponsController extends Controller
{
    public function index(Request $request)
    {
        if(!Admin()->can('coupon view')){
            abort(401);
        }
        if ($request->ajax()) {
            $data = Coupon::select('*');
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

        return view('admin.coupons.index');
    }

    public function create()
    {
        if(!Admin()->can('coupon create')){
            abort(401);
        }
        return view('admin.coupons.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CouponsRequest $request)
    {
        if(!Admin()->can('coupon create')){
            abort(401);
        }
       CouponsService::storeFromRequest($request);
        return redirect()->back()->with('message', __('created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $entity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $entity)
    {
        if(!Admin()->can('coupon edit')){
            abort(401);
        }
        return view('admin.coupons.edit', ['entity' => $entity]);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCouponsRequest $request, Coupon $entity)
    {
        if(!Admin()->can('coupon edit')){
            abort(401);
        }
        CouponsService::updateFromRequest($entity,$request);

        return redirect()->back()->with('message', __('updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Coupon $entity)
    {
        if(!Admin()->can('coupon delete')){
            abort(401);
        }
        $entity->delete();
        return redirect()->back()->with('message', __('deleted successfully'));
    }

}
