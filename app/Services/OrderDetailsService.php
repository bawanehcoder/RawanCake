<?php

namespace App\Services;

use App\Models\OrderDetail;

class OrderDetailsService
{
    public static function storeFromRequest($request){
        $data = [
            'OrderID'=>$request['OrderID'],
            'ItemID'=>$request['ItemID'],
            'OptID'=>$request['OptID'],
            'Quantity'=>$request['Quantity'],
            'Price'=>$request['Price'],
            'Note'=>$request['Note'],
            'blob'=>'order_details'
        ];
        $entity = new OrderDetail($data);
        $entity->save();
        return  $entity;
    }
}
