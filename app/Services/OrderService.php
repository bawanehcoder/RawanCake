<?php

namespace App\Services;

use App\Exceptions\SomethingWentWrongException;

use App\Models\Order;
use App\Models\Zones;
use App\Repositories\GenralSettingRepository;
use App\Transformers\ZonesTransformer;
use Exception;
use Illuminate\Support\Facades\DB;


class OrderService
{
    public static function storeFromRequest($request)
    {
        // dd($request);
        $carts = CartService::getCarts($request);

        
        

        
        if ($request->delivery_type == 'delivery_address') {
            try {
                $delivery_first_order = app()->make(GenralSettingRepository::class)->getDeliveryFirstOrderActive();
                $conditional_deliverie = ConditionalDeliverieService::isConditionalDeliverie($carts);

                if ($delivery_first_order == 'effective' && getLogged()->order()->count() == 0) {
                    $ZonePrice = 0;
                } else if ($conditional_deliverie ?? false != false) {
                    if (count($conditional_deliverie['zones']) < 1) {
                        $ZonePrice = $conditional_deliverie['delivery'];
                    } else if (in_array($request->zone, $conditional_deliverie['zones'])) {

                        $ZonePrice = $conditional_deliverie['delivery'];
                    } else {
                        $ZonePrice = ZonesTransformer::getDelivery(Zones::find($request->zone));
                    }
                } else {
                    $ZonePrice = ZonesTransformer::getDelivery(Zones::find($request->zone));
                }
            } catch (Exception $ex) {
                $ZonePrice = 0;
            }


        } else {
            $ZonePrice = 0;
        }
        
        // return auth()->user()->id;
        $data = [
            'UserID' => getLogged()->id,
            'ZoneID' => ($request->delivery_type == 'delivery_address') ? $request->zone : Zones::first()->id ,
            'OrderDate' => $request->order_date ?? now(),
            'Name' => $request->name,
            'address' => $request->place ?? '',
            'delivery_type' => $request->delivery_type,
            'Phone' => $request->phone_number,
            'country_code' => $request->country_code,
            'DeliveryTime' => $request->delivery_time,
            'ZonePrice' => $ZonePrice,
            'Total' => 0,
            'AddValue' => 0,
            'Discount' => 0,
            'Points' => $request->points,
            'Status' => isset($request->status) ? 'cancel' :'waiting',
            'Note' => $request->notes,
            'BranchID' => $request->branch ?? \App\Services\BranchesService::getFirstBrache(),
            'Source' => $request->User_Agent ?? 0,
            'blob' => 'orders',

        ];
        try {
            // DB::beginTransaction();
            $entity = new Order($data);
            $entity->PaymentMethod = $request->payment_method;
            $entity->save();

            if($request->cart_id){
                $entity->cart_id = $request->cart_id;
                $entity->save();
            }
            $discount = 0;
            $subtotal = 0;

            // dd($carts);
            foreach ($carts as $cart) {
                try {
                    $price = $cart->price;
                    $anotherModel = OrderDetailsService::storeFromRequest([
                        'OrderID' => $entity->id,
                        'ItemID' => $cart->product_id,
                        'OptID' => $cart->OptID,
                        'Quantity' => $cart->quantity,
                        'Price' => $price,
                        'Note' => $cart->Note,
                    ]);

                    $image = $cart->media->first();
                    if ($image) {
                        $image->copy($anotherModel, 'images', 'public');
                    }

                    $subtotal += ($price * $cart->quantity);
                    $discount += DiscountService::getDiscountByItemFromCart($cart);

                } catch (\Exception $ex) {
                    DB::rollback();
                    return $ex->getMessage();
                    throw new SomethingWentWrongException();
                }
            }
            if ($request->delivery_type == 'delivery_address') {
                $total = $subtotal - $discount + $ZonePrice;
            } else {
                $total = $subtotal - $discount ;
            }
            // dd($total);
            $entity->Total = $total;
            $entity->before_amount = $total;
            $entity->Discount = $discount;
            $entity->save();
            if(auth()->user()->id == 152){

                // dd($entity);
            }
            $coupon = self::discountCoupon($request->coupon_code, $entity->id);
            // DB::commit();
            if ($coupon) {
                return $coupon;
            }
            return $entity;
        } catch (\Exception $ex) {
            // DB::rollback();
            return $ex->getMessage();
            throw new SomethingWentWrongException();
        }
        return null;
    }

    public static function getPriceOrderWithoutDelivery($orderId)
    {
        $order = Order::where('id', $orderId)->first();
        $tital = 0;
        if ($order) {
            foreach ($order->order_details ?? [] as $detail) {
                $tital += ($detail->Price * $detail->Quantity);
            }
        }
        return $tital;
    }
    public static function discountCoupon($coupon_code, $orderId)
    {
        if ($coupon_code != '') {
            $check_user = CouponsService::checkCouponUser($coupon_code, getLogged()->id);
            if (!$check_user) {
                $check_code = CouponsService::check($coupon_code);
                if ($check_code) {
                    $query = CouponsService::obtainingCoupon($check_code, $orderId);
                    if ($query) {
                        $order = Order::where('id', $orderId)->first();
                        if ($order) {
                            $total = self::getPriceOrderWithoutDelivery($order->id);
                            $discount = $order->Discount;
                            if ($check_code->FixedDiscount != '' && $check_code->FixedDiscount != null && $check_code->FixedDiscount > 0) {
                                if ($total - $check_code->FixedDiscount > 1) {
                                    $total = $total - $check_code->FixedDiscount;
                                    $discount = $discount + $check_code->FixedDiscount;
                                }
                            } else if ($check_code->RelativeDiscount != '' && $check_code->RelativeDiscount != null && $check_code->RelativeDiscount > 0) {
                                $relativeDiscount = ($total * $check_code->RelativeDiscount / 100);
                                if ($total - $relativeDiscount > 1) {
                                    $total = $total - $relativeDiscount;
                                    $discount = $discount + $relativeDiscount;
                                }
                            }

                            $order->Total = $total + $order->ZonePrice;
                            $order->Discount = $discount;
                            $order->save();
                            return $order;
                        }
                    }
                }
            }
        }
        return null;
    }

}
