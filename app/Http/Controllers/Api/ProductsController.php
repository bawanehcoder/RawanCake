<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MainCategoriesRequest;
use App\Http\Requests\Admin\ProductsRequest;
use App\Http\Requests\Admin\SubCategoriesRequest;
use App\Http\Requests\Admin\UpdateMainCategoriesRequest;
use App\Http\Requests\Admin\UpdateProductsRequest;
use App\Models\Category;
use App\Models\Item;
use App\Models\MobileSlider;
use App\Models\Photo;
use App\Repositories\GenralSettingRepository;
use App\Repositories\ItemRepository;
use App\Services\CategoriesService;
use App\Services\DiscountService;
use App\Services\MainCategoriesService;
use App\Services\MediaService;
use App\Services\ProductsService;
use Illuminate\Http\Request;
use App\Services\B2UrlGenerator;
use DataTables;

class ProductsController extends Controller
{
    public function __construct(public ItemRepository $productRepo, public GenralSettingRepository $genralSettingRepository)
    {
    }

    public function index(Request $request)
    {
        $query = Item::select('*')->orderByRaw('CAST(R_ItemShortcut AS UNSIGNED) ASC')->where('Available', 1);
        if ($request->filled('category')) {
            $cat = Category::find($request->category);
            if ($cat->CatID == 0) {
                $cats = Category::where('CatID', $cat->id)->pluck('id');
                $query = $query->whereIn('CatID', $cats);
            } else {
                $query = $query->where('CatID', $request->category);
            }
        }
        if ($request->filled('search')) {
            $searchFor = strip_tags(str_replace(['\\', '/', ';', '\'', '(', ')'], '', $request->search));
            $query = $query->where('Name', 'LIKE', '%' . $searchFor . '%')->orWhere('NameEN', 'LIKE', '%' . $searchFor . '%');
        }
        return responder()->success($query)->respond();
    }

    public function newProducts(Request $request)
    {
        $limet = 3;
        if ($request->filled('limet')) {
            $limet = $request->limet;
        }
        $query = $this->productRepo->getNewProducts($limet);
        return responder()->success($query)->respond();
    }

    public function randomProducts()
    {
        $query = Item::inRandomOrder()->limit(3)->get();
        return responder()->success($query)->respond();
    }


    public function create()
    {
    }

    public function flashSale(Request $request)
    {
        if ($request->type == 'item') {
            $data = MobileSlider::whereNotNull('item_id')->get();
        }
        if ($request->type == 'category') {
            $data = MobileSlider::whereNotNull('category_id')->get();
        }

        return responder()->success($data)->respond();
    }
    public function optionDetil(Item $entity)
    {

        $options = $entity->optionDetil->groupBy('POptID');
        $data = [];
        foreach ($options ?? [] as $optin) {

            $data[$optin[0]->id] =
                [
                    'id' => $optin[0]->id,
                    'title_ar' => $optin[0]->subOption->itemOption->Name,
                    'title_en' => $optin[0]->subOption->itemOption->NameEN
                ];
            foreach ($optin as $i => $item) {
                $data[$optin[0]->id]['optin'][$i] =
                    [
                        'id' => $item->subOption->id,
                        'title_ar' => $item->subOption->Name,
                        'title_en' => $item->subOption->NameEN,
                        'AdditionalValue' => $item->AdditionalValue
                    ];
            }
        }
        return responder()->success(['options' => $data])->respond();
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductsRequest $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $category)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $entity)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductsRequest $request, Item $entity)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Item $entity)
    {
    }

}
