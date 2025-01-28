<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;

class ItemRepository implements RepositoryInterface
{

    public function getAll()
    {
        return Item::all();
    }

    public function findById($id)
    {
        return Item::findOrFail($id);
    }

    public function delete($id)
    {
        return Item::findOrFail($id)->delete();
    }

    public function getNewProducts($product,$limet = 3)
    {
        return Item::where('new',1)->orderBy('id')->take($limet)->where('Available',1)
        ->whereHas('subCategory', function ($query) {
            $query->where('Visible', 1); // Ensure the category is also available
        })
        ->get();

    }
    public function getRelatedProducts($product,$limet = 10)
    {
        if($product){
            return Item::where('CatID',$product->CatID)->where('id','!=',$product->id)->orderBy('id')->take($limet)->get();
        }
        return [];
    }
    public function getMostViewedProducts($limet = 10)
    {
        return Item::orderBy('Views')->take($limet)->get();
    }

    public function getSpecialProducts($limet = 10)
    {
        return Item::where('Special', '1')->inRandomOrder()->orderBy('id')->take($limet)->get();
    }

    public function getBestSellersProducts($limet = 3)
    {
        $orders = DB::table('order_details')
            ->select('ItemID', DB::raw('count(*) as total'))
            ->groupBy('ItemID')
            ->orderBy('total', 'DESC')
            ->take($limet)
            ->pluck('ItemID')->toArray();
        return self::itemsIds($orders);
    }

    public function itemsIds($ids)
    {
        return Item::whereIn('id', $ids)->get();
    }

}
