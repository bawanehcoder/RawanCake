<?php

namespace App\Services;

class ApplicationGiftService
{
    public static function updateFromRequest($entity,$request)
    {

        switch ($request->type_of_gift){
            case 0:
               $product=null;
               $RelativeDiscount=  $request->RelativeDiscount;
               $FixedDiscount= $request->FixedDiscount;
                break;
            case 1:
                $RelativeDiscount=null;
                $FixedDiscount= null;
                $product=$request->product;
                break;
        }
        $data=[
            'GiftMessage'=>$request->gift_message,
            'GiftType'=>$request->type_of_gift,
            'ProductID'=>$product,
            'RelativeDiscount'=>$RelativeDiscount,
            'FixedDiscount'=>$FixedDiscount,
            'Enabled'=>$request->Enabled==null?0:1,
        ];
            $entity->update($data) ;
            $entity->save();
        return $entity;
    }
}
