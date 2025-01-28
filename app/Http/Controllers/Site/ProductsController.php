<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\ProductsRequest;

use App\Http\Requests\Admin\UpdateProductsRequest;
use App\Models\Category;
use App\Models\Item;
use App\Models\Photo;
use App\Repositories\GenralSettingRepository;

use App\Services\CartService;

use App\Services\DiscountService;
use App\Services\MainCategoriesService;

use App\Services\UserFavoriteService;
use Illuminate\Http\Request;

use DataTables;
use Illuminate\Http\Response;


class ProductsController extends Controller
{
    public function __construct(public GenralSettingRepository $genralSettingRepository)
    {
    }

    public function index(Request $request, Category $entity = null, Category $sub = null)
    {


        $products = Item::query();

        if ($sub) {
            $products = $products->where('CatID', $sub->id);
        }
        if ($entity) {
            if ($sub == null) {
                $ids = Category::where('CatID', $entity->id)->pluck('id')->toArray();
                $products = $products->whereIn('CatID', $ids);
                // $sub=Category::where('CatID',$entity->id)->first();
            }
        }
        if ($request->search != null && $request->search != '') {
            $searchFor = strip_tags(str_replace(['\\', '/', ';', '\'', '(', ')'], '', $request->search));
            $products = $products->whereRaw("TRIM(CONCAT(Name, ' ', NameEN, ' ')) like '%{$searchFor}%'");
        }


        if ($request->ajax() || $request->wantsJson()) {
            return \View::make('site.products.index-block', [
                'main_category' => $entity,
                'search' => $request->search ?? '',
                'genralSetting' => $this->genralSettingRepository,
                'sub_category' => $sub ?? null,
                'products' => $products->paginate(config('core.setting.perPage')),
                'page' => $request->page ?? 0,

            ])->render();
        }



        return view('site.products.index', [
            'main_category' => $entity,
            'search' => $request->search ?? '',
            'genralSetting' => $this->genralSettingRepository,
            'sub_category' => $sub ?? null,
            'products' => $products->orderByRaw('CAST(R_ItemShortcut AS UNSIGNED) ASC')->where('Available',1)->get(),
            'page' => $request->page ?? 0
        ]);
    }

    public function create()
    {

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductsRequest $request)
    {

    }
    public function quickShow(Item $entity)
    {



        $discount = DiscountService::getDiscountByItem($entity);
        $endDate = DiscountService::getDiscountEndDateByItem($entity);
        $offer = $entity->offerActive->last();
        $entity->incrementReadCount();
        return view('site.layout.modal.exampleProductModal', [
            'product' => $entity,
            'discount' => $discount,
            'endDate' => $endDate,
            'offer' => $offer,
        ])->render();
    }
    /**
     * Display the specified resource.
     */
    public function show(Item $entity)
    {
        \SEO::setTitle($entity->getTitle())
            ->setDescription($entity->getDescription());
        $products = Item::inRandomOrder()->limit(3)->get();
        $entity->incrementReadCount();
        $discount = DiscountService::getDiscountByItem($entity);
        $endDate = DiscountService::getDiscountEndDateByItem($entity);
        $offer = $entity->offerActive->last();
        return view('site.products.show', [
            'product' => $entity,
            'products' => $products,
            'discount' => $discount,
            'endDate' => $endDate,
            'offer' => $offer,
            'genralSetting' => $this->genralSettingRepository
        ]);

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
