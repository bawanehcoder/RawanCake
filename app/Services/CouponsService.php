<?php

namespace App\Services;

use App\Models\Coupon;
use App\Models\OrderCoupon;
use Carbon\Carbon;

class CouponsService
{
    public static function storeFromRequest($request)
    {
        $symbols = explode("\r\n", $request->symbols);

        foreach ($symbols ?? [] as $symbol) {
            $data = [
                'Serial' => $symbol,
                'UsedLimit' => $request->usage_limit,
                'FixedDiscount' => $request->FixedDiscount,
                'RelativeDiscount' => $request->RelativeDiscount,
                'Expiration' => $request->expiration_date,
                'blob' => $request->blob,
            ];
            $entity = new Coupon($data);
            $entity->save();
        }

        return true;
    }

    public static function updateFromRequest($entity, $request)
    {
        $data = [
            'Serial' => $request->symbols,
            'UsedLimit' => $request->usage_limit,
            'FixedDiscount' => $request->FixedDiscount,
            'RelativeDiscount' => $request->RelativeDiscount,
            'Expiration' => $request->expiration_date,
        ];
        $entity->update($data);
        $entity->save();
        return $entity;
    }

    public static function check($code)
    {
        $query = Coupon::where('Serial',$code)->expiration()->first();
        if ($query && $query->UsedCount < $query->UsedLimit) {
            return $query;
        } else {
            return false;
        }
    }
    public static function checkCouponUser($code,$userId)
    {
            $query = self::check($code);
            if ($query) {
                $Coupon_user = $query->order->where('UserID',$userId)->first();
                if ($Coupon_user) {
                    return $Coupon_user;
                }
            }
        return false;
    }

    public static function obtainingCoupon($query, $orderID)
    {
        if (isLogged()) {
            $query->increaseCoupon();
            $order_coupon = new OrderCoupon(['CouponID' => $query->id, 'OrderID' => $orderID, 'UserID' => getLogged()->id]);
            $order_coupon->save();
            return $order_coupon;
        }
        return null;
    }

}
