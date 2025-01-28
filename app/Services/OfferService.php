<?php

namespace App\Services;

use App\Exceptions\DuplicateElementException;
use App\Models\Item;
use App\Models\Offer;
use App\Repositories\ItemRepository;

class OfferService
{
    public static function storeFromRequest($request)
    {

        $new_price = 0;
        try {
            $items = Item::whereIn('id', $request->products)->get();
            foreach ($items ?? [] as $item) {

                if($item->offerActive->count()>0){
                    throw new DuplicateElementException();

                }

                if (isset($request->FixedDiscount) && !empty($request->FixedDiscount && $request->FixedDiscount > 0)) {
                    $new_price = self::fixedDiscount($item->Price, $request->FixedDiscount);
                } elseif (isset($request->RelativeDiscount) && !empty($request->RelativeDiscount) && $request->RelativeDiscount > 0) {
                    $new_price = self::relativeDiscount($item->Price, $request->RelativeDiscount);
                }
                $data = [
                    'ItemID' => $item->id,
                    'BeginDate' => $request->BeginDate,
                    'EndDate' => $request->EndDate,
                    'FixedDiscount' => $request->FixedDiscount ?? 0,
                    'RelativeDiscount' => $request->RelativeDiscount ?? 0,
                    'NewPrice' => $new_price,
                    'blob' => $request->blob,
                ];

                $entity = new Offer($data);
                $entity->save();
            }
            return 'created';
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function updateFromRequest($entity, $request)
    {
        $new_price = 0;
        try {

            $entity->delete();

            $items = Item::whereIn('id', $request->products)->get();
            foreach ($items ?? [] as $item) {
                if (isset($request->FixedDiscount) && !empty($request->FixedDiscount && $request->FixedDiscount > 0)) {
                    $new_price = self::fixedDiscount($item->Price, $request->FixedDiscount);
                } elseif (isset($request->RelativeDiscount) && !empty($request->RelativeDiscount) && $request->RelativeDiscount > 0) {
                    $new_price = self::relativeDiscount($item->Price, $request->RelativeDiscount);
                }
                $data = [
                    'ItemID' => $item->id,
                    'BeginDate' => $request->BeginDate,
                    'EndDate' => $request->EndDate,
                    'FixedDiscount' => $request->FixedDiscount ?? 0,
                    'RelativeDiscount' => $request->RelativeDiscount ?? 0,
                    'NewPrice' => $new_price,
                    'blob' => $request->blob,
                ];
                $entity = new Offer($data);
                $entity->save();
                return $entity;
            }

        } catch (\Exception $ex) {
            return false;
        }

    }

    public static function fixedDiscount($price, $discount)
    {
        return $price - $discount;
    }

    public static function relativeDiscount($price, $discount)
    {
        return $price - ($price * $discount / 100);
    }

}
