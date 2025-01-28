<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\Banner;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;

class BannerRepository implements RepositoryInterface
{

    public function getAll()
    {
        return Banner::all();
    }

    public function findById($id)
    {
        return Banner::findOrFail($id);
    }

    public function delete($id)
    {
        return Banner::findOrFail($id)->delete();
    }
    public function getBanners(){
        return Banner::start()->end()->get();
    }


}
