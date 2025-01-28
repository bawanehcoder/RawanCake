<?php

namespace App\Services;

use App\Models\Discount;
use App\Models\Draft;
use App\Models\OptionDetil;
use Illuminate\Support\Carbon;


class DiscountService
{
    public static function storeFromRequest($request)
    {
        try {
            $data = [
                'Cats' => json_encode($request->categories),
                'BeginDate' => $request->beginning_of_reservation,
                'EndDate' => $request->end_of_reservation,
                'BeginDelivery' => $request->beginning_of_receipt,
                'EndDelivery' => $request->end_of_receipt,
                'Value' => $request->discount,
                'Type' => $request->type,
                'blob' => $request->blob,
            ];
            $entity = new Discount($data);
            $entity->save();
            return true;
        } catch (\Exception $ex) {
            return false;
        }
    }

    public static function updateFromRequest($entity, $request)
    {
        try {
            $data = [
                'Cats' => json_encode($request->categories),
                'BeginDate' => $request->beginning_of_reservation,
                'EndDate' => $request->end_of_reservation,
                'BeginDelivery' => $request->beginning_of_receipt,
                'EndDelivery' => $request->end_of_receipt,
                'Value' => $request->discount,
                'blob' => $request->blob,
            ];

            DraftService::saveDraft($entity, 'update');
            $entity->update($data);
            $entity->save();
            return $entity;
        } catch (\Exception $ex) {
            return false;
        }
    }

    public static function getDiscountByItemFromCart($entity)
    {
        $discounts = Discount::whereRaw('(now() between BeginDate and EndDate)')->get();

        if ($discounts && $entity->OptID) {
            foreach ($discounts as $discount) {
                $ids = json_decode($discount->Cats, true);

                foreach ($ids as $id) {
                    if ($entity->item->CatID == $id) {

                        $additionalValue= OptionDetil::whereIn('id',json_decode($entity->OptID) )->sum('AdditionalValue');

                        $price = $entity->item->Price() + $additionalValue;

                        $price = $price * ($entity->quantity??$entity->Quantity);

                        $price_discount = ($price * $discount->Value) / 100;

                        return $price_discount;
                    }
                }
            }
        }
        return 0;
    }

    public static function getDiscount($type)
    {
        $discounts = Discount::whereRaw('(now() between BeginDate and EndDate)')->where('Type',$type)->get();
        $data = [];
        $endDate=[];
        if ($discounts) {
            foreach ($discounts as $discount) {
                $endDate[$discount->id]['EndDate']=$discount->EndDate;
                $endDate[$discount->id]['data']=json_decode($discount->Cats, true);
//                $ids = json_decode($discount->Cats, true);
//                $data = array_merge($data, $ids);
            }

            return $endDate;
        }
        return $endDate;
    }

    public static function getDiscountByItem($entity)
    {
        $discounts = Discount::whereRaw('(now() between BeginDate and EndDate)')->get();
        if ($discounts) {
            foreach ($discounts as $discount) {

                $ids = json_decode($discount->Cats, true);

                if ($discount->Type == 'section') {
                    foreach ($ids as $id) {
                        if ($entity->CatID == $id) {
                            return $discount->Value;
                        }
                    }
                } else {
                    foreach ($ids as $id) {
                        if ($entity->id == $id) {
                            return $discount->Value;
                        }
                    }
                }
            }
        }
        return 0;
    }
    public static function getDiscountEndDateByItem($entity)
    {
        $discounts = Discount::whereRaw('(now() between BeginDate and EndDate)')->get();
        if ($discounts) {
            foreach ($discounts as $discount) {

                $ids = json_decode($discount->Cats, true);
                if ($discount->Type == 'section') {
                    foreach ($ids as $id) {
                        if ($entity->CatID == $id) {
                            return $discount->EndDate;
                        }
                    }
                } else {
                    foreach ($ids as $id) {
                        if ($entity->id == $id) {
                            return $discount->EndDate;
                        }
                    }
                }
            }
        }
        return null;
    }

}
