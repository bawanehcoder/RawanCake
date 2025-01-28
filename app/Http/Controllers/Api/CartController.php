<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\CartApiRequest;
use App\Models\Cart;
use App\Models\Item;
use App\Repositories\GenralSettingRepository;
use App\Repositories\ItemRepository;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CartController extends Controller
{


    public function index(Request $request)
    {

        // dd($request['user_id']);
        $query = CartService::getCarts($request);
        return responder()->success($query)->respond();

    }
    public function addToCart(Request $request, Item $entity)
    {

        $add_cart = CartService::addToCart($request, $entity);
        switch ($add_cart) {
            case Response::HTTP_OK:
                $query = CartService::getCarts();
                return responder()->success($query)->respond();
            case Response::HTTP_INTERNAL_SERVER_ERROR:
                return responder()->error(500, __('something went wrong'))->respond();
        }
    }
    public function updateAmount(Request $request)
    {
        CartService::updateAmount($request);
        return responder()->success()->respond();
    }
    public function destroy($entity)
    {
        try {
            $entity = Cart::where('id', $entity)->first();
            if ($entity) {
                $entity->forceDelete();
            }
            return responder()->success('message', __('deleted successfully'))->respond();
        } catch (\Exception $ex) {
            return responder()->error(200, __('not found or already deleted'))->respond();
        }

    }
}
