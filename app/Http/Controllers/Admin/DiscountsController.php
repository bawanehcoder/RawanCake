<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DiscountRequest;
use App\Http\Requests\Admin\OffersRequest;
use App\Http\Requests\Admin\ProductsRequest;
use App\Http\Requests\Admin\UpdateProductsRequest;


use App\Models\Category;
use App\Models\Discount;
use App\Models\Item;
use App\Models\Offer;

use App\Services\CategoriesService;
use App\Services\DiscountService;
use App\Services\DraftService;
use App\Services\OfferService;
use App\Services\ProductsService;
use Illuminate\Http\Request;
use DataTables;
class DiscountsController extends Controller
{
    public function index(Request $request)
    {
        if(!Admin()->can('discount view')){
            abort(401);
        }
        if ($request->ajax()) {
            $data = Discount::query();
            $data=$data->where('Type',$request->type);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('Cats', function ($row) {
                    if($row->Type=='section'){
                        $cats= Category::whereIn('id',json_decode($row->Cats))->get() ;
                         return view('components.categories-table', ['items' => $cats,])->render();
                    }else{
                        $items= Item::whereIn('id',json_decode($row->Cats))->get() ;
                        return view('components.item-table', ['items' => $items,])->render();
                    }
                })
                ->addColumn('action', function ($row) {
                    return view('components.table_crud', [
                        'entity' => $row,
                        'showViewButton' => false,
                        'showEditButton' => true,
                        'showDeleteButton' => true,
                    ])->render();
                })
                ->rawColumns(['action','Cats'])
                ->make(true);
        }

        return view('admin.discounts.index',['type'=>$request->type]);
    }

    public function create(Request $request)
    {
        if(!Admin()->can('discount create')){
            abort(401);
        }
        $type=$request->type;
        if($type=='section'){
            $categories=Category::where('CatID','>',0)->get();
           return view('admin.discounts.create',['categories'=>$categories,'type'=>$type]);
        }else{
            $categories=Item::all();
            return view('admin.discounts.create',['categories'=>$categories,'type'=>$type]);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(DiscountRequest $request)
    {
        if(!Admin()->can('discount create')){
            abort(401);
        }
        $discounts=DiscountService::storeFromRequest($request);
        return $discounts?redirect()->back()->with('message', __('created successfully')): redirect()->back()->withErrors( __('something went wrong'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Discount $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Discount $entity)
    {
        if(!Admin()->can('discount edit')){
            abort(401);
        }
        $type=$entity->Type;
        if($type=='section'){
            $categories=Category::where('CatID','>',0)->get();
        }else{
            $categories=Item::all();
        }
        $categories_select=json_decode($entity->Cats);
        return view('admin.discounts.edit', ['categories'=>$categories,'categories_select'=>$categories_select,'entity' => $entity]);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(DiscountRequest $request, Discount $entity)
    {
        if(!Admin()->can('discount edit')){
            abort(401);
        }
        $entity= DiscountService::updateFromRequest($entity,$request);
        return $entity?redirect()->route('dashboard.discounts.edit', $entity)->with('message', __('update successfully')): redirect()->back()->withErrors( __('something went wrong'));


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Discount $entity)
    {
        if(!Admin()->can('discount delete')){
            abort(401);
        }
        DraftService::saveDraft($entity,'delete');
        $entity->delete();
        return redirect()->back()->with('message', __('deleted successfully'));
    }
}
