<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\Cart;
use App\Models\Item;
use App\Services\CartService;

class CartRepository implements RepositoryInterface
{

    public function getAll()
    {
        return Cart::all();
    }

    public function findById($id)
    {
        return Cart::findOrFail($id);
    }

    public function delete($id)
    {
        return Cart::findOrFail($id)->delete();
    }
    public function cartCount(){
       return count(CartService::getCarts());
    }
    public function getTotalPrice($carts)
    {
        $total = 0;
        foreach ($carts as $cart) {
            $total += ($cart->price * $cart->quantity);
        }
        return $total;
    }
    public function checkIsSpecialInCart(){
        foreach(CartService::getCarts()??[] as $index=>$cart){
            if($cart->item->Special==1){
                return true;
            }
        }
        return false;
    }
}
