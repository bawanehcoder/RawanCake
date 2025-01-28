<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductsRequest;
use App\Http\Requests\Admin\UpdateProductsRequest;
use App\Models\Item;
use App\Models\ItemOption;
use App\Models\Operator;
use App\Models\OptionDetil;
use App\Models\Photo;
use App\Services\CategoriesService;

use App\Services\ProductsService;

use Illuminate\Http\Request;

use DataTables;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        if (!Admin()->can('products view')) {
            abort(401);
        }
        if ($request->ajax()) {
            $data = Item::select('*');
           if($request->filled('subCategories')){
               $data=$data->where('CatID',$request->subCategories);
           }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    return '<img src="' . $row->getFirstMediaUrl('products', 'small') . '">';
                })
                ->addColumn('Available', function ($row) {
                    return __($row->getStatusName('Available'));
                })
                ->addColumn('CatID', function ($row) {
                    $sub_cat=$row->subCategory;
                    if($sub_cat){
                        return $sub_cat->Name."|".$sub_cat->NameEN;
                    }

                })
                ->addColumn('action', function ($row) {
                    return view('components.table_crud', [
                        'entity' => $row,
                        'showViewButton' => false,
                        'showEditButton' => false,
                        'showDeleteButton' => false,
                        'showOptionsButton' => true,
                    ])->render();
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }

        return view('admin.products.index',['sub_categories'=>CategoriesService::getSubCategories()]);
    }

    public function create()
    {
        if (!Admin()->can('products create')) {
            abort(401);
        }
        $operators=Operator::all();
        return view('admin.products.create',['sub_categories'=>CategoriesService::getSubCategories(),'operators'=>$operators]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductsRequest $request)
    {
        if (!Admin()->can('products create')) {
            abort(401);
        }
        ProductsService::storeFromRequest($request);
        return redirect()->back()->with('message', __('created successfully'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $entity)
    {
        if (!Admin()->can('products edit')) {
            abort(401);
        }
        $operators=Operator::all();
        return view('admin.products.edit', ['sub_categories'=>CategoriesService::getSubCategories(),'entity' => $entity,'operators'=>$operators]);

    }


    public function options(Request $request,Item $entity)
    {
        if (!Admin()->can('option products view')) {
            abort(401);
        }
        if ($request->ajax()) {
            $data = OptionDetil::where('ItemID',$entity->id);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('OptID', function ($row) {
                    $sub_opt=$row->subOption;
                    if($sub_opt){
                        return $sub_opt->Name."|".$sub_opt->NameEN;
                    }
                })
                ->addColumn('action', function ($row) {
                    return view('components.table_crud', [
                        'entity' => $row,
                        'showViewButton' => false,
                        'showEditButton' => false,
                        'showDeleteButton' => false,

                    ])->render();
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }
        return view('admin.products.options', ['options'=>ItemOption::basic()->get(),'entity' => $entity]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductsRequest $request, Item $entity)
    {
        if (!Admin()->can('products edit')) {
            abort(401);
        }
        ProductsService::updateFromRequest($entity,$request);

        return redirect()->back()->with('message', __('updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Item $entity)
    {
        if (!Admin()->can('products delete')) {
            abort(401);
        }
        $entity->delete();
        return redirect()->back()->with('message', __('deleted successfully'));
    }

}
