<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Item;
use App\Models\Traits\MediaUploadingTrait;
use App\Repositories\GenralSettingRepository;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CartController extends Controller
{ use MediaUploadingTrait;
    public function __construct(public GenralSettingRepository $genralSettingRepository)
    {
    }

    public function index(Request $request)
    {
        $carts = CartService::getCarts();
        if ($request->ajax() || $request->wantsJson()) {
            return \View::make('components.cart.offcanvas-cart', [
                'carts' => $carts,
                'genralSetting' => $this->genralSettingRepository,
            ])->render();

            
        }
        return view('site.cart.index', ['carts' => $carts, 'genralSetting' => $this->genralSettingRepository]);
    }

    public function addToCart(Request $request, Item $entity)
    {
        $add_cart = CartService::addToCart($request, $entity);
        switch ($add_cart) {
            case Response::HTTP_OK:
                return responder()->success(['count' => CartService::getCarts()->count()])->respond();
            case Response::HTTP_INTERNAL_SERVER_ERROR:
                return responder()->error(500, __('something went wrong'))->respond();
        }
        
    }

    public function destroy(Request $request, Cart $entity)
    {
        $entity->forceDelete();
        return redirect()->back()->with('message', __('deleted successfully'));
    }

    public function cart_content()
    {
        $carts = CartService::getCarts();
        return view('components.cart.offcanvas-cart', ['carts' => $carts]);
    }
}
