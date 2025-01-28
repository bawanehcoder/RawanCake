<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\ShowPaymentFormRequest;
use App\Http\Requests\Site\StorePaymentRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\ShippingInfo;
use App\Models\Zones;
use App\Repositories\GenralSettingRepository;
use App\Services\ActionPointService;
use App\Services\CartService;
use App\Services\ConditionalDeliverieService;
use App\Services\OrderService;
use App\Services\Payment\PaytabsConfig;
use App\Services\Payment\PaytabsService;
use App\Transformers\ZonesTransformer;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PaymentController extends Controller
{


    public function __construct(public GenralSettingRepository $genralSettingRepository)
    {
    }


    public function redirectToPaymentGateway(StorePaymentRequest $request)
    {

        $shippingInfo = ShippingInfo::find($request->address_id);
        if (!$shippingInfo) {

            $shippingInfo = ShippingInfo::where('user_id', auth()->user()->id)->first();
        }
        if (empty($request['zone'] )) {
            // $request['name'] = $shippingInfo->name;
            $request['zone'] = $shippingInfo->zone_id;
            // $request['place'] = $shippingInfo->address;
        }


        // $request['name'] = $shippingInfo->name;
        // $request['zone'] = $shippingInfo->zone_id;
        // $request['place'] = $shippingInfo->address;

        // dd(CartService::getCarts($request));



        $paymentOrder = OrderService::storeFromRequest($request);
        // dd($paymentOrder);
        if ($paymentOrder) {
            //redirect to payment page accoring to given preferred method
            switch ($request->payment_method) {
                case 'cash_on_delivery':
                    foreach (CartService::getCarts(request: $request) as $cart) {
                        $cart->delete();
                    }
                    $point = ActionPointService::getActionPoint('purchase_points');
                    $point = ($paymentOrder->Total * $point) * 100;
                    if ($point > 0) {
                        getLogged()->chargePoints($point, 'new purchase points order no =' . $paymentOrder->id);
                    }
                    return responder()->success(['id' => $paymentOrder->id])->respond();
                case 'payment_by_credit_card':
                    // $paymentOrder->Source = 2;
                    // $paymentOrder->save();
                    return responder()->success(['id' => $paymentOrder->id])->respond();
            }
        }
    }

    public function handleWebhook(Request $request, Order $entity)
    {

        $is_success = $request->respStatus ?? '' === 'A';
        if ($is_success) {
            $entity->PaymentNo = $request->tranRef ?? '';
            $entity->PaymentData = $request->respCode ?? '';
            $entity->PaymentStatus = $request->respStatus ?? '';
            $entity->save();
            $point = ActionPointService::getActionPoint('purchase_points');
            if ($point > 0) {
                $entity->user->chargePoints($point, 'new purchase points order no =' . $entity->id);
            }
            foreach (Cart::where('user_id', $entity->UserID)->get() as $cart) {
                $cart->delete();
            }
        } else {
            foreach ($entity->order_details as $item) {
                $item->forceDelete();
            }
            $entity->PaymentNo = $request->tranRef ?? '';
            $entity->PaymentData = $request->respCode ?? '';
            $entity->PaymentStatus = $request->respStatus ?? '';
            if ($entity->orderCoupon) {
                $entity->orderCoupon->coupon->decreaseCoupon();
                $entity->orderCoupon->delete();
            }
            $entity->save();
            $entity->delete();
        }
        return responder()->success()->respond();
    }

}
